<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HistoryStake;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
  public function store(Request $request)
  {
    $this->validate($request, [
      'fund' => 'required',
      'possibility' => 'required',
      'result' => 'required|string',
      'status' => 'required|string',
      'stop' => 'required'
    ]);

    $newStake = new HistoryStake();
    if ($request->status == "WIN") {
      $newStake->user = Auth::id();
      $newStake->fund = $request->fund;
      $newStake->possibility = $request->possibility;
      $newStake->result = $request->result;
      $newStake->status = $request->status;
      $newStake->stop = $request->stop == "true";
      $newStake->save();

      $user = User::find(Auth::id());
      $user->stake = Carbon::now();
      $user->save();

      HistoryStake::where('user', Auth::id())->update(['stop' => true]);
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
   * @return JsonResponse
   */
  public function stop()
  {
    $user = User::find(Auth::id());
    $user->stake = Carbon::now();
    $user->save();

    HistoryStake::where('user', Auth::id())->where('stop', false)->update(['stop' => true]);

    $data = [
      'message' => 'stake has been stopped',
    ];

    return response()->json($data, 200);
  }
}
