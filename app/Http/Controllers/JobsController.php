<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Jobs;
use App\Models\Processors;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;

class JobsController extends Controller
{
  private $model;

  public function __construct(Jobs $jobs)
  {
    $this->model= $jobs;
  }

  private function verifyClient(int $clientsId)
  {
    $cliModel= new Clients();
    $response= $cliModel->find($clientsId);

    return $response;
  }

  public function create()
  {
    $clientsId= request()->input('clients_id');
    if (!$this->verifyClient($clientsId)) {
      return response('client not found', 401);
    }

    $job= new Jobs();
    $job->clients_id= $clientsId;
    $job->processors_id= null; #request()->input('processors_id'); // processor can't be inserted here
    $job->command= request()->input('command');
    $job->status= request()->input('status');
    $job->priority= request()->input('priority');


    $job->save();

    return response()->json($job->id);
  }

  public function update(int $id)
  {
    $job= $this->model->find($id);
    // validating client
    if (!empty(request()->input('clients_id'))) {
      if (!$this->verifyClient(request()->input('clients_id'))) {
        return response('client not found', 400);
      }
      $job->clients_id= request()->input('clients_id');
    }
    // validating processor
    if (!empty(request()->input('processors_id'))) {
      if (!$this->verifyProcessor(request()->input('processors_id'))) {
        return response('processor not found', 400);
      }
      if (request()->input('status') === 'processing'
        and $this->processorHasJobDoing(request()->input('processors_id'))) {
        return response('processor already has a job', 400);
      }
      $job->processors_id= request()->input('processors_id');
    }
    $job->command= (!empty(request()->input('command')))?
      request()->input('command'): $job->command;
    // validating status
    if (!empty(resquest()->input('status'))) {
      if (request()->input('status') === 'processing'
        and $this->processorHasJobDoing($job->processors_id)) {
        return response('processor already has a job');
      }
      $job->status= request()->input('status');
    }
    $job->priority= (!empty(request()->input('priority')))?
      request()->input('priority'): $job->priority;


    $job->update();

    return response()->json($job);
  }

  public function get(int $id= null)
  {
    // verifing to get one or all clients
    if (is_null($id)) {
      $jobs= $this->model->all();
    } else {
      $jobs= $this->model->find($id);
    }

    return response()->json($jobs);
  }

  public function getStatus(int $id)
  {
    $job= $this->model->find($id);

    return response()->json($job->status);
  }

  // verifying processor
  private function verifyProcessor(int $processorsId)
  {
    $procModel= new Processors();
    $response= $procModel->find($processorsId);

    return $response;
  }

  // verify if the processor is not doing jobs
  private function processorHasJobDoing(int $processorsId) : bool
  {
    $response= $this->model
      ->where('processors_id', $processorsId)
      ->where('status', 'processing')
      ->get();

    return !!count($response);
  }

  // getting the high priority job
  private function getHighPriorityJob()
  {
    $response= $this->model
      ->where('processors_id', null)
      ->where('status', 'open')
      ->orderBy('priority', 'asc')
      ->orderBy('created_at', 'asc')
      ->get();

    return $response->first();
  }

  private function getProcessorAuthentication() : int
  {
    // $header= request()->hasHeader('Authorization');
    $header= request()->header('Authorization');
    $aux= explode(' ',  $header);
    $processorsId= $aux[1];

    if (!$this->verifyProcessor($processorsId)) {
      return response('processor not found', 401);
    }

    return $processorsId;
  }

  public function pickJob()
  {
    $processorsId= $this->getProcessorAuthentication();

    if ($this->processorHasJobDoing($processorsId)) {
      return response('processor already has a job', 400);
    }

    // get the high priority job
    $job= $this->getHighPriorityJob($processorsId);

    // setting job to processor
    $job->processors_id= $processorsId;
    $job->status= 'processing';
    $job->update();

    return response()->json($job);
  }

  public function setJobDone(int $id)
  {
    $processorsId= $this->getProcessorAuthentication();

    $job= $this->model->find($id);
    $job->status= 'done';
    $job->update();

    return response()->json($job);
  }
}
