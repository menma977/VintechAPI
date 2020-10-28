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
    $user->username = "myvintech";
    $user->password = Hash::make("qwerty8899");
    $user->username_doge = "pluckywin2";
    $user->password_doge = "arif999999";
    $user->wallet_deposit = "DLLLsd72pjyD7Ankf1bouRZudDRAMqGq4P";
    $user->wallet_withdraw = "DLLLsd72pjyD7Ankf1bouRZudDRAMqGq4P";
    $user->save();

    $setting = new Setting();
    $setting->version = 1;
    $setting->save();
  }
}
