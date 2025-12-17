<?php

namespace App\Models;

use CodeIgniter\Model;

class RespondentModel extends Model
{
    protected $table            = 'respondents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
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
    protected $useTimestamps    = true;
}
