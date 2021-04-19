<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Libraries;

/**
 * Description of RegleMotDePasse
 *
 * @author michel
 */
class RegleMotDePasse {
   
    
    public function valid_password($password = '') {
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[$@$!%*#?&]/';
        if (empty($password)) {
            return FALSE;
        }
        if (preg_match_all($regex_lowercase, $password) < 1) {
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1) {
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1) {
            return FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1) {
            return FALSE;
        }
        if (strlen($password) < 8) {
            return FALSE;
        }
        return TRUE;
    }
}
