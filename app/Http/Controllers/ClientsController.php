<?php

namespace App\Http\Controllers;

use App\Models\Clients;

class ClientsController extends Controller
{
  private $model;

  public function __construct(Clients $clients)
  {
    $this->model= $clients;
  }

  public function create()
  {
    $client= new Clients();
    $client->name= request()->input('name');

    $client->save();

    return response()->json($client);
  }

  public function get(int $id= null)
  {
    // verifing to get one or all clients
    if (is_null($id)) {
      $client= $this->model->all();
    } else {
      $client= $this->model->find($id);
    }

    return response()->json($client);
  }
}
