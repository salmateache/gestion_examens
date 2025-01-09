<?php

namespace App\Controllers;

use App\Models\EtudiantModel;

class Note extends BaseController
{

    public function index(): string
    {
        return view('notes');
    }
    public function afficherNotes()
    {
        // Charger le modèle
        $etudiantModel = new EtudiantModel();

        // Récupérer les étudiants et leurs notes
        $etudiantsNotes = $etudiantModel->getEtudiantsNotes();

        // Retourner la vue avec les données
        return view(name: 'etudiants/notes', data: ['etudiantsNotes' => $etudiantsNotes]);
    }
}