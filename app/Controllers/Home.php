<?php

namespace App\Controllers;

class Home extends BaseController {

    protected $data;

    public function index($page = '', $souspage = '') {
        switch ($page) {
            case '':
                $this->data['titre'] = 'Adecio';
                $this->twig->display('home.html', $this->data);
                break;
            case 'coachingentreprise':
                switch ($souspage) {
                    case 'coachingindividuel':
                        $this->data['titre'] = 'Adecio';
                        $this->twig->display('type.html', $this->data);
                        break;
                }
        }
    }

    

}
