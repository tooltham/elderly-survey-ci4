<?php

namespace App\Models;

use CodeIgniter\Model;

class RespondentModel extends Model
{
    protected $table            = 'respondents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = [
        'paper_id',
        'prefix',
        'first_name',
        'last_name',
        'house_no',
        'village_no',
        'gender',
        'age_year',
        'age_month',
        'marital_status',
        'education_level',
        'occupation',
        'income',
        'exercise_freq',
        'smoking_status',
        'alcohol_status',
        'residence_type',
        'household_type',
        'is_prepared',
        'created_by'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'first_name' => 'required|min_length[2]',
        'last_name'  => 'required|min_length[2]',
        'age_year'   => 'required|numeric',
        'gender'     => 'required'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
}
