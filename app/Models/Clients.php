<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
  protected $table= 'clients';

  protected $fillable = [
    'id', 'name', 'created_ad', 'update_at'
  ];

  protected $cast = [];

  public $timestamps= true;
}
