<?php

namespace App\Models;

use CodeIgniter\Model;

class NoteModel extends Model
{
    protected $table = 'note';
    protected $primaryKey = 'idNote';
    protected $allowedFields = ['idExamen', 'idEtudiant', 'note', 'commentaire'];

    // Fonction pour récupérer les notes détaillées (avec module et examen)
    public function getDetailedNotesByEtudiant($idEtudiant)
        {
            return $this->select('module.nomModule, examen.libelleExamen, note.note, note.commentaire, etudiant.idEtudiant') // jointure avec la table 'etudiant'
                ->join('examen', 'examen.idExamen = note.idExamen')
                ->join('module', 'module.idModule = examen.idModule')
                ->join('etudiant', 'etudiant.idEtudiant = note.idEtudiant') // Ajoutez cette jointure si 'idEtudiant' est dans la table 'etudiant'
                ->where('note.idEtudiant', $idEtudiant)
                ->findAll();
        }

    
    
}