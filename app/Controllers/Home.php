<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
          
		echo view('commun/head.php');
                echo view('commun/header.php');
                echo view('commun/nav.php');
                echo view('home.php');
                echo view('commun/footer.php');
                echo view('commun/copyright.php');
	}
}
