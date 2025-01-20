<?php

namespace App\Controllers;

use App\Models\NoteModel;
use CodeIgniter\Controller;

class NoteController extends Controller
{
    /**
     * Afficher les notes dans la vue notes.php.
     *
     * @return void
     */
    public function index()
    {
        $noteModel = new NoteModel();

        // Récupérer toutes les notes avec les détails associés
        $data['notes'] = $noteModel->getAllNotesWithDetails();

        // Charger la vue et transmettre les données
        echo view('notes', $data);
    }
}
