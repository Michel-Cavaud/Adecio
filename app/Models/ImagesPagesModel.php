<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use CodeIgniter\Model;

use app\Entities\UneImage;

/**
 * Description of ImagesPagesModel
 *
 * @author michel
 */
class ImagesPagesModel extends Model{
    
     protected $table = 'images';
    protected $primaryKey = 'id_images';
    protected $allowedFields = [
        'nom_images', 'ext_images', 'position_images', 'id_pages'
    ];
    protected $returnType = UneImage::Class;
    
    public function findImagesPage($page) {
        $query = $this->db->query('SELECT * FROM `view_images_page` WHERE pages="' . $page . '"');
        return $query->getResult();
    }
    
    public function updateImage($imagesPage) {
        try {
            $this->db->transStart();

            foreach ($imagesPage as $image) {
                $this->update($image->id_images, ['nom_images' => $image->nom, 'ext_images' => $image->ext]);
            }

            $this->db->transComplete();
            $flag = true;
            if (!$this->db->transStatus()) {
                $flag = false;
            }
        } catch (Exception $ex) {
            $flag = false;
        }

        return $flag;
    }
}
