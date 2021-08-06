<?php

namespace App\Models;

use Eloquent as Model;


class AccountOwn extends Model
{
  public $table = 'account_own';

  public $fillable = [
    'id_user',
    'id_tp_account',
    'n_account',
    'balance',
    'status',
  ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
  protected $casts = [
    'id_user',
    'id_tp_account',
    'n_account',
    'balance',
    'status',
  ];

  /**
   * Validation rules
   *
   * @var array
   */
  public static $rules = [
  ];
}
