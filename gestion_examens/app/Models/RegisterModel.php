<?php

namespace App\Models;

use CodeIgniter\Model;

class RegisterModel extends Model
{
    protected $table = 'utilisateur';
    protected $primaryKey = 'idUtilisateur';
    protected $allowedFields = ['nom_complet', 'email', 'dateNaissance', 'idRole'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Règles de validation
    protected $validationRules = [
        'nom_complet' => 'required|string|max_length[100]',
        'email' => 'required|valid_email|is_unique[utilisateur.email]',
        'dateNaissance' => 'required|valid_date',
        'idRole' => 'required|integer',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Cet email est déjà enregistré.'
        ]
    ];

    // Gestionnaires d'événements
    protected $beforeInsert = ['setDefaultRole'];

    protected function setDefaultRole(array $data)
    {
        if (!isset($data['data']['idRole'])) {
            $data['data']['idRole'] = 2; // Rôle par défaut
        }
        return $data;
    }

    // Vérifier si l'email existe déjà
    public function emailExists($email)
    {
        return $this->where('email', $email)->first();
    }
}

