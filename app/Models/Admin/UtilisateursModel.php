<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Admin;

use CodeIgniter\Model;
use App\Entities\Utilisateurs;

/**
 * Description of UtilisateursModel
 *
 * @author michel
 */
class UtilisateursModel extends Model {

    protected $table = 'utilisateurs';
    protected $primaryKey = 'id_utilisateurs';
    protected $allowedFields = [
        'pseudo_utilisateurs', 'mdp_utilisateurs', 'email_utilisateurs'
    ];
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];
    protected $returnType = Utilisateurs::Class;

    public function findUtilisateur($identifiant) {

        $query = $this->db->query("SELECT  mdp_utilisateurs as mdp, id_utilisateurs as id FROM utilisateurs WHERE email_utilisateurs = '$identifiant' OR pseudo_utilisateurs = '$identifiant'");
        return $query->getResult();
    }

    protected function hashPassword(array $data) {
        if (!isset($data['data']['mdp_utilisateurs'])) {
            return $data;
        }
        $options = [
            'cost' => 12,
        ];
        $data['data']['mdp_utilisateurs'] = password_hash($data['data']['mdp_utilisateurs'], PASSWORD_BCRYPT, $options);
        return $data;
    }

}
