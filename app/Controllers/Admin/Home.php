<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\Admin\ArticlesPagesModel;
use App\Models\Admin\ImagesPagesModel;

class Home extends BaseController {

    protected $data;

    function __construct() {
        $this->session = session();
    }

    public function index($page = '', $souspage = '') {
        
        $this->cachePage(1);

        if (!isset($this->session->connecte) && !$this->session->connecte) {
            header("location:" . base_url('admin'));
        } else {

            $arrayPages = array('coachingentreprise', 'coachingparticuliers', 'formations', 'apropos', 'contact');
            $arraySousPage = array('coachingindividuel', 'coachingequipes', 'coachingorganisations',
                'gestiondutemps', 'gestiondesconflits', 'managementniveau1', 'managementniveau2', 'managementadistance', 'formation6');

            $articlesPages = new ArticlesPagesModel();
            $imagesPages = new ImagesPagesModel();

            $this->data['titre'] = 'Admin Adecio';

            if (in_array($page, $arrayPages) & $souspage == '') {
                $this->data['nomPage'] = $page;
                $this->data['articles'] = $articlesPages->findArticlesPage($page);
                $this->data['images'] = $imagesPages->findImagesPage($page);
                if ($page == 'contact') {
                    $this->twig->display('admin/contact.html', $this->data);
                } else if ($page == 'apropos') {
                    $this->twig->display('admin/adecio.html', $this->data);
                }else if ($page == 'formations') {
                    $this->twig->display('/admin/formations.html', $this->data);
                }else {
                    $this->twig->display('admin/type.html', $this->data);
                }
            } elseif (in_array($page, $arrayPages) & in_array($souspage, $arraySousPage)) {
                $this->data['nomPage'] = $souspage;
                $this->data['articles'] = $articlesPages->findArticlesPage($souspage);
                $this->data['images'] = $imagesPages->findImagesPage($souspage);
                if ($page == 'formations') {
                    $this->twig->display('admin/typeFormations.html', $this->data);
                } else {
                    $this->twig->display('admin/type.html', $this->data);
                }
            } else {
                $this->data['nomPage'] = 'home';
                $this->data['articles'] = $articlesPages->findArticlesPage('home');
                $this->data['images'] = $imagesPages->findImagesPage('home');
                $this->twig->display('admin\home.html', $this->data);
            }
        }
    }

}
