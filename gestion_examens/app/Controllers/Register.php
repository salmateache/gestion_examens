<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use App\Models\RegistereModel;

class Register extends BaseController
{
    public function register()
    {
        return view('pages-register');  // Assurez-vous que la vue est correcte
    }

    public function createAccount()
{
    // Validate form input
    if (!$this->validate([
        'name' => 'required',
        'email' => 'required|valid_email',
        'username' => 'required',
        'password' => 'required|min_length[6]',
        'birthdate' => 'required',
        'status' => 'required',
        'terms' => 'required'  // Check if terms is required
    ])) {
        return redirect()->back()->withInput()->with('error', 'You must agree to the terms and conditions.');
    }

    // Proceed with account creation
    $name = $this->request->getPost('name');
    $email = $this->request->getPost('email');
    $username = $this->request->getPost('username');
    $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
    $birthdate = $this->request->getPost('birthdate');
    $status = "Active";

    // Save to the database
    $userModel = new UserModel();
    $userModel->save([
        'name' => $name,
        'email' => $email,
        'username' => $username,
        'password' => $password,
        'birthdate' => $birthdate,
        'status' => $status,
    ]);

    return redirect()->to(base_url('login'))->with('success', 'Account created successfully!');
}
   
}
