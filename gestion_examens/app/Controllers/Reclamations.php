<?php

namespace App\Controllers;

use App\Models\RegisterModel;
use App\Models\LoginModel;
use App\Models\ReclamationModel;

class Reclamations extends BaseController
{
    public function index()
    {
        // Charger le modèle
        $reclamationModel = new ReclamationModel();

        // Récupérer toutes les réclamations
        $data['reclamations'] = $reclamationModel->getAllReclamations();

        // Charger la vue avec les données
        return view('reclamations', $data);
    }
}
