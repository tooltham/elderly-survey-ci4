<?php

namespace App\Controllers;

use App\Models\RespondentModel;

class Search extends BaseController
{
    public function index()
    {
        $model = new RespondentModel();

        // รับค่าจากฟอร์ม (GET Request)
        $paper_id = $this->request->getGet('paper_id');
        $name = $this->request->getGet('name');
        $village_no = $this->request->getGet('village_no');
        $gender = $this->request->getGet('gender');
        $age_min = $this->request->getGet('age_min');
        $age_max = $this->request->getGet('age_max');
        $disease = $this->request->getGet('disease');
        $is_prepared = $this->request->getGet('is_prepared');

        // เริ่มสร้าง Query Builder
        // (select * from respondents)
        $model->select('respondents.*');

        // 1. ถ้ามีการเลือกโรค (ต้อง Join ตาราง)
        if (!empty($disease)) {
            $model->join('respondent_diseases', 'respondent_diseases.respondent_id = respondents.id')
                ->where('respondent_diseases.disease_name', $disease)
                ->groupBy('respondents.id'); // ป้องกันชื่อซ้ำ
        }

        // 2. กรองตามเงื่อนไขต่างๆ (ถ้ามีการกรอกมา)
        if (!empty($paper_id)) {
            $model->like('paper_id', $paper_id);
        }
        if (!empty($name)) {
            $model->groupStart()
                ->like('first_name', $name)
                ->orLike('last_name', $name)
                ->groupEnd();
        }
        if (!empty($village_no)) {
            $model->where('village_no', $village_no);
        }
        if (!empty($gender)) {
            $model->where('gender', $gender);
        }
        if (!empty($age_min)) {
            $model->where('age_year >=', $age_min);
        }
        if (!empty($age_max)) {
            $model->where('age_year <=', $age_max);
        }
        if ($is_prepared !== null && $is_prepared !== '') {
            $model->where('is_prepared', $is_prepared);
        }

        // ดึงข้อมูล (ถ้ายังไม่กดค้นหา จะแสดง 20 คนล่าสุด)
        // ถ้ากดค้นหาแล้ว จะแสดงทั้งหมดที่เจอ
        $is_search = !empty($_GET); // เช็คว่ามีการส่งค่ามาไหม

        $data = [
            'respondents' => $model->orderBy('paper_id', 'ASC')->paginate(20),
            'pager' => $model->pager,
            'is_search' => $is_search,
            'total_found' => $model->pager->getTotal() // นับจำนวนที่เจอ
        ];

        return view('search/index', $data);
    }
}
