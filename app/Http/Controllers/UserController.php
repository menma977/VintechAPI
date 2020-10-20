<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HistoryStake;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

  public function index(){
    return view('user.index');
  }

  public function detail($username){
    $user = User::where('id',$username)->get()->first();
    if($user){
    $tradesAlltime = HistoryStake::where('user',$username);
    $tradesToday = $tradesAlltime->whereBetween('created_at',[
      Carbon::today(), Carbon::tomorrow()
    ]);
    $totalWin = $tradesToday->where('status','WIN')->sum('fund');
    $totalLose = $tradesToday->where('status','LOSE')->sum('fund');

    $totalWinAlltime = $tradesAlltime->where('status','WIN')->sum('fund');
    $totalLoseAlltime = $tradesAlltime->where('status','LOSE')->sum('fund');

    return view('user.show',[
      'user' => $user,
      'totalWinCount' => $tradesToday->where('status','WIN')->count(),
      'totalLoseCount' => $tradesToday->where('status','LOSE')->count(),
      'totalTradeCount' => $tradesToday->where('status','WIN')->count(),
      'totalWin' => $totalWin,
      'totalLose' => $totalLose,
      'totalTrade' => $totalWin - $totalLose,
      'trades' => HistoryStake::where('user',$username)->get(),
      'totalWinCountAllTime' => $tradesAlltime->where('status','WIN')->count(),
      'totalLoseCountAllTime' => $tradesAlltime->where('status','LOSE')->count(),
      'totalTradeCountAllTime' => $tradesAlltime->where('status','WIN')->count(),
      'totalWinAllTime' => $totalWinAlltime,
      'totalLoseAllTime' => $totalLoseAlltime,
      'totalTradeAllTime' => $totalWinAlltime - $totalLoseAlltime,
    ]);
    }else return redirect()->back();
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function filter($filter = "")
  {
    $users = User::where('username', 'like', "%".$filter."%")
      ->orWhere('username_doge', 'like', "%".$filter."%")
      ->get();
    return response()->json($users, 200);
  }
}
