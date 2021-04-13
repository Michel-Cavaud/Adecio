<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of ArticlesPagesModel
 *
 * @author michel
 */
class ArticlesPagesModel extends Model{
    
    public function findArticlesPage($page) {
        $query = $this->db->query('SELECT * FROM `view_articles_page` WHERE pages="' . $page . '"');
        return $query->getResult();
    }
    
}
