<?php

namespace App\Controllers;

use App\Models\EtudiantModel;

class Profile extends BaseController
{

    public function index(): string
    {
        return view('users_profile');
    }
    
}