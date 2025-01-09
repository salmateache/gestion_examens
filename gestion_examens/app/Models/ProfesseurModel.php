<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfesseurModel extends Model
{
    protected $table = 'professeur';
    protected $primaryKey = 'idProfesseur';

    protected $allowedFields = ['idUtilisateur', 'nom', 'prenom', 'email','date' ,'departement'];

    public function getProfesseurByIdUtilisateur($idUtilisateur)
{
    $result = $this->where('idUtilisateur', $idUtilisateur)->first();
    
    if (!$result) {
        log_message('error', "Aucun professeur trouvé pour l'idUtilisateur : $idUtilisateur");
    }
    
    return $result;
}


    public function updateProfesseur($idUtilisateur, $data)
    {
        // Trouver le professeur par idUtilisateur et mettre à jour ses données
        return $this->where('idUtilisateur', $idUtilisateur)->set($data)->update();
    }

    public function verifyPassword($idUtilisateur, $currentPassword)
    {
        $db = db_connect();
        $query = $db->table('compte')->where('idUtilisateur', $idUtilisateur)->get();

        if ($query->getNumRows() > 0) {
            $compte = $query->getRow();
            return password_verify($currentPassword, $compte->password);
        }

        return false;
    }

    public function getModulesByProfesseur($idProfesseur)
    {
        $db = db_connect();
        return $db->table('module')
                ->where('idProfesseur', $idProfesseur)
                ->get()
                ->getResultArray();
    }

    public function updatePassword($idUtilisateur, $newPassword)
    {
        $db = db_connect();
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $db->table('compte')
           ->where('idUtilisateur', $idUtilisateur)
           ->update(['password' => $hashedPassword]);
    }
}
