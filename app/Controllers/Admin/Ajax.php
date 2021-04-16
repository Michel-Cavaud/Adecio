<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Entities\UnText;
use App\Models\Admin\ArticlesPagesModel;
use App\Models\ArticlesPagesModel as  ArticlesPagesModelUser;

/**
 * Description of Ajax
 *
 * @author michel
 */
class Ajax extends BaseController{
    
    protected $session;

    function __construct() {

        $this->session = session();
    }
    
    public function changetext(){
        if ($this->request->isAJAX()) {
            $data = $this->request->getVar();
            
            $unText = new UnText();
            $unText->text = $data['textModal'];
            $unText->page = $data['nompage'];
            $unText->position= $data['idtext'];
            
            $articleModel = new ArticlesPagesModel;
            if($articleModel->updateText($unText)){
                
            }else{
                throw new \CodeIgniter\Database\Exceptions\DatabaseException();
            }
            
        }else{
            header("location:" . base_url());
            exit();
        }
        
        $result['csrf_adecio'] = csrf_hash();
        echo json_encode($result);
        
    }
    
    public function enregistrertext(){
        if ($this->request->isAJAX()) {
            $result['erreur'] = true;
            
            $data = $this->request->getVar();
           
            $articleModel = new ArticlesPagesModel();
            $textesPage = $articleModel->findArticlesPage($data['nompage']);
            
            $articleModelUser = new ArticlesPagesModelUser();
            if($articleModelUser->updateTexte($textesPage)){
                $result['erreur'] = false;   
            }
          

        }else{
            header("location:" . base_url());
            exit();
        }
        
        $result['csrf_adecio'] = csrf_hash();
        echo json_encode($result);
        
    }
    
    public function deconnexion() {
        if ($this->request->isAJAX()) {
            $data = $this->request->getVar();
       
            $this->session->destroy();
            
            $result['csrf_adecio'] = csrf_hash();
            echo json_encode($result);
        } else {
            header("location:" . base_url());
            exit();
        }
    }
}
