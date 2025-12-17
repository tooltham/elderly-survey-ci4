<?php

namespace App\Models;

use CodeIgniter\Model;

class RespondentPrepModel extends Model
{
    // ระบุชื่อตารางให้ถูกต้อง (ต้องมี underscore)
    protected $table            = 'respondent_preps';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['respondent_id', 'prep_aspect'];
}
