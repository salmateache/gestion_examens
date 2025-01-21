<?php

namespace App\Models;

use CodeIgniter\Model;

class EtudiantModel extends Model
{
    protected $table = 'etudiant';
    protected $primaryKey = 'idEtudiant';
    protected $allowedFields = ['idUtilisateur', 'nom', 'prenom', 'email', 'idFiliere']; // ✅ Ajout de idFiliere
    protected $useTimestamps = false; // Désactiver si non utilisé

    /**
     * Récupère tous les étudiants avec leurs informations utilisateur et filière
     */
    public function getEtudiantsAvecDetails()
    {
        return $this->select('etudiant.idEtudiant, utilisateur.nom_complet, utilisateur.email, utilisateur.dateNaissance, filiere.nomFiliere')
                    ->join('utilisateur', 'utilisateur.idUtilisateur = etudiant.idUtilisateur')
                    ->join('filiere', 'filiere.idFiliere = etudiant.idFiliere', 'left') // ✅ Correction de la jointure
                    ->where('utilisateur.idRole', 2) // ✅ Sélectionne uniquement les étudiants
                    ->findAll();
    }
}
