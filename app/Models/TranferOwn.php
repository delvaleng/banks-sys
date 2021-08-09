<?php

namespace App\Models;

use Eloquent as Model;


class TranferOwn extends Model
{
  public $table = 'transfer_own';

  public $fillable = [
    'id_user',
    'id_account_own_origen',
    'id_account_own_destino',
    'mount',
    'mount_prev',
    'mount_next',
    'n_transfer',
  ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
  protected $casts = [
    'id_user',
    'id_account_own_origen',
    'id_account_own_destino',
    'mount',
    'mount_prev',
    'mount_next',
    'n_transfer',
  ];

  /**
   * Validation rules
   *
   * @var array
   */
  public static $rules = [];
}
