<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HistoryStake;
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
    $getLastStake = HistoryStake::where('user', Auth::id())->where('status', false)->orderBy('id', 'desc')->first();
    $getStake = HistoryStake::where('user', Auth::id())->where('status', false)->orderBy('id', 'desc')->take(10)->get();

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
      'user_id' => 'required|string|exists:users,id',
      'fund' => 'required',
      'possibility' => 'required',
      'result' => 'required|string',
      'status' => 'required|string',
      'stop' => 'required|boolean'
    ]);

    $newStake = new HistoryStake();
    if ($request->stop) {
      $newStake->user = Auth::id();
      $newStake->fund = $request->fund;
      $newStake->possibility = $request->possibility;
      $newStake->result = $request->result;
      $newStake->status = $request->status;
      $newStake->stop = $request->stop;
      $newStake->save();

      HistoryStake::where('user', Auth::id())->where('stop', false)->update(['stop' => true]);
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
    HistoryStake::where('user', Auth::id())->where('stop', false)->update(['stop' => true]);

    $data = [
      'message' => 'stake has been stopped',
    ];

    return response()->json($data, 200);
  }
}
