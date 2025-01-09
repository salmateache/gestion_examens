<?php
namespace App\Controllers;

use App\Models\ProfesseurModel;

class Profile extends BaseController
{
    public function index()
    {
        // Initialiser le modèle
        $professeurModel = new ProfesseurModel();

        // Récupérer l'ID de l'utilisateur connecté depuis la session
        $idUtilisateur = session()->get('idUtilisateur');

        // Vérifier si l'ID de l'utilisateur existe
        if (!$idUtilisateur) {
            return redirect()->to('/login');  // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        }

        // Récupérer les informations du professeur
        $professeur = $professeurModel->getProfesseurByUtilisateur($idUtilisateur);

        // Vérifier si un professeur a été trouvé
        if (!$professeur) {
            return redirect()->to('/profile/create');  // Rediriger si le professeur n'est pas trouvé
        }

        // Passer les données à la vue
        return view('users_profile', ['professeur' => $professeur]);
    }
}
