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
    protected $afterInsert = ['createProfesseur'];

    protected function setDefaultRole(array $data)
    {
        if (!isset($data['data']['idRole'])) {
            // Vérifie si le rôle est "professeur" (assurez-vous que 'role' est dans les données)
            if (isset($data['data']['role']) && strtolower($data['data']['role']) === 'professeur') {
                $data['data']['idRole'] = 1; // ID de rôle pour "professeur"
            } else {
                $data['data']['idRole'] = 2; // Rôle par défaut pour "étudiant"
            }
        }

        return $data;
    }

    // Insérer un professeur dans la table 'professeur' après l'insertion de l'utilisateur
    protected function createProfesseur(array $data)
    {
        // Récupérer l'ID de l'utilisateur inséré
        $idUtilisateur = $data['id'];

        // Vérifier si l'utilisateur a le rôle de professeur
        if (isset($data['data']['idRole']) && $data['data']['idRole'] === 1) {
            // Données à insérer dans la table 'professeur'
            $professeurData = [
                'idUtilisateur' => $idUtilisateur,
                'nom' => $data['data']['nom_complet'],  // Par exemple, vous pouvez diviser 'nom_complet' en nom et prénom si vous le souhaitez
                'prenom' => '',  // Vous pouvez ajouter un champ spécifique pour le prénom si nécessaire
                'email' => $data['data']['email'],
                'date' => date('Y-m-d'),  // Date actuelle
                'departement' => 'Informatique',  // Exemple de département, vous pouvez ajuster selon les besoins
            ];

            // Insérer dans la table professeur
            $professeurModel = new ProfesseurModel();
            $professeurModel->insert($professeurData);
        }

        return $data;
    }
    protected function createEtudiant(array $data)
        {
            // Récupérer l'ID de l'utilisateur inséré
            $idUtilisateur = $data['id'];

            // Vérifier si l'utilisateur a le rôle d'étudiant (idRole === 2 ou un autre idRole si nécessaire)
            if (isset($data['data']['idRole']) && $data['data']['idRole'] === 2) {
                // Vérifier si l'idFiliere, nom, prenom, et email sont présents dans les données
                if (isset($data['data']['idFiliere'], $data['data']['nom'], $data['data']['prenom'], $data['data']['email'])) {
                    // Données à insérer dans la table 'etudiant'
                    $etudiantData = [
                        'idUtilisateur' => $idUtilisateur,
                        'nom' => $data['data']['nom'],          // Récupérer le nom de l'étudiant
                        'prenom' => $data['data']['prenom'],    // Récupérer le prénom de l'étudiant
                        'email' => $data['data']['email'],      // Récupérer l'email de l'étudiant
                        'idFiliere' => $data['data']['idFiliere'], // Récupérer l'ID de la filière
                    ];

                    // Insérer dans la table 'etudiant'
                    $etudiantModel = new \App\Models\EtudiantModel();
                    $etudiantModel->insert($etudiantData);
                } else {
                    // Si l'un des champs nécessaires n'est pas présent, on peut retourner une erreur ou une exception
                    throw new \Exception("Les informations de l'étudiant (nom, prénom, email, et idFiliere) sont requises.");
                }
            } else {
                // Si l'utilisateur n'a pas le rôle d'étudiant, on peut gérer l'erreur
                throw new \Exception("L'utilisateur n'a pas le rôle d'étudiant.");
            }
        }


    // Vérifier si l'email existe déjà
    public function emailExists($email)
    {
        return $this->where('email', $email)->first();
    }
}