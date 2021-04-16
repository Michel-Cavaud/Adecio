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
class Admin extends BaseController {
    
     protected $data;
     
     function __construct() {
        $this->session = session();
     }

    public function index() {
        
        if (isset($this->session->connecte) && $this->session->connecte) {
            $this->twig->display('Admin/home.html');
        }else{
             $this->twig->display('Admin/baseLogin.html');
        }
       
    }

    public function postForm() {

        extract($_POST);
        if ($identifiant == "" | $mdp == "") {
            $this->data['isValidI'] = "is-invalid";
            $this->data['isValidMdp'] = "is-invalid";
            $this->twig->display('Admin/baseLogin.html', $this->data);
        }else{
            $userConnect = null;
            $utilisateursModel = new \App\Models\UtilisateursModel;
            $users = $utilisateursModel->findUtilisateur($identifiant);
            foreach($users as $user){
                if(password_verify($mdp, $user->mdp)){
                    $userConnect = $user;
                    break; 
                }
            }
        }

        if($userConnect != null){
            $dataSession = ["connecte" => true];
            $this->session->set($dataSession);
           
            $this->twig->display('Admin/home.html');
        }else{
            $this->data['messageConnexion'] = "Erreur de connexion merci de vérifier vos identifiants !";
            $this->data['couleur'] = "erreurLogin";
            $this->twig->display('Admin/baseLogin.html', $this->data);
        }
        
    }
   

}
