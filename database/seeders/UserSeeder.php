<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $user = new User();
    $user->username = "menma977";
    $user->password = Hash::make("admin");
    $user->username_doge = "076oa4248d45";
    $user->password_doge = "722g704d7859";
    $user->wallet_deposit = "DGtw8PxJnyiCxrXgXqs4mpX3rooQCiThGU";
    $user->wallet_withdraw = "DBvzWv9M86jHHK3gcG192Y3foNPbgqE7GW";
    $user->save();

    $setting = new Setting();
    $setting->version = 1;
    $setting->save();
  }
}
