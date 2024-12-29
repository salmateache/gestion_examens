<?php

namespace App\Models;

use CodeIgniter\Model;

class CompteModel extends Model
{
    protected $table = 'compte';
    protected $primaryKey = 'idCompte';
    protected $allowedFields = ['username', 'password', 'etat', 'idUtilisateur', 'idRole'];
    protected $useTimestamps = false;

    // Récupérer un utilisateur avec son rôle
    public function getUtilisateurById($id)
    {
        return $this->db->table('utilisateur')
                        ->select('utilisateur.*, role.nomRole')
                        ->join('role', 'role.idRole = utilisateur.idRole')
                        ->where('utilisateur.idUtilisateur', $id)
                        ->get()
                        ->getRowArray();
    }

    // Créer un utilisateur
    public function createUtilisateur($data)
    {
        $this->db->table('utilisateur')->insert($data);
        return $this->db->insertID();
    }

    // Créer un compte utilisateur
    public function createCompte($data)
    {
        $this->db->table('compte')->insert($data);
    }
}
