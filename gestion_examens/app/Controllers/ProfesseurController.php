<?php

namespace App\Controllers;

use App\Models\ProfesseurModel;
use CodeIgniter\Controller;

class ProfesseurController extends Controller
{
    public function profile()
    {
        $session = session();
        $idUtilisateur = $session->get('idUtilisateur'); // Vérifie si l'utilisateur est connecté
    
        // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
        if (empty($idUtilisateur)) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter.');
        }
    
        // Charger le modèle Professeur
        $professeurModel = new ProfesseurModel();
    
        // Récupérer les données du professeur
        $professeur = $professeurModel->getProfesseurByIdUtilisateur($idUtilisateur);
    
        // Si le professeur n'existe pas, rediriger vers la page de connexion
        if (is_null($professeur)) {
            return redirect()->to('/login')->with('error', 'Professeur non trouvé.');
        }
    
        // Récupérer les modules associés au professeur
        $modules = $professeurModel->getModulesByProfesseur($professeur['idProfesseur']);
    
        // Préparer les données à envoyer à la vue
        $data = [
            'professeur' => $professeur,
            'modules' => $modules
        ];
    
        // Retourner la vue avec les données du professeur et des modules
        return view('users_profile', $data);
    }
    
    


    public function updateProfile()
    {
        $session = session();
        $idUtilisateur = $session->get('idUtilisateur');

        // Charger le modèle
        $professeurModel = new ProfesseurModel();

        // Récupérer les données du formulaire
        $data = [
            'nom' => $this->request->getPost('First'),
            'prenom' => $this->request->getPost('Last'),
            'email' => $this->request->getPost('email'),
            'departement' => $this->request->getPost('Department'),
        ];

        // Mettre à jour le profil du professeur
        $professeurModel->updateProfesseur($idUtilisateur, $data);

        // Rediriger avec un message de succès
        return redirect()->to('/professeur/profile')->with('success', 'Profil mis à jour avec succès');
    }

    
}