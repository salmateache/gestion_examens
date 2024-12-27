<?php

namespace App\Controllers;

use App\Models\LoginModel;
use CodeIgniter\Controller;

class Login extends BaseController
{
    public function login()
    {
        // Retourne la vue du formulaire de connexion
        return view('pages-login');
    }

   
}