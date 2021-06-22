<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Admin;

use CodeIgniter\Model;

/**
 * Description of ImagesPagesModel
 *
 * @author michel
 */
class ImagesPagesModel extends Model{
    public function findImagesPage($page) {
        $query = $this->db->query('SELECT * FROM `view_images_page_admin` WHERE pages="' . $page . '"');
        return $query->getResult();
    }
    
    public function updateImage($uneImage) {
        
        try{
            $builder = $this->db->table('pages');
            $builder->where('nom_pages', $uneImage->page);
            $builder->select('id_pages');
            $query = $builder->get();
            $idPage = $query->getRow();


            $builder = $this->db->table('admin_images');
            $data = [
                'nom_admin_images' => $uneImage->nom,
                'ext_admin_images' => $uneImage->ext
            ];
            $builder->where('id_pages', $idPage->id_pages);
            $builder->where('position_admin_images', $uneImage->position);
            $builder->update($data);
            $flag = true;
        } catch (PDOException $e){
            
            $flag = false;
        }
        return $flag;
            
    }
}
