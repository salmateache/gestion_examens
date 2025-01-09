<?php

namespace App\Models;

use CodeIgniter\Model;

class ModuleModel extends Model
{
    protected $table = 'module';
    protected $primaryKey = 'idModule';
    protected $allowedFields = ['nomModule','idfiliere' ,'idProfesseur'];
}