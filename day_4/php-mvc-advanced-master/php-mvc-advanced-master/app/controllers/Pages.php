<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      if(isLoggedIn()){
        redirect('posts');
      }
      $data = [
        'title' => 'Welcome to PHP MVC Advance Master Application'];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'App to share posts with other users'
      ];

      $this->view('pages/about', $data);
    }

    public function contact(){
      $data = [
          'title' => 'Contact Us',
          'description' => 'You can contact us through this medium'
      ];

      $this->view('pages/contact', $data);
    }
  }