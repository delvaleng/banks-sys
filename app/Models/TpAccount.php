<?php

namespace App\Models;

use Eloquent as Model;


class TpAccount extends Model
{
  public $table = 'tp_account';

  public $fillable = [
    'id',
    'name',
  ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
  protected $casts = [
    'id',
    'name',
  ];

  /**
   * Validation rules
   *
   * @var array
   */
  public static $rules = [
  ];
}
