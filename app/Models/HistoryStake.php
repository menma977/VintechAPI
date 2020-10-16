<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HistoryStake
 * @package App\Models
 * @property string id
 * @property string user
 * @property string fund
 * @property string possibility
 * @property string result
 * @property string status
 * @property boolean stop
 */
class HistoryStake extends Model
{
  use HasFactory, Uuid;

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
    'fund',
    'possibility',
    'result',
    'status',
    'stop',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'id',
    'user',
  ];
}
