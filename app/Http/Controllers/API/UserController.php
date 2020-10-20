<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HistoryStake;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

  /**
   * @return JsonResponse
   */
  public function index()
  {
    $version = Setting::find(1)->version;
    $username = Auth::user()->username;
    $walletDeposit = Auth::user()->wallet_deposit;
    $walletWithdraw = Auth::user()->wallet_withdraw;
    if (Auth::user()->stake == null) {
      $isStake = false;
    } else {
      $isStake = Carbon::parse(Auth::user()->stake)->format("d") == Carbon::now()->format("d");
    }
    $getLastStake = HistoryStake::where('user', Auth::id())->where('stop', false)->orderBy('created_at', 'DESC')->first();

    $data = [
      'username' => $username,
      'walletDeposit' => $walletDeposit,
      'walletWithdraw' => $walletWithdraw,
      'isStake' => $isStake,
      'lastStake' => $getLastStake,
      'version' => $version
    ];

    return response()->json($data, 200);
  }

  public function getVersion()
  {
    $version = Setting::find(1)->version;

    $data = [
      'version' => $version
    ];

    return response()->json($data, 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function login(Request $request)
  {
    $this->validate($request, [
      'username' => 'required|string|exists:users,username',
      'password' => 'required|string',
    ]);
    try {
      if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        foreach (Auth::user()->tokens as $value) {
          $value->delete();
        }
        $user = Auth::user();
        if ($user) {
          if ($user->suspand) {
            $data = [
              'message' => 'The given data was invalid.',
              'errors' => [
                'validation' => ['Your account has been suspended.'],
              ],
            ];
            return response()->json($data, 500);
          }
          if (Auth::user()->username == "myvintech") {
            $user->token = $user->createToken('android')->accessToken;
            return response()->json([
              'token' => $user->token,
            ], 200);
          }

          $loginDoge = Http::asForm()->post('https://www.999doge.com/api/web.aspx', [
            'a' => 'Login',
            'Key' => '1b4755ced78e4d91bce9128b9a053cad',
            'username' => $user->username_doge,
            'password' => $user->password_doge,
          ]);
          if ($loginDoge->successful()) {
            if (str_contains($loginDoge->body(), 'InvalidApiKey')) {
              $data = [
                'message' => 'access to the token is blocked.',
              ];
              return response()->json($data, 500);
            }

            if (str_contains($loginDoge->body(), 'LoginInvalid')) {
              $data = [
                'message' => 'Invalid username or password.',
              ];
              return response()->json($data, 500);
            }

            $user->token = $user->createToken('android')->accessToken;
            if (Auth::user()->stake == null) {
              $isStake = false;
            } else {
              $isStake = Carbon::parse(Auth::user()->stake)->format("d") == Carbon::now()->format("d");
            }
            $getLastStake = HistoryStake::where('user', Auth::id())->where('stop', false)->orderBy('created_at', 'DESC')->first();
            return response()->json([
              'username' => $user->username,
              'token' => $user->token,
              'session' => $loginDoge["SessionCookie"],
              'walletDeposit' => $user->wallet_deposit,
              'walletWithdraw' => $user->wallet_withdraw,
              'balance' => $loginDoge["Doge"]["Balance"],
              'isStake' => $isStake,
              'lastStake' => $getLastStake
            ], 200);
          }

          $data = [
            'message' => 'The given data was invalid.',
            'errors' => [
              'validation' => ['Invalid username or password.'],
            ],
          ];
          return response()->json($data, 500);
        }
      }
    } catch (Exception $e) {
      Log::error($e->getMessage() . " - " . $e->getFile() . " - " . $e->getLine());
    }
    $data = [
      'message' => 'The given data was invalid.',
      'errors' => [
        'validation' => ['Invalid username or password.'],
      ],
    ];
    return response()->json($data, 500);
  }

  /**
   * @return JsonResponse
   */
  public function logout()
  {
    $token = Auth::user()->tokens;
    foreach ($token as $key => $value) {
      $value->delete();
    }
    return response()->json([
      'response' => 'Successfully logged out',
    ], 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function register(Request $request)
  {
    $this->validate($request, [
      'username' => 'required|string',
      'password' => 'required|string',
      'username_doge' => 'required|string',
      'password_doge' => 'required|string',
      'wallet_deposit' => 'required|string',
      'wallet_withdraw' => 'required|string',
    ]);
    $user = User::where('username', $request->username)->first();
    if ($user) {
      $user->password = Hash::make($request->password);
      $user->username_doge = $request->username_doge;
      $user->password_doge = $request->password_doge;
      $user->wallet_deposit = $request->wallet_deposit;
      $user->wallet_withdraw = $request->wallet_withdraw;
      $user->save();
      return response()->json(['response' => 'Successfully update',], 200);
    }

    $user = new User();
    $user->username = $request->username;
    $user->password = Hash::make($request->password);
    $user->username_doge = $request->username_doge;
    $user->password_doge = $request->password_doge;
    $user->wallet_deposit = $request->wallet_deposit;
    $user->wallet_withdraw = $request->wallet_withdraw;
    $user->save();
    return response()->json(['response' => 'Successfully register',], 200);
  }
}
