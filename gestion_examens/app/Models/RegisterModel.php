<?php

namespace App\Models;

use CodeIgniter\Model;

class RegisterModel extends Model
{
    protected $table = 'utilisateur';
    protected $primaryKey = 'idUtilisateur';
    protected $allowedFields = ['nom_complet', 'email', 'dateNaissance', 'idRole'];
    protected $useTimestamps = false;

    // Vérifier si l'email existe déjà
    public function emailExists($email)
    {
        return $this->where('email', $email)->first();
    }

    // Créer un utilisateur
    public function createUser($data)
    {
        return $this->insert($data);
    }
}
