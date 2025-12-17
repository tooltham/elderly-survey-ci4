<?php

namespace App\Models;

use CodeIgniter\Model;

class RespondentDiseaseModel extends Model
{
    // ระบุชื่อตารางให้ถูกต้อง (ต้องมี underscore)
    protected $table            = 'respondent_diseases';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['respondent_id', 'disease_name', 'other_detail'];
}
