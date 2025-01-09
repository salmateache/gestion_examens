<?php
namespace App\Models;

use CodeIgniter\Model;

class ProfesseurModel extends Model
{
    protected $table = 'professeurs';
    protected $primaryKey = 'id_professeur';

    protected $allowedFields = ['id_utilisateur', 'nom', 'email', 'departement'];

    public function getProfesseurByUtilisateur($idUtilisateur)
    {
        return $this->where('id_utilisateur', $idUtilisateur)->first(); // Récupère la première ligne correspondante
    }
}
