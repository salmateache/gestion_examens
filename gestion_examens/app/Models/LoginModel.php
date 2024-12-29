<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    // Nom de la table dans la base de données
    protected $table = 'compte';

    // Clé primaire de la table
    protected $primaryKey = 'idCompte';

    // Champs autorisés pour les insertions et mises à jour
    protected $allowedFields = ['username', 'password', 'etat', 'idUtilisateur', 'idRole'];

    // Définit les règles de validation pour les champs
    protected $validationRules = [
        'username' => 'required|is_unique[compte.username]',  // Nom d'utilisateur requis et unique
        'password' => 'required|min_length[6]',               // Mot de passe requis, min 6 caractères
    ];

    // Messages personnalisés pour la validation
    protected $validationMessages = [
        'username' => [
            'is_unique' => 'Le nom d\'utilisateur est déjà pris. Veuillez en choisir un autre.'
        ],
    ];

    // Active la validation avant insertion ou mise à jour
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    /**
     * Méthode pour hacher le mot de passe avant insertion ou mise à jour.
     *
     * @param array $data Données avant l'insertion/mise à jour.
     * @return array Données avec le mot de passe haché.
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    /**
     * Méthode pour vérifier le mot de passe lors de la connexion.
     *
     * @param string $password        Mot de passe saisi par l'utilisateur.
     * @param string $storedPassword  Mot de passe haché dans la base de données.
     * @return bool
     */
    public function validatePassword($password, $storedPassword)
        {
            return password_verify($password, $storedPassword);
        }
}