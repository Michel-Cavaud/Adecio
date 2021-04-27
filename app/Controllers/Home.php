<?php

namespace App\Controllers;

use \App\Models\ArticlesPagesModel;
use \App\Models\ImagesPagesModel;

class Home extends BaseController {

    protected $data;

    public function index($page = '', $souspage = '') {

        $arrayPages = array('coachingentreprise', 'coachingparticuliers', 'formations', 'adecio', 'contact');
        $arraySousPage = array('coachingindividuel', 'coachingequipes', 'coachingorganisations',
            'gestiondutemps', 'gestiondesconflits', 'managementniveau1', 'managementniveau2', 'managementadistance', 'formation6');

        $articlesPages = new ArticlesPagesModel();
        $imagesPages = new ImagesPagesModel();

        $this->data['titre'] = 'Adecio';

        if (in_array($page, $arrayPages) & $souspage == '') {
            $this->data['articles'] = $articlesPages->findArticlesPage($page);
            $this->data['images'] = $imagesPages->findImagesPage($page);
            if($page == 'contact'){
                 $this->twig->display('contact.html', $this->data); 
            }else if($page == 'adecio'){
                 $this->twig->display('adecio.html', $this->data); 
            }else{
                $this->twig->display('type.html', $this->data); 
            }
           
        } elseif (in_array($page, $arrayPages) & in_array($souspage, $arraySousPage)) {
            $this->data['articles'] = $articlesPages->findArticlesPage($souspage);
            $this->data['images'] = $imagesPages->findImagesPage($souspage);
            if($page == 'formations'){
                $this->twig->display('typeFormations.html', $this->data);
            }else{
               $this->twig->display('type.html', $this->data); 
            }
            
        } else {
            $this->data['articles'] = $articlesPages->findArticlesPage('home');
            $this->data['images'] = $imagesPages->findImagesPage('home');
            $this->twig->display('home.html', $this->data);
        }
    }

}
