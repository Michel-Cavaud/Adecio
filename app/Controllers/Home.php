<?php

namespace App\Controllers;

class Home extends BaseController{
    
     protected $data;
     
     
    public function index(){
        $this->data['titre'] = 'Adecio';
        $this->twig->display('home.html', $this->data);
    }
}
