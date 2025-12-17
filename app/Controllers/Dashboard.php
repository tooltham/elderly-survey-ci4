<?php

namespace App\Controllers;

use App\Models\RespondentModel;
use App\Models\RespondentDiseaseModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // เช็ค Login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $respondentModel = new RespondentModel();
        $diseaseModel = new RespondentDiseaseModel();
        $db = \Config\Database::connect();

        // 1. ดึงตัวเลขสถิติพื้นฐาน (Card Cards)
        $totalRespondents = $respondentModel->countAllResults();
        $totalMale = $respondentModel->where('gender', 'male')->countAllResults();
        $totalFemale = $respondentModel->where('gender', 'female')->countAllResults();

        // 2. เตรียมข้อมูลกราฟช่วงอายุ (Age Chart)
        // ใช้ Query ดิบ เพื่อจัดกลุ่มอายุแบบกำหนดเอง
        $sqlAge = "SELECT 
            CASE 
                WHEN age_year BETWEEN 50 AND 59 THEN '50-59 ปี'
                WHEN age_year BETWEEN 60 AND 69 THEN '60-69 ปี'
                WHEN age_year BETWEEN 70 AND 79 THEN '70-79 ปี'
                ELSE '80 ปีขึ้นไป' 
            END as age_group,
            COUNT(*) as count
            FROM respondents
            GROUP BY age_group
            ORDER BY age_group";

        $queryAge = $db->query($sqlAge);
        $ageResults = $queryAge->getResultArray();

        // จัด Format ข้อมูลเพื่อส่งให้ Chart.js
        $ageLabels = [];
        $ageData = [];
        foreach ($ageResults as $row) {
            $ageLabels[] = $row['age_group'];
            $ageData[] = $row['count'];
        }

        // 3. เตรียมข้อมูลกราฟโรคประจำตัว (Disease Chart)
        // นับจำนวนคนที่เป็นโรคแต่ละชนิด (เรียงจากมากไปน้อย)
        $diseaseResults = $diseaseModel->select('disease_name, COUNT(*) as count')
            ->groupBy('disease_name')
            ->orderBy('count', 'DESC')
            ->findAll();

        $diseaseLabels = [];
        $diseaseData = [];
        foreach ($diseaseResults as $row) {
            // แปลงชื่อภาษาอังกฤษเป็นไทยให้สวยงาม (ถ้าต้องการ)
            $diseaseName = $row['disease_name'];
            if ($diseaseName == 'None') $diseaseName = 'ไม่มีโรคประจำตัว';
            if ($diseaseName == 'High Blood Pressure') $diseaseName = 'ความดันโลหิตสูง';
            if ($diseaseName == 'Diabetes') $diseaseName = 'เบาหวาน';
            if ($diseaseName == 'Heart Disease') $diseaseName = 'โรคหัวใจ';

            $diseaseLabels[] = $diseaseName;
            $diseaseData[] = $row['count'];
        }

        // ส่งข้อมูลทั้งหมดไปที่ View
        $data = [
            'total_respondents' => $totalRespondents,
            'total_male' => $totalMale,
            'total_female' => $totalFemale,
            'age_labels' => json_encode($ageLabels), // แปลงเป็น JSON ให้ JavaScript อ่านง่าย
            'age_data' => json_encode($ageData),
            'disease_labels' => json_encode($diseaseLabels),
            'disease_data' => json_encode($diseaseData),
        ];

        return view('dashboard/index', $data);
    }
}
