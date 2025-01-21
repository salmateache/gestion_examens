<?php

namespace App\Controllers;

use App\Models\NoteModel;
use App\Models\EtudiantModel;
use App\Models\ReclamationModel; 
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
    public function submitReclamation() {
        // Récupérer les données du formulaire
        $idEtudiant = $this->request->getPost('id_etudiant');
        $module = $this->request->getPost('module');
        $examen = $this->request->getPost('examen');
        $justification = $this->request->getPost('justification');
        $pieceJointe = $this->request->getFile('pieceJointe');
    
        // Récupérer l'id du module et de l'examen
        $moduleModel = new \App\Models\ModuleModel();
        $examenModel = new \App\Models\ExamenModel();

        $moduleResult = $moduleModel->where('nomModule', $module)->first();
        $examenResult = $examenModel->where('libelleExamen', $examen)->first();
        
        // Vérifier que les résultats ne sont pas null avant d'y accéder
        if ($moduleResult && $examenResult) {
            $idModule = $moduleResult['idModule'];
            $idExamen = $examenResult['idExamen'];
        } else {
            // Gérer le cas où les modules ou examens ne sont pas trouvés
            log_message('error', 'Module ou examen introuvable.');
            return redirect()->to('/notes')->with('message', 'Erreur : Module ou examen introuvable.');
        }
    
        // Gérer la pièce jointe (si elle est présente)
        $pieceJointePath = '';
        if ($pieceJointe && $pieceJointe->isValid()) {
            $pieceJointePath = $pieceJointe->store();  // Enregistre la pièce jointe dans le dossier 'uploads'
        }
    
        // Créer une nouvelle réclamation
        $reclamationModel = new \App\Models\ReclamationModel();
        $data = [
            'id_etudiant' => $idEtudiant,
            'id_module' => $idModule,
            'id_examen' => $idExamen,
            'justification' => $justification,
            'piece_joinee' => $pieceJointePath,
            'date_reclamation' => date('Y-m-d H:i:s'),
            'statut' => 'En attente' // Statut initial
        ];
    
        // Insérer la réclamation dans la base de données
        $reclamationModel->save($data);
    
        // Retourner un message de succès
        return redirect()->to('/notes')->with('message', 'Réclamation soumise avec succès');
    }
    
}
