<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\Admin\UtilisateursModel;
use App\Models\Admin\ArticlesPagesModel;
use \App\Models\ImagesPagesModel;

/**
 * Description of Admin
 *
 * @author michel
 */
class Admin extends BaseController {
    
     protected $data;
     
     function __construct() {
        $this->session = session();
        $this->data['titre'] = 'Admin Adecio';
     }

    public function index() {
        
        if (isset($this->session->connecte) && $this->session->connecte) {
            $articlesPages = new ArticlesPagesModel();
            $imagesPages = new ImagesPagesModel();
            $this->data['nomPage'] = 'home';
            $this->data['articles'] = $articlesPages->findArticlesPage('home');
            $this->data['images'] = $imagesPages->findImagesPage('home');
            $this->twig->display('admin\home.html', $this->data);
        }else{
             $this->twig->display('admin/baseLogin.html');
        }
       
    }

    public function postForm() {

        extract($_POST);
        if ($identifiant == "" | $mdp == "") {
            $this->data['isValidI'] = "is-invalid";
            $this->data['isValidMdp'] = "is-invalid";
            $this->twig->display('admin/baseLogin.html', $this->data);
        }else{
            $userConnect = null;
            $utilisateursModel = new UtilisateursModel();
            $users = $utilisateursModel->findUtilisateur($identifiant);
            foreach($users as $user){
                if(password_verify($mdp, $user->mdp)){
                   
                    $userConnect = $user;
                    break; 
                }
            }
        }

        if($userConnect != null){
            $dataSession = ["connecte" => true, 'user' => $userConnect->id];
            $this->session->set($dataSession);
            $articlesPages = new ArticlesPagesModel();
            $imagesPages = new ImagesPagesModel();
            $this->data['nomPage'] = 'home';
            $this->data['articles'] = $articlesPages->findArticlesPage('home');
            $this->data['images'] = $imagesPages->findImagesPage('home');
            $this->twig->display('admin\home.html', $this->data);
        }else{
            $this->data['messageConnexion'] = "Erreur de connexion merci de vérifier vos identifiants !";
            $this->data['couleur'] = "erreurLogin";
            $this->twig->display('admin/baseLogin.html', $this->data);
        }
        
    }
   

}
