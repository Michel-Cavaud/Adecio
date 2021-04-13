<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers\admin;

use App\Controllers\BaseController;

/**
 * Description of Admin
 *
 * @author michel
 */
class Admin extends BaseController{
    
    public function index(){
         $this->twig->display('Admin/baseLogin.html');
    }
    
    public function postForm(){
        
        var_dump($_POST);
    }
    
}
