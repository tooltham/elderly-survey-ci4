<?php

namespace App\Controllers;

use App\Models\RespondentModel;
use App\Models\RespondentDiseaseModel;
use App\Models\RespondentPrepModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $respondentModel = new RespondentModel();

        // --- 1. KPI & General Stats ---
        $totalRespondents = $respondentModel->countAllResults();
        $preparedCount = $respondentModel->where('is_prepared', 1)->countAllResults();
        $preparedPercent = ($totalRespondents > 0) ? ($preparedCount / $totalRespondents) * 100 : 0;

        $queryAvgAge = $db->query("SELECT AVG(age_year) as avg_age FROM respondents");
        $avgAge = $queryAvgAge->getRow()->avg_age ?? 0;

        // --- 2. Prepare Data for All Charts ---

        // 2.1 Gender (เพศ)
        $genderRaw = $this->getChartData($respondentModel, 'gender', ['male' => 'ชาย', 'female' => 'หญิง']);

        // 2.2 Age Group (ช่วงอายุ)
        $sqlAge = "SELECT 
            CASE 
                WHEN age_year < 60 THEN 'ต่ำกว่า 60 ปี'
                WHEN age_year BETWEEN 60 AND 69 THEN '60-69 ปี'
                WHEN age_year BETWEEN 70 AND 79 THEN '70-79 ปี'
                ELSE '80 ปีขึ้นไป' 
            END as age_group, COUNT(*) as count FROM respondents GROUP BY age_group ORDER BY age_group";
        $ageResults = $db->query($sqlAge)->getResultArray();
        $ageLabels = array_column($ageResults, 'age_group');
        $ageData = array_column($ageResults, 'count');

        // 2.3 Socio-Economic
        $maritalRaw = $this->getChartData($respondentModel, 'marital_status', ['single' => 'โสด', 'married' => 'สมรส', 'widowed_divorced' => 'หม้าย/หย่า/แยก']);
        $eduRaw     = $this->getChartData($respondentModel, 'education_level');
        $jobRaw     = $this->getChartData($respondentModel, 'occupation');

        // 2.4 Living Context
        $residenceRaw = $this->getChartData($respondentModel, 'residence_type');
        $householdRaw = $this->getChartData($respondentModel, 'household_type');

        // 2.5 Health Behaviors
        $behaviors = [
            'exercise' => $this->getChartData($respondentModel, 'exercise_freq'),
            'smoking'  => $this->getChartData($respondentModel, 'smoking_status'),
            'alcohol'  => $this->getChartData($respondentModel, 'alcohol_status')
        ];

        // 2.6 Radar (ความพร้อม)
        $prepModel = new RespondentPrepModel();
        $prepResults = $prepModel->select('prep_aspect, COUNT(*) as count')->groupBy('prep_aspect')->findAll();
        $prepMap = ['Health' => 0, 'Economic' => 0, 'Social' => 0, 'Environment' => 0];
        foreach ($prepResults as $row) $prepMap[$row['prep_aspect']] = $row['count'];

        // ส่งข้อมูลไป View
        $data = [
            'total_respondents' => $totalRespondents,
            'avg_age'           => number_format($avgAge, 1),
            'prepared_percent'  => number_format($preparedPercent, 1),
            'gender_labels'     => json_encode($genderRaw['labels']),
            'gender_data'       => json_encode($genderRaw['data']),
            'age_labels'        => json_encode($ageLabels),
            'age_data'          => json_encode($ageData),
            'marital_labels'    => json_encode($maritalRaw['labels']),
            'marital_data'      => json_encode($maritalRaw['data']),
            'edu_labels'        => json_encode($eduRaw['labels']),
            'edu_data'          => json_encode($eduRaw['data']),
            'job_labels'        => json_encode($jobRaw['labels']),
            'job_data'          => json_encode($jobRaw['data']),
            'residence_labels'  => json_encode($residenceRaw['labels']),
            'residence_data'    => json_encode($residenceRaw['data']),
            'household_labels'  => json_encode($householdRaw['labels']),
            'household_data'    => json_encode($householdRaw['data']),
            'behavior_data'     => json_encode($behaviors),
            'radar_labels'      => json_encode(['ด้านสุขภาพ', 'ด้านเศรษฐกิจ', 'ด้านสังคม', 'ด้านสภาพแวดล้อม']),
            'radar_data'        => json_encode(array_values($prepMap)),
        ];

        return view('dashboard/index', $data);
    }

    /**
     * Helper: ดึงข้อมูล Group By สำหรับกราฟ
     */
    private function getChartData($model, $field, $labelMap = [])
    {
        $results = $model->select("$field, count(*) as count")
            ->groupBy($field)
            ->orderBy('count', 'DESC')
            ->findAll();

        $labels = [];
        $data = [];
        foreach ($results as $row) {
            $key = $row[$field];
            $labels[] = $labelMap[$key] ?? $key;
            $data[] = $row['count'];
        }
        return ['labels' => $labels, 'data' => $data];
    }
}
