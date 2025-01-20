<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamenModel extends Model
{
    protected $table = 'examen';
    protected $primaryKey = 'idExamen';

    protected $allowedFields = ['idModule', 'libelleExamen', 'dateExamen'];

    /**
     * Récupérer tous les examens associés à un module spécifique.
     *
     * @param int $idModule
     * @return array
     */
    public function getExamensByModule($idModule)
    {
        return $this->where('idModule', $idModule)->findAll();
    }

    /**
     * Récupérer un examen par son ID.
     *
     * @param int $idExamen
     * @return array|null
     */
    public function getExamenById($idExamen)
    {
        return $this->find($idExamen);
    }

    /**
     * Ajouter un nouvel examen.
     *
     * @param array $data
     * @return int|false
     */
    public function addExamen(array $data)
    {
        if ($this->insert($data)) {
            return $this->insertID();
        }
        return false;
    }

    /**
     * Mettre à jour un examen.
     *
     * @param int $idExamen
     * @param array $data
     * @return bool
     */
    public function updateExamen($idExamen, array $data)
    {
        return $this->update($idExamen, $data);
    }

    /**
     * Supprimer un examen par son ID.
     *
     * @param int $idExamen
     * @return bool
     */
    public function deleteExamenById($idExamen)
    {
        return $this->delete($idExamen);
    }

    /**
     * Récupérer les examens avec les détails du module.
     *
     * @return array
     */
    public function getExamensWithModuleDetails()
    {
        $db = db_connect();

        $query = $db->table('examen e')
            ->select('e.idExamen, e.libelleExamen, e.dateExamen, m.nomModule')
            ->join('module m', 'e.idModule = m.idModule')
            ->get();

        return $query->getResultArray();
    }
}
