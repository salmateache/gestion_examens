<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ReclamationModel extends Model
{
    protected $table = 'reclamation';
    protected $primaryKey = 'idReclamation';

    protected $allowedFields = [
        'id_etudiant',
        'id_module',
        'id_examen',
        'justification',
        'piece_joinee',
        'date_reclamation',
        'statut'
    ];

    /**
     * Récupérer toutes les réclamations.
     *
     * @return array
     */
   public function getAllReclamations()
{
    $db = \Config\Database::connect();

    // Écriture de la requête SQL avec jointure explicite
    $sql = "SELECT r.*, COALESCE(e.libelleExamen, 'Non spécifié') AS libelleExamen
            FROM reclamation r
            LEFT JOIN examen e ON r.id_examen = e.idExamen";
    
    // Exécution de la requête
    $query = $db->query($sql);
    
    // Récupérer les résultats sous forme de tableau associatif
    return $query->getResultArray();
}


    /**
     * Récupérer une réclamation par son ID.
     *
     * @param int $idReclamation
     * @return array|null
     */
    public function getReclamationById($idReclamation)
    {
        return $this->find($idReclamation);
    }


    public function getReclamationsByEtudiant($id_etudiant)
    {
        $db = \Config\Database::connect();
    
        $sql = "SELECT r.*, 
                       COALESCE(e.libelleExamen, 'Non spécifié') AS libelleExamen,
                       COALESCE(m.nomModule, 'Non spécifié') AS nomModule
                FROM reclamation r
                LEFT JOIN examen e ON r.id_examen = e.idExamen
                LEFT JOIN module m ON r.id_module = m.idModule
                WHERE r.id_etudiant = ?";
    
        $query = $db->query($sql, [$id_etudiant]);
    
        return $query->getResultArray();
    }
    


public function getReclamationsProfesseurByIdModule($idProfesseur)
{
    return $this->select('
            reclamation.*, 
            module.nomModule AS libelleModule, 
            etudiant.nom AS nomEtudiant, 
            etudiant.prenom AS prenomEtudiant, 
            examen.libelleExamen, 
            note.note
        ')
        ->join('module', 'reclamation.id_module = module.idModule')
        ->join('etudiant', 'reclamation.id_etudiant = etudiant.idEtudiant')
        ->join('examen', 'reclamation.id_examen = examen.idExamen', 'left')
        ->join('note', 'note.idExamen = examen.idExamen AND note.idEtudiant = etudiant.idEtudiant', 'left')
        ->where('module.idProfesseur', $idProfesseur)
        ->findAll();
}





    /**
     * Ajouter une nouvelle réclamation.
     *
     * @param array $data
     * @return int|false
     * @throws Exception
     */
    public function addReclamation(array $data)
    {
        // Vérification que 'id_etudiant' est bien défini
        if (empty($data['id_etudiant'])) {
            throw new Exception('L\'ID étudiant est requis.');
        }

        // Préparation de la requête d'insertion avec une requête préparée pour éviter les injections SQL
        $query = "INSERT INTO reclamation (id_etudiant, id_module, id_examen, justification, piece_joinee, date_reclamation, statut) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Exécution de la requête
        $this->db->query($query, [
            $data['id_etudiant'], 
            $data['id_module'], 
            $data['id_examen'], 
            $data['justification'], 
            $data['piece_joinee'], 
            $data['date_reclamation'], 
            $data['statut']
        ]);

        return $this->db->insertID();  // Retourne l'ID de l'insertion
    }

    /**
     * Mettre à jour une réclamation existante.
     *
     * @param int $idReclamation
     * @param array $data
     * @return bool
     */
    public function updateReclamation($idReclamation, array $data)
    {
        return $this->update($idReclamation, $data);
    }

    /**
     * Supprimer une réclamation par son ID.
     *
     * @param int $idReclamation
     * @return bool
     */
    public function deleteReclamationById($idReclamation)
    {
        return $this->delete($idReclamation);
    }

    /**
     * Récupérer toutes les réclamations avec les détails de l'étudiant, du module et de l'examen.
     *
     * @return array
     */
    public function getReclamationsWithDetails()
    {
        $db = db_connect();

        $query = $db->table('reclamation r')
            ->select('r.idReclamation, r.justification, r.piece_joinee, r.date_reclamation, r.statut, 
                      e.nom AS nomEtudiant, m.nomModule, ex.libelleExamen')
            ->join('etudiant e', 'r.id_etudiant = e.id', 'left')
            ->join('module m', 'r.id_module = m.id', 'left')
            ->join('examen ex', 'r.id_examen = ex.id', 'left')
            ->get();

        return $query->getResultArray();
    }
}