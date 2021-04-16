<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\UnText;

/**
 * Description of ArticlesPagesModel
 *
 * @author michel
 */
class ArticlesPagesModel extends Model {

    protected $table = 'articles';
    protected $primaryKey = 'id_articles';
    protected $allowedFields = [
        'article_articles', 'position_articles', 'id_pages'
    ];
    protected $returnType = UnText::Class;

    public function findArticlesPage($page) {
        $query = $this->db->query('SELECT * FROM `view_articles_page` WHERE pages="' . $page . '"');
        return $query->getResult();
    }

    public function updateTexte($textesPage) {
        try {
            $this->db->transStart();

            foreach ($textesPage as $texte) {
                $this->update($texte->id_articles, ['article_articles' => $texte->articles]);
            }

            $this->db->transComplete();
            $flag = true;
            if (!$this->db->transStatus()) {
                $flag = false;
            }
        } catch (Exception $ex) {
            $flag = false;
        }


        if (!$this->db->transStatus()) {
            $flag = false;
        }

        return $flag;
    }

}
