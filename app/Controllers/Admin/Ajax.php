<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Entities\UnText;
use App\Entities\Utilisateurs;
use App\Entities\UneImage;
use App\Models\Admin\ArticlesPagesModel;
use App\Models\ArticlesPagesModel as ArticlesPagesModelUser;
use App\Models\Admin\UtilisateursModel;
use App\Models\Admin\ImagesPagesModel;
use App\Models\ImagesPagesModel as ImagesPagesModelUser;

/**
 * Description of Ajax
 *
 * @author michel
 */
class Ajax extends BaseController {

    protected $session;

    function __construct() {

        $this->session = session();
    }

    public function uploadImage() {
        if ($this->request->isAJAX()) {

            $rules = [
                '' => 'uploaded[imageupload]|max_size[imageupload, 2048]'
            ];

            if ($this->validate($rules)) {
                $fichier = $this->request->getFile('imageupload');

                if ($fichier->isValid() && !$fichier->hasMoved()) {
                    $ext = $fichier->getClientExtension();
                    $data = $this->request->getVar();
                    $page = $data['nompage'];
                    $positionImage = $data['idimage'];

                    $fichier->move('./assets/images/upload');
                    $nom = $fichier->getName();
                    $result['nomImage'] = $nom;
                    $uneImage = new UneImage();
                    $uneImage->page = $page;
                    $uneImage->ext = $ext;
                    $uneImage->position = $positionImage;
                    $uneImage->nom = explode('.', $nom)[0];

                    $imageModel = new ImagesPagesModel();
                    if ($imageModel->updateImage($uneImage)) {
                        if($data['nomextimage'] != '' & $data['nomextimage'] != '.'){
                            $repertoireUpload = './assets/images/upload/' . $data['nomextimage'];
                            if (file_exists($repertoireUpload)) {
                                unlink($repertoireUpload);
                            }
                        }
                        
                    } else {
                        throw new \CodeIgniter\Database\Exceptions\DatabaseException();
                    }
                }
            }
        } else {
            header("location:" . base_url());
            exit();
        }

        $result['csrf_adecio'] = csrf_hash();
        echo json_encode($result);
    }

    public function changetext() {
        if ($this->request->isAJAX()) {
            $data = $this->request->getVar();
            //print_r($data);
            $unText = new UnText();
            $unText->text = $data['textModal'];
            $unText->page = $data['nompage'];
            $unText->position = $data['idtext'];

            $articleModel = new ArticlesPagesModel;
            if ($articleModel->updateText($unText)) {
                
            } else {
                throw new \CodeIgniter\Database\Exceptions\DatabaseException();
            }
        } else {
            header("location:" . base_url());
            exit();
        }

        $result['csrf_adecio'] = csrf_hash();
        echo json_encode($result);
    }

    public function enregistrertext() {
        if ($this->request->isAJAX()) {
            $result['erreur'] = true;

            $data = $this->request->getVar();

            $articleModel = new ArticlesPagesModel();
            $textesPage = $articleModel->findArticlesPage($data['nompage']);

            $articleModelUser = new ArticlesPagesModelUser();
            if ($articleModelUser->updateTexte($textesPage)) {
                $result['erreur'] = false;
            }

            if (!$result['erreur']) {
                $imageModel = new ImagesPagesModel();
                $imagesPage = $imageModel->findImagesPage($data['nompage']);
                $imageModelUser = new ImagesPagesModelUser();
                if ($imageModelUser->updateImage($imagesPage)) {
                    $result['erreur'] = false;
                } else {
                    $result['erreur'] = true;
                }
            }
        } else {
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

    public function majmdp() {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $validation->setRules([
                'mdpActuel' => 'required|string',
                'mdpNouveau1' => 'valid_password',
                'mdpNouveau2' => 'required|required_with[mdpNouveau1]|matches[mdpNouveau1]'
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
                $utilisateursModel = new UtilisateursModel();

                $utilisateurs = $utilisateursModel->where('id_utilisateurs', $this->session->user)->find()[0];
                $data = $this->request->getVar();

                if (password_verify($data['mdpActuel'], $utilisateurs->mdp_utilisateurs)) {
                    //if(true){
                    $utilisateur = new Utilisateurs();
                    $utilisateur->id_utilisateurs = $this->session->user;
                    $utilisateur->mdp_utilisateurs = $data['mdpNouveau1'];

                    $utilisateursModel->save($utilisateur);

                    $result['erreur'] = false;

                    $result['message'] = 'Votre mot de passe a bien été changé !';
                    $this->session->destroy();
                } else {
                    $result['erreur'] = true;
                    $result['message'] = 'Votre mot de passe actuel est inconnu !';
                }
            }
        } else {
            header("location:" . base_url());
            exit();
        }
        $result['csrf_adecio'] = csrf_hash();
        echo json_encode($result);
    }

    public function supimage() {
        if ($this->request->isAJAX()) {
            $data = $this->request->getVar();

            $uneImage = new UneImage();
            $uneImage->page = $data['nompage'];
            $uneImage->ext = "";
            $uneImage->position = $data['positionimage'];
            $uneImage->nom = "";

            $imageModel = new ImagesPagesModel();
            if ($imageModel->updateImage($uneImage)) {
                $repertoireUpload = './assets/images/upload/' . $data['nomimage'];
                if (file_exists($repertoireUpload)) {
                    unlink($repertoireUpload);
                }
            } else {
                throw new \CodeIgniter\Database\Exceptions\DatabaseException();
            }
        } else {
            header("location:" . base_url());
            exit();
        }

        $result['csrf_adecio'] = csrf_hash();
        echo json_encode($result);
    }

}
