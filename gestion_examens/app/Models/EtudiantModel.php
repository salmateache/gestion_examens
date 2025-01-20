<?php

namespace App\Models;

use CodeIgniter\Model;

class EtudiantModel extends Model
{
    protected $table = 'etudiant';
    protected $primaryKey = 'idEtudiant';
    protected $allowedFields = ['idUtilisateur', 'nom', 'prenom', 'email'];
    // Désactiver les timestamps si non utilisés
    protected $useTimestamps = false;

    /**
     * Récupère tous les étudiants avec leurs informations d'utilisateur et de filière
     */
    public function getEtudiantsAvecDetails()
    {
        return $this->select('etudiant.idEtudiant, utilisateur.nom_complet, utilisateur.email, utilisateur.dateNaissance, filiere.nomFiliere')
                    ->join('utilisateur', 'utilisateur.idUtilisateur = etudiant.idUtilisateur')
                    ->join('filiere', 'filiere.idFiliere = etudiant.idFiliere', 'left')
                    ->where('utilisateur.idRole', 2)  // Filtrer pour ne prendre que les utilisateurs ayant idRole = 2
                    ->findAll();
    }
}