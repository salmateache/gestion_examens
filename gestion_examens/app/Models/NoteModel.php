<?php

namespace App\Models;

use CodeIgniter\Model;

class NoteModel extends Model
{
    protected $table = 'note';
    protected $primaryKey = 'idNote';

    protected $allowedFields = ['idEtudiant', 'idExamen', 'note', 'commentaire'];

    /**
     * Récupérer les notes d'un étudiant par son ID.
     *
     * @param int $idEtudiant
     * @return array
     */
    public function getNotesByEtudiant($idEtudiant)
    {
        return $this->where('idEtudiant', $idEtudiant)->findAll();
    }

    /**
     * Récupérer les notes associées à un examen spécifique.
     *
     * @param int $idExamen
     * @return array
     */
    public function getNotesByExamen($idExamen)
    {
        return $this->where('idExamen', $idExamen)->findAll();
    }

    /**
     * Ajouter une nouvelle note.
     *
     * @param array $data
     * @return int|false
     */
  
    /**
     * Mettre à jour une note.
     *
     * @param int $idNote
     * @param array $data
     * @return bool
     */
  

    /**
     * Supprimer une note par son ID.
     *
     * @param int $idNote
     * @return bool
     */

    /**
     * Récupérer les notes avec les détails de l'examen et du module.
     *
     * @param int $idEtudiant
     * @return array
     */
    public function getDetailedNotesByEtudiant($idEtudiant)
    {
        $db = db_connect();

        $query = $db->table('note n')
            ->select('n.idNote, n.note, n.commentaire, e.libelleExamen, m.nomModule')
            ->join('examen e', 'n.idExamen = e.idExamen')
            ->join('module m', 'e.idModule = m.idModule')
            ->where('n.idEtudiant', $idEtudiant)
            ->get();

        return $query->getResultArray();
    }
}
