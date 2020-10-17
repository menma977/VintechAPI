<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HistoryStake;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    $username = Auth::user()->username;
    $walletDeposit = Auth::user()->wallet_deposit;
    $walletWithdraw = Auth::user()->wallet_withdraw;
    $isStake = Auth::user()->stake == Carbon::now();
    $getLastStake = HistoryStake::where('user', Auth::id())->where('status', false)->orderBy('created_at', 'DESC')->first();

    $data = [
      'username' => $username,
      'walletDeposit' => $walletDeposit,
      'walletWithdraw' => $walletWithdraw,
      'isStake' => $isStake,
      'lastStake' => $getLastStake
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
            $isStake = Auth::user()->stake == Carbon::now();
            $getLastStake = HistoryStake::where('user', Auth::id())->where('status', false)->orderBy('created_at', 'DESC')->first();
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
}
