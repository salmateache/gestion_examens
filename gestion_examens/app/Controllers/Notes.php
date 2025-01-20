<?php

namespace App\Controllers;

use App\Models\NoteModel;
use App\Models\EtudiantModel;
use CodeIgniter\Controller;

class Notes extends Controller
{
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        if (!session()->has('idUtilisateur')) {
            return redirect()->to('/login'); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        }

        $idUtilisateur = session()->get('idUtilisateur'); // Récupérer l'utilisateur connecté

        // Charger les modèles
        $etudiantModel = new EtudiantModel();
        $noteModel = new NoteModel();

        // Récupérer l'ID de l'étudiant à partir de son idUtilisateur
        $etudiant = $etudiantModel->where('idUtilisateur', $idUtilisateur)->first();

        if (!$etudiant) {
            return redirect()->to('/dashboard')->with('error', 'Aucun étudiant trouvé.'); // Si l'étudiant n'est pas trouvé
        }

        $idEtudiant = $etudiant['idEtudiant'];

        // Récupérer les notes de l'étudiant
        $notes = $noteModel->getDetailedNotesByEtudiant($idEtudiant);

        // Passer les données à la vue
        return view('notes', ['notes' => $notes]);
    }
}
