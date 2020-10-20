<?php

namespace App\Http\Controllers;

use App\Models\HistoryStake;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;

class HomeController extends Controller
{
  public function index()
  {
    $firstJan = Carbon::now()->firstOfYear();
    $totalUser = User::all()->count();
    $suspendUser = User::where("suspend",true)->where("created_at",">=",$firstJan)->count();
    $totalDoge =
      HistoryStake::where('status',"WIN")->where("created_at",">=",$firstJan)->get()->sum("fund") -
      HistoryStake::where('status',"LOSE")->where("created_at",">=",$firstJan)->get()->sum("fund");
    $totalWin = HistoryStake::where('status',"WIN")->where("created_at",">=",$firstJan)->get()->count();
    $totalTrade = HistoryStake::where("created_at",">=",$firstJan)->get()->count();
    return view('home',[
      "totalUser"=>$totalUser,
      "totalDoge"=>$totalDoge,
      "totalTrade"=>$totalTrade,
      "totalWin"=>$totalWin,
      "suspendUser"=>$suspendUser,
      "graph"=> $this->getGraph(),
    ]);
  }

  public function online()
  {
    return view('online',[
      "online" => DB::table('oauth_access_tokens')->where('revoked', 0)->count(),
    ]);
  }

  public function fetchGraph(){
    return response()->json($this->getGraph());
  }

  private function getGraph(){
    $log = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    $dataStake = HistoryStake::whereYear('created_at', Carbon::now())->get()->groupBy(function($item) {
      return Carbon::parse($item->created_at)->format('m');
    });

    foreach ($dataStake as $id => $item) {
      $log[(integer)$id] = $item->count();
    }
    return $log;
  }
}
