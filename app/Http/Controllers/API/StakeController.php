<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HistoryStake;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class StakeController extends Controller
{
  /**
   * @return JsonResponse
   */
  public function index()
  {
    $getLastStake = HistoryStake::where('user', Auth::id())->where('stop', false)->orderBy('created_at', 'DESC')->first();
    $getStake = HistoryStake::where('user', Auth::id())->where('stop', false)->orderBy('created_at', 'ASC')->get();

    $data = [
      'lastStake' => $getLastStake,
      'listStake' => $getStake,
    ];

    return response()->json($data, 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function tread(Request $request)
  {
    $this->validate($request, [
      'fund' => 'required',
      'possibility' => 'required',
      'high' => 'required',
      'sessionDoge' => 'required',
      'seeds' => 'required',
      'walletWithdraw' => 'required',
    ]);

    $url = "https://www.999doge.com/api/web.aspx";

    $stake = Http::asForm()->post($url, [
      "a" => "PlaceBet",
      "s" => $request->sessionDoge,
      "Low" => "0",
      "High" => $request->high,
      "PayIn" => $request->fund,
      "ProtocolVersion" => "2",
      "ClientSeed" => $request->seeds,
      "Currency" => "doge",
    ]);

    Log::info($stake);

    if ($stake->successful() && str_contains($stake->body(), 'BetId') == true) {
      $seed = $stake["Next"];
      $payout = $stake["PayOut"];
      $balanceRemaining = $stake["StartingBalance"];
      $profit = $payout - $request->fund;
      $balanceRemaining += $profit;
      $isWin = $profit > 0;

      $newStake = new HistoryStake();
      if ($isWin) {
        $res = Http::asForm()->post($url, [
          'a' => 'Withdraw',
          's' => $request->sessionDoge,
          'Amount' => '0',
          'Address' => $request->walletWithdraw,
          'Currency' => 'doge'
        ]);
        Log::info($res);
        $newStake->user = Auth::id();
        $newStake->fund = $request->fund;
        $newStake->possibility = $request->possibility;
        $newStake->result = $payout;
        $newStake->status = "WIN";
        $newStake->stop = false;
        $newStake->save();
        if (str_contains($res->body(), 'Pending') == true) {
          $user = User::find(Auth::id());
          $user->stake = Carbon::now();
          $user->save();

          HistoryStake::where('user', Auth::id())->update(['stop' => true]);
        } else {
          $data = ['message' => 'your connection is not as stable, find a place with a stable connection'];
          return response()->json($data, 500);
        }
      } else {
        $newStake->user = Auth::id();
        $newStake->fund = $request->fund;
        $newStake->possibility = $request->possibility;
        $newStake->result = $payout;
        $newStake->status = "LOSE";
        $newStake->save();
      }

      $data = [
        'seeds' => $seed,
        'payout' => $payout,
        'balanceRemaining' => $balanceRemaining,
        'isWin' => $isWin
      ];

      return response()->json($data, 200);
    }

    return response()->json(['message' => 'your connection is not as stable, find a place with a stable connection'], 500);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'fund' => 'required',
      'possibility' => 'required',
      'result' => 'required|string',
      'status' => 'required|string',
      'stop' => 'required',
      'sessionDoge' => 'required',
      'walletWithdraw' => 'required',
    ]);

    $newStake = new HistoryStake();
    if ($request->status == "WIN") {
        // https://corsdoge.herokuapp.com/doge
        // https://www.999doge.com/api/web.aspx
      $res = Http::asForm()->post('https://corsdoge.herokuapp.com/doge', [
        'a' => 'Withdraw',
        's' => $request->sessionDoge,
        'Amount' => '0',
        'Address' => $request->walletWithdraw,
        'Currency' => 'doge'
      ]);
      $newStake->user = Auth::id();
      $newStake->fund = $request->fund;
      $newStake->possibility = $request->possibility;
      $newStake->result = $request->result;
      $newStake->status = $request->status;
      $newStake->stop = $request->stop == "true";
      $newStake->save();
      if (str_contains($res->body(), 'Pending') == true) {
        $user = User::find(Auth::id());
        $user->stake = Carbon::now();
        $user->save();

        HistoryStake::where('user', Auth::id())->update(['stop' => true]);
      } else {
        $data = ['message' => 'pesan error'];
        return response()->json($data, 500);
      }
    } else {
      $newStake->user = Auth::id();
      $newStake->fund = $request->fund;
      $newStake->possibility = $request->possibility;
      $newStake->result = $request->result;
      $newStake->status = $request->status;
      $newStake->save();
    }

    $data = [
      'message' => 'data is saved',
    ];

    return response()->json($data, 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function stop(Request $request)
  {
    $this->validate($request, [
      'sessionDoge' => 'required',
      'walletWithdraw' => 'required',
    ]);
// https://corsdoge.herokuapp.com/doge
// https://www.999doge.com/api/web.aspx
    $res = Http::asForm()->post('https://corsdoge.herokuapp.com/doge', [
      'a' => 'Withdraw',
      's' => $request->sessionDoge,
      'Amount' => '0',
      'Address' => $request->walletWithdraw,
      'Currency' => 'doge'
    ]);

    // $newStake = new HistoryStake();
    // $newStake->user = Auth::id();
    // $newStake->fund = $request->fund;
    // $newStake->possibility = $request->possibility;
    // $newStake->result = $request->result;
    // $newStake->status = $request->status;
    // $newStake->stop = $request->stop == "true";
    // $newStake->save();
    if (str_contains($res->body(), 'Pending') == true) {
        $user = User::find(Auth::id());
      $user->stake = Carbon::now();
      $user->save();

      HistoryStake::where('user', Auth::id())->update(['stop' => true]);
    } else if(str_contains($res->body(), 'InsufficientFunds') == true) {
        $user = User::find(Auth::id());
      $user->stake = Carbon::now();
      $user->save();

      HistoryStake::where('user', Auth::id())->update(['stop' => true]);
    } else {
      $data = ['message' => 'pesan error'];
      return response()->json($data, 500);
    }
    $data = [
      'message' => 'stake has been stopped',
    ];

    return response()->json($data, 200);
  }
}
