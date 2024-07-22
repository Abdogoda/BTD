<?php

namespace App\Repositories;

class HomeRepository implements HomeRepositoryInterface{
  public function home(){
    return view('index');
  }

  public function about(){
    return view('about');
  }
}