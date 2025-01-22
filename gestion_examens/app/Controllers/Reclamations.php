<?php

namespace App\Controllers;

use App\Models\RegisterModel;
use App\Models\LoginModel;
use App\Models\ReclamationModel;

class Reclamations extends BaseController
{
    public function index()
{
    // Vérifier si l'utilisateur est connecté et récupérer son ID
    $session = session();
    $id_etudiant = $session->get('idEtudiant'); 

    if (!$id_etudiant) {
        return redirect()->to('/login'); // Redirection si l'étudiant n'est pas connecté
    }

    // Charger le modèle
    $reclamationModel = new ReclamationModel();

    // Récupérer les réclamations de l'étudiant connecté
    $data['reclamations'] = $reclamationModel->getReclamationsByEtudiant($id_etudiant);

    // Charger la vue avec les données
    return view('reclamations', $data);
}

}
