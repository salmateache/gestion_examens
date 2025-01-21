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
    protected $afterInsert = ['createProfesseur', 'createEtudiant']; // ✅ Ajouter createEtudiant ici

    protected function setDefaultRole(array $data)
    {
        if (!isset($data['data']['idRole'])) {
            if (isset($data['data']['role']) && strtolower($data['data']['role']) === 'professeur') {
                $data['data']['idRole'] = 1;
            } else {
                $data['data']['idRole'] = 2;
            }
        }
        return $data;
    }

    protected function createProfesseur(array $data)
    {
        if (!isset($data['id']) || !isset($data['data']['idRole']) || $data['data']['idRole'] !== 1) {
            return $data;
        }

        $idUtilisateur = $data['id'];
        $nomComplet = $data['data']['nom_complet'];
        $nomPrenom = explode(' ', $nomComplet, 2);
        $prenom = $nomPrenom[0];
        $nom = isset($nomPrenom[1]) ? $nomPrenom[1] : '';

        $professeurModel = new \App\Models\ProfesseurModel();
        $professeurModel->insert([
            'idUtilisateur' => $idUtilisateur,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $data['data']['email'],
            'date' => date('Y-m-d'),
            'departement' => 'Informatique',
        ]);

        return $data;
    }

    protected function createEtudiant(array $data)
    {
        if (!isset($data['id']) || !isset($data['data']['idRole']) || $data['data']['idRole'] !== 2) {
            return $data;
        }

        $idUtilisateur = $data['id'];
        $nomComplet = $data['data']['nom_complet'];
        $email = $data['data']['email'];

        // Séparer le nom et le prénom
        $nomPrenom = explode(' ', $nomComplet, 2);
        $prenom = $nomPrenom[0];
        $nom = isset($nomPrenom[1]) ? $nomPrenom[1] : '';

        // ✅ Assurer que idFiliere est bien défini et non null
        $idFiliere = 1;

        $etudiantModel = new \App\Models\EtudiantModel();
        $etudiantModel->insert([
            'idUtilisateur' => $idUtilisateur,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'idFiliere' => $idFiliere, // ✅ Correction ici
        ]);

        return $data;
    }

    public function emailExists($email)
    {
        return $this->where('email', $email)->first();
    }
}
