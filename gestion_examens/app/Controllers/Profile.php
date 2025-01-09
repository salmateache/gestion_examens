<?php

namespace App\Controllers;

use App\Models\ProfesseurModel;
use App\Models\ModuleModel;

class Profile extends BaseController
{
    public function index()
    {
        $session = session();
        $idUtilisateur = $session->get('idUtilisateur');

        // Vérifiez que l'utilisateur est connecté
        if (!$idUtilisateur) {
            return redirect()->to('/login');
        }

        // Charger le modèle Professeur
        $professeurModel = new ProfesseurModel();
        $professeur = $professeurModel->getProfesseurByIdUtilisateur($idUtilisateur);

        if (!$professeur) {
            return redirect()->to('/dashboard')->with('error', 'Professeur introuvable');
        }

        // Charger le modèle Module
        $moduleModel = new ModuleModel();
        $modules = $moduleModel->where('idProfesseur', $professeur['idProfesseur'])->findAll();

        // Passer les modules à la vue
        $modulesList = array_map(fn($module) => $module['nomModule'], $modules);

        // Passer les données à la vue
        return view('users_profile', [
            'professeur' => $professeur,
            'modules' => $modulesList
        ]);
    }


    public function update()
    {
        $session = session();
        $idUtilisateur = $session->get('idUtilisateur');
    
        // Vérifiez que l'utilisateur est connecté
        if (!$idUtilisateur) {
            return redirect()->to('/login');
        }
    
        // Charger le modèle Professeur
        $professeurModel = new ProfesseurModel();
        $professeur = $professeurModel->getProfesseurByIdUtilisateur($idUtilisateur);
    
        if (!$professeur) {
            return redirect()->to('/dashboard')->with('error', 'Professeur introuvable');
        }
    
        // Récupérer les données du formulaire
        $data = [
            'prenom' => $this->request->getPost('First'),
            'nom' => $this->request->getPost('Last'),
            'departement' => $this->request->getPost('Department'),
            'email' => $this->request->getPost('email'),
            'date' => date('Y-m-d') // Ajouter la date du jour
        ];
    
        // Mettre à jour les informations du professeur
        $professeurModel->update($professeur['idProfesseur'], $data);
    
        // Charger le modèle Module
        $moduleModel = new ModuleModel();
        $modules = $moduleModel->where('idProfesseur', $professeur['idProfesseur'])->findAll();
    
        // Passer les modules à la vue
        $modulesList = array_map(fn($module) => $module['nomModule'], $modules);
    
        // Rediriger vers la page de profil avec un message de succès
        $session->setFlashdata('success', 'Profile updated successfully.');
        return view('users_profile', [
            'professeur' => $professeurModel->getProfesseurByIdUtilisateur($idUtilisateur),
            'modules' => $modulesList
        ]);
    }
    
    
}
