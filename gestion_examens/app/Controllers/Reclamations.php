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
public function indexProf()
{
    $session = session();
    $idProfesseur = $session->get('idProfesseur'); // Récupérer l'ID du professeur connecté
    $role = $session->get('role'); 

    // Vérification de l'accès : l'utilisateur doit être un professeur (role = 1)
    if (!$idProfesseur || $role != 1) {
        return redirect()->to('/login')->with('error', 'Accès refusé.');
    }

    // Charger le modèle des réclamations
    $reclamationModel = new ReclamationModel();
    
    // Récupérer les réclamations des modules enseignés par le professeur
    $data['reclamations'] = $reclamationModel->getReclamationsProfesseurByIdModule($idProfesseur);

    return view('reclamationsProf', $data);
}
public function updateStatut()
{
    if ($this->request->isAJAX()) {
        $data = $this->request->getJSON();
        $id = $data->id;
        $statut = $data->statut;

        // Charger le modèle et mettre à jour le statut
        $model = new ReclamationModel();
        $update = $model->update($id, ['statut' => $statut]);

        if ($update) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    throw new \CodeIgniter\Exceptions\PageNotFoundException('Page not found');
}
public function download($id)
{
    // Charger le modèle
    $reclamationModel = new \App\Models\ReclamationModel();

    // Récupérer la réclamation
    $reclamation = $reclamationModel->find($id);

    if ($reclamation && isset($reclamation['piece_joinee'])) {
        // Récupérer le contenu du fichier depuis la BD
        $fileContent = $reclamation['piece_joinee'];
        $fileName = $reclamation['file_name'] ?? 'document'; // Nom du fichier (si disponible)
        $mimeType = $reclamation['mime_type'] ?? 'application/octet-stream'; // Type MIME

        // Configurer la réponse
        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'attachment; filename="' . $fileName . '"')
            ->setBody($fileContent);
    }

    // Si le fichier n'est pas trouvé, afficher une erreur
    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
}


}