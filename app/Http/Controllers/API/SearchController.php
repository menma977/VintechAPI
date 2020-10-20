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

class SearchController extends Controller
{
  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function filter($filter)
  {
    $users = User::where('username', 'like', "%".$filter."%")
      ->orWhere('username_doge', 'like', "%".$filter."%")
      ->get();
    return response()->json([
      "a"=>Auth::user()->api_token
    ], 200);
  }
}
