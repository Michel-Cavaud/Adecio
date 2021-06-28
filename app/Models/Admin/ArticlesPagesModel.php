<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Admin;

use CodeIgniter\Model;

/**
 * Description of ArticlesPagesModel
 *
 * @author michel
 */
class ArticlesPagesModel extends Model {

    protected $table = 'admin_articles';
    protected $primaryKey = 'id_admin_articles';
    protected $allowedFields = [
        'articles_admin_articles', 'position_admin_articles', 'id_pages'
    ];

    public function updateText($unText) {
        
        try{
            $builder = $this->db->table('pages');
            $builder->where('nom_pages', $unText->page);
            $builder->select('id_pages');
            $query = $builder->get();
            $idPage = $query->getRow();
            //print_r($unText);

            $builder = $this->db->table('admin_articles');
            $data = [
                'articles_admin_articles' => $unText->text,
            ];
            $builder->where('id_pages', $idPage->id_pages);
            $builder->where('position_admin_articles', $unText->position);
            $builder->update($data);
            $flag = true;
        } catch (PDOException $e){
            
            $flag = false;
        }
        return $flag;
            
    }

    public function findArticlesPage($page) {
        $query = $this->db->query('SELECT * FROM `view_articles_page_admin` WHERE pages="' . $page . '"');
        return $query->getResult();
    }

}
