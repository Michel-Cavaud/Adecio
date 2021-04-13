<?php

namespace App\Controllers;

use \App\Models\ArticlesPagesModel;

class Home extends BaseController {

    protected $data;

    public function index($page = '', $souspage = '') {
        
        $arrayPages = array('coachingentreprise', 'coachingparticuliers', 'formation', 'adecio', 'contact');
        $arraySousPage= array('coachingindividuel', 'coachingequipes', 'coachingorganisations',
            'formation 1', 'formation 2', 'formation 3', 'formation 4', 'formation 5', 'lacoach', 'lesvaleurs');
          
        $articlesPages = new ArticlesPagesModel();        
     
      $this->data['titre'] = 'Adecio';
        if(in_array($page, $arrayPages) & $souspage == '') {
            $this->data['articles'] = $articlesPages->findArticlesPage($page);
            $this->twig->display('type.html', $this->data);
        }elseif(in_array($page, $arrayPages) & in_array($souspage, $arraySousPage)) {
            $this->data['articles'] = $articlesPages->findArticlesPage($souspage);
             $this->twig->display('type.html', $this->data);
        }else{
            $this->data['articles'] = $articlesPages->findArticlesPage('home');
            $this->twig->display('home.html', $this->data);
        }   
        
        
        
    }
}
