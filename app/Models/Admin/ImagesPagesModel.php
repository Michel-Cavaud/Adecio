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
}
