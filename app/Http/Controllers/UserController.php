<?php

namespace App\Http\Controllers;

use App\Models\HistoryStake;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

  public function index()
  {
    return view('user.index');
  }

  public function detail($username)
  {
    $user = User::where('id', $username)->get()->first();
    if ($user) {
      $tradesAnytime = HistoryStake::where('user', $username);
      $tradesToday = $tradesAnytime->whereBetween('created_at', [
        Carbon::today(), Carbon::tomorrow()
      ]);
      $totalWin = $tradesToday->where('status', 'WIN')->sum('fund');
      $totalLose = $tradesToday->where('status', 'LOSE')->sum('fund');

      $totalWinAnytime = $tradesAnytime->where('status', 'WIN')->sum('fund');
      $totalLoseAnytime = $tradesAnytime->where('status', 'LOSE')->sum('fund');

      return view('user.show', [
        'user' => $user,
        'totalWinCount' => $tradesToday->where('status', 'WIN')->count(),
        'totalLoseCount' => $tradesToday->where('status', 'LOSE')->count(),
        'totalTradeCount' => $tradesToday->where('status', 'WIN')->count(),
        'totalWin' => $totalWin,
        'totalLose' => $totalLose,
        'totalTrade' => $totalWin - $totalLose,
        'trades' => HistoryStake::where('user', $username)->get(),
        'totalWinCountAllTime' => $tradesAnytime->where('status', 'WIN')->count(),
        'totalLoseCountAllTime' => $tradesAnytime->where('status', 'LOSE')->count(),
        'totalTradeCountAllTime' => $tradesAnytime->where('status', 'WIN')->count(),
        'totalWinAllTime' => $totalWinAnytime,
        'totalLoseAllTime' => $totalLoseAnytime,
        'totalTradeAllTime' => $totalWinAnytime - $totalLoseAnytime,
      ]);
    }

    return redirect()->back();
  }

  /**
   * @param string $filter
   * @return JsonResponse
   */
  public function filter($filter = "")
  {
    if ($filter) {
      $users = User::where('username', 'like', "%" . $filter . "%")
        ->orWhere('username_doge', 'like', "%" . $filter . "%")
        ->orWhere('wallet_deposit', 'like', "%" . $filter . "%")
        ->orWhere('wallet_withdraw', 'like', "%" . $filter . "%")
        ->get();
    } else {
      $users = User::take(10)->get();
    }
    return response()->json($users, 200);
  }
}
