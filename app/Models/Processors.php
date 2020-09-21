<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Processors extends Model
{
  protected $table= 'processors';

  protected $fillable = [
    'id', 'name', 'created_ad', 'update_at'
  ];

  protected $cast = [];

  public $timestamps= true;
}
