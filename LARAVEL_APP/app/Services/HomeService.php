<?php

namespace App\Services;

use App\Repositories\HomeRepositoryInterface;

class HomeService{
 protected $homeRepository;
 
  public function __construct(HomeRepositoryInterface $homeRepository) {
   $this->homeRepository = $homeRepository;
  }

  public function home(){
      return $this->homeRepository->home();
  }
  
  public function about(){
      return $this->homeRepository->about();
  }
}