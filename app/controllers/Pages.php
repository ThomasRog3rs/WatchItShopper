<?php
  class Pages extends Controller{
    public function __construct(){
      //This where you can load a model
    }

    public function index(){
      if(isset($_SESSION['user_id'])){
        redirect('/posts');
      }
      $data = [
        'title' => 'WhatchItShopper', 
        'desc' => 'A simple platform to buy and sell used goods!'
      ];

      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About us:', 
        'desc' => '<h4 class="text-center">WatchItShopper is a simple platform that gives people the power to protect the enviroment.</h4> <hr>      Whatch out and keep an eye on your watch! Time is running out. Due to the over production of plastics, electrical devices and about everything else our planet is suffering. How can you help? Buy and sell used goods!'
      ];
      $this->view('pages/about', $data);
    }

    public function test($param = ''){
      $data = ['title' => 'Test', 'param' => $param];
      $this->view('pages/test', $data);
    }
  }