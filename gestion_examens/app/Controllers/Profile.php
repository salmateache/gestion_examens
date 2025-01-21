<?php

namespace App\Controllers;

use App\Models\EtudiantModel;
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
            return $this->index2();
        }

        // Charger les modules associés au professeur
        $moduleModel = new ModuleModel();
        $modules = $moduleModel->where('idProfesseur', $professeur['idProfesseur'])->findAll();

        $modulesList = array_map(fn($module) => $module['nomModule'], $modules);

        // Retourner la vue du profil professeur
        return view('users_profile', [
            'professeur' => $professeur,
            'modules' => $modulesList
        ]);
    }

    public function index2()
    {
        $session = session();
        $idUtilisateur = $session->get('idUtilisateur');

        // Vérifiez que l'utilisateur est connecté
        if (!$idUtilisateur) {
            return redirect()->to('/login');
        }

        // Charger le modèle Etudiant
        $etudiantModel = new EtudiantModel();
        $etudiant = $etudiantModel->getEtudiantByIdUtilisateur($idUtilisateur);

        // Retourner la vue du profil étudiant
        return view('profile_etudiant', [
            'etudiant' => $etudiant
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
            'date' => date('Y-m-d') // Date actuelle
        ];

        // Mettre à jour les informations du professeur
        $professeurModel->update($professeur['idProfesseur'], $data);

        // Recharger les modules
        $moduleModel = new ModuleModel();
        $modules = $moduleModel->where('idProfesseur', $professeur['idProfesseur'])->findAll();
        $modulesList = array_map(fn($module) => $module['nomModule'], $modules);

        // Rediriger vers la page de profil avec un message de succès
        $session->setFlashdata('success', 'Profile updated successfully.');
        return view('users_profile', [
            'professeur' => $professeurModel->getProfesseurByIdUtilisateur($idUtilisateur),
            'modules' => $modulesList
        ]);
    }

    public function update2()
    {
        $session = session();
        $idUtilisateur = $session->get('idUtilisateur');

        // Vérifiez que l'utilisateur est connecté
        if (!$idUtilisateur) {
            return redirect()->to('/login');
        }

        // Charger le modèle Etudiant
        $etudiantModel = new EtudiantModel();
        $etudiant = $etudiantModel->getEtudiantByIdUtilisateur($idUtilisateur);

        if (!$etudiant) {
            return redirect()->to('/dashboard')->with('error', 'Étudiant introuvable');
        }

        // Récupérer les données du formulaire
        $data = [
            'prenom' => $this->request->getPost('First'),
            'nom' => $this->request->getPost('Last'),
            'email' => $this->request->getPost('email')
        ];

        // Mettre à jour les informations de l'étudiant
        $etudiantModel->update($etudiant['idEtudiant'], $data);

        // Rediriger vers la page de profil avec un message de succès
        $session->setFlashdata('success', 'Profile updated successfully.');
        return view('profile_etudiant', [
            'etudiant' => $etudiantModel->getEtudiantByIdUtilisateur($idUtilisateur)
        ]);
    }
}
