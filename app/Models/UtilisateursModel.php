<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of UtilisateursModel
 *
 * @author michel
 */
class UtilisateursModel extends Model{
    
    public function findUtilisateur($identifiant){
        
        $query = $this->db->query("SELECT  mdp_utilisateurs as mdp FROM utilisateurs WHERE email_utilisateurs = '$identifiant' OR pseudo_utilisateurs = '$identifiant'");
        return $query->getResult();
        
    }
}
