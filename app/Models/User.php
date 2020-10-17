<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App\Models
 * @property string id
 * @property string username
 * @property string password
 * @property string username_doge
 * @property string password_doge
 * @property string wallet_deposit
 * @property string wallet_withdraw
 * @property string suspend
 * @property string stake
 */
class User extends Authenticatable
{
  use HasFactory, Notifiable, Uuid, HasApiTokens;

  /**
   * The "type" of the auto-incrementing ID.
   *
   * @var string
   */
  protected $keyType = 'string';

  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'username',
    'password',
    'username_doge',
    'password_doge',
    'wallet_deposit',
    'wallet_withdraw',
    'suspend',
    'stake'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'id',
    'password',
    'username_doge',
    'password_doge',
    'remember_token',
  ];
}
