<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository implements MessageRepositoryInterface{

  protected $model;

  public function __construct(Message $model){
    $this->model = $model;
  }

  public function all(){
    return $this->model->orderBy('created_at', 'ASC')->get();
  }

  public function unreaded_count(){
    return $this->model->where('read', 0)->count();
  }

  public function read($id){
    $record = $this->model->find($id);
    $record->read = 1;
    return $record->save();
  }
  
  public function read_all(){
    $records = $this->model->where('read', 0)->get();
    foreach ($records as $record) {
      $record->read = 1;
      $record->save();
    }
    return true;
  }
  
    public function delete($id){
      $record = $this->model->find($id);
      return $record->delete();
    }
}