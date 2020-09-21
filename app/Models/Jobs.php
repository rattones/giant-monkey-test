<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
  protected $table= 'jobs';

  protected $fillable = [
    'id', 'clients_id', 'processors_id', 'command', 'status', 'priority',
  ];

  protected $cast = [];

  public $timestamps= true;
}
