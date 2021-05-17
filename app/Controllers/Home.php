<?php

namespace App\Controllers;

use \App\Models\ArticlesPagesModel;
use \App\Models\ImagesPagesModel;

class Home extends BaseController {

    protected $data;

    public function index($page = '', $souspage = '') {
        
        $this->cachePage(30);

        $arrayPages = array('coachingentreprise', 'coachingparticuliers', 'formations', 'apropos', 'contact', 'mentionslegales');
        $arraySousPage = array('coachingindividuel', 'coachingequipes', 'coachingorganisations',
            'gestiondutemps', 'gestiondesconflits', 'managementniveau1', 'managementniveau2', 'managementadistance', 'formation6');

        $articlesPages = new ArticlesPagesModel();
        $imagesPages = new ImagesPagesModel();

        $this->data['titre'] = 'Adecio';

        if (in_array($page, $arrayPages) & $souspage == '') {
            $this->data['articles'] = $articlesPages->findArticlesPage($page);
            $this->data['images'] = $imagesPages->findImagesPage($page);
            if ($page == 'contact') {
                $this->twig->display('contact.html', $this->data);
            } else if ($page == 'apropos') {
                $this->twig->display('adecio.html', $this->data);
            } else if ($page == 'mentionslegales') {
                $this->twig->display('mentionslegales.html', $this->data);
            } else {
                $this->twig->display('type.html', $this->data);
            }
        } elseif (in_array($page, $arrayPages) & in_array($souspage, $arraySousPage)) {
            $this->data['articles'] = $articlesPages->findArticlesPage($souspage);
            $this->data['images'] = $imagesPages->findImagesPage($souspage);
            if ($page == 'formations') {
                $this->twig->display('typeFormations.html', $this->data);
            } else {
                $this->twig->display('type.html', $this->data);
            }
        } else {
            $this->data['articles'] = $articlesPages->findArticlesPage('home');
            $this->data['images'] = $imagesPages->findImagesPage('home');
            $this->twig->display('home.html', $this->data);
        }
    }

    public function sendEmail() {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $validation->setRules([
                'name' => 'required|string',
                'email' => 'required|valid_email',
                'message' => 'required|string'
            ]);

            $res = $validation->withRequest($this->request)->run();

            if (!$res) {
                $erreurs = $validation->getErrors();
                $i = 0;
                foreach ($erreurs as $key => $erreur) {
                    $result['liste'][$key] = true;
                    $i++;
                }
                $result['erreur'] = true;
                if ($i > 1) {
                    $result['message'] = 'Merci de corriger les erreurs';
                } else {
                    $result['message'] = 'Merci de corriger l\'erreur';
                }
            } else {
                $email = \Config\Services::email();
                $data = $this->request->getVar();

                $email->setFrom('k.corbiere@adecio.fr', 'Site Internet');
                $email->setTo('k.corbiere@adecio.fr');
                $email->setSubject('Message du site');
                $data['message'] = nl2br(stripslashes(strip_tags($data['message'])));
                $message = '<!DOCTYPE html> <html lang="fr"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
                $message .= '<title>Email du site</title></head><body>';
                $message .= '<h4>Un message de : ' . $data['name'] . '</h4>';
                $message .= '<p> Son email : ' . $data['email'] . '</p>';
                $message .= '<p>Son message : </p>';
                $message .= '<p>' . $data['message'] . '</p>';
                $message .= '</body></html>';
                        
                $email->setMessage($message);

                $email->send();
                $result['erreur'] = false;
            }
        }
        $result['csrf_adecio'] = csrf_hash();
        echo json_encode($result);
    }

}
