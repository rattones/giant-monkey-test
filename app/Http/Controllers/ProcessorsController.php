<?php

namespace App\Http\Controllers;

use App\Models\Processors;

class ProcessorsController extends Controller
{
  private $model;

  public function __construct(Processors $processors)
  {
    $this->model= $processors;
  }

  public function create()
  {
    $processor= new Processors();
    $processor->name= request()->input('name');

    $processor->save();

    return response()->json($processor);
  }

  public function get(int $id)
  {
    $processor= $this->model->find($id);

    return response()->json($processor);
  }
}
