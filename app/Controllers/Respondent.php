<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RespondentModel;
use App\Models\RespondentDiseaseModel;
use App\Models\RespondentPrepModel;

class Respondent extends BaseController
{
    // 1. แสดงรายการข้อมูลทั้งหมด (ตาราง)
    public function index()
    {
        $model = new RespondentModel();

        $data = [
            // ดึงข้อมูลทีละ 15 แถว (เรียงจากใหม่สุดไปเก่าสุด)
            //'respondents' => $model->orderBy('id', 'DESC')->paginate(15),
            // เปลี่ยนจาก 'id' เป็น 'paper_id' และเปลี่ยน 'DESC' เป็น 'ASC'
            'respondents' => $model->orderBy('paper_id', 'ASC')->paginate(15),
            'pager' => $model->pager
        ];

        return view('respondents/index', $data);
    }

    // 2. แสดงฟอร์มเพิ่มข้อมูล
    public function create()
    {
        return view('respondents/create');
    }

    // 3. บันทึกข้อมูลลงฐานข้อมูล
    public function store()
    {
        $respondentModel = new RespondentModel();
        $diseaseModel = new RespondentDiseaseModel();
        $prepModel = new RespondentPrepModel();

        // รับค่ารายได้ (ถ้าไม่กรอก ให้เป็น 0)
        $income = $this->request->getVar('income');
        if ($income == "") $income = 0;

        // รับค่าเดือน (ถ้าไม่กรอก ให้เป็น 0)
        $age_month = $this->request->getVar('age_month');
        if ($age_month == "") $age_month = 0;

        // รับค่าข้อมูลส่วนตัว
        $data = [
            'paper_id' => $this->request->getVar('paper_id'),
            'prefix' => $this->request->getVar('prefix'),
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'house_no' => $this->request->getVar('house_no'),
            'village_no' => $this->request->getVar('village_no'),
            'gender' => $this->request->getVar('gender'),
            'age_year' => $this->request->getVar('age_year'),
            'age_month' => $age_month,
            'marital_status' => $this->request->getVar('marital_status'),
            'education_level' => $this->request->getVar('education_level'),
            'occupation' => $this->request->getVar('occupation'),
            'income' => $income, // ใช้ตัวแปรที่เช็คค่าว่างแล้ว

            // ข้อมูลสุขภาพ
            'exercise_freq' => $this->request->getVar('exercise_freq'),
            'smoking_status' => $this->request->getVar('smoking_status'),
            'alcohol_status' => $this->request->getVar('alcohol_status'),

            // ข้อมูลที่อยู่
            'residence_type' => $this->request->getVar('residence_type'),
            'household_type' => $this->request->getVar('household_type'),

            // การเตรียมตัว
            'is_prepared' => $this->request->getVar('is_prepared') ? 1 : 0,
            'created_by' => session()->get('id')
        ];

        // Save ลงตารางหลัก
        $respondentModel->save($data);
        $respondent_id = $respondentModel->getInsertID();

        // จัดการโรคประจำตัว
        $diseases = $this->request->getVar('diseases');
        if ($diseases) {
            foreach ($diseases as $disease) {
                $diseaseModel->save([
                    'respondent_id' => $respondent_id,
                    'disease_name' => $disease
                ]);
            }
        }

        // จัดการด้านที่เตรียมความพร้อม
        $preps = $this->request->getVar('preps');
        if ($preps) {
            foreach ($preps as $prep) {
                $prepModel->save([
                    'respondent_id' => $respondent_id,
                    'prep_aspect' => $prep
                ]);
            }
        }

        return redirect()->to('/dashboard')->with('msg', 'บันทึกข้อมูลสำเร็จ!');
    }

    // 4. แสดงฟอร์มแก้ไขข้อมูล
    public function edit($id = null)
    {
        $respondentModel = new RespondentModel();
        $diseaseModel = new RespondentDiseaseModel();
        $prepModel = new RespondentPrepModel();

        // ดึงข้อมูลคนนั้นๆ
        $data['respondent'] = $respondentModel->find($id);

        // ดึงโรคที่เคยติ๊กไว้ (ส่งไปเป็น Array เพื่อเช็ค Checkbox)
        $diseases = $diseaseModel->where('respondent_id', $id)->findAll();
        $data['my_diseases'] = array_column($diseases, 'disease_name');

        // ดึงการเตรียมตัวที่เคยติ๊กไว้
        $preps = $prepModel->where('respondent_id', $id)->findAll();
        $data['my_preps'] = array_column($preps, 'prep_aspect');

        return view('respondents/edit', $data);
    }

    // 5. อัปเดตข้อมูล (Update)
    public function update($id = null)
    {
        $respondentModel = new RespondentModel();
        $diseaseModel = new RespondentDiseaseModel();
        $prepModel = new RespondentPrepModel();

        // รับค่าและจัดการค่าว่าง (Logic เดียวกับ Store)
        $income = $this->request->getVar('income');
        if ($income == "") $income = 0;

        $age_month = $this->request->getVar('age_month');
        if ($age_month == "") $age_month = 0;

        $data = [
            'paper_id' => $this->request->getVar('paper_id'),
            'prefix' => $this->request->getVar('prefix'),
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'house_no' => $this->request->getVar('house_no'),
            'village_no' => $this->request->getVar('village_no'),
            'gender' => $this->request->getVar('gender'),
            'age_year' => $this->request->getVar('age_year'),
            'age_month' => $age_month,
            'marital_status' => $this->request->getVar('marital_status'),
            'education_level' => $this->request->getVar('education_level'),
            'occupation' => $this->request->getVar('occupation'),
            'income' => $income,
            'exercise_freq' => $this->request->getVar('exercise_freq'),
            'smoking_status' => $this->request->getVar('smoking_status'),
            'alcohol_status' => $this->request->getVar('alcohol_status'),
            'residence_type' => $this->request->getVar('residence_type'),
            'household_type' => $this->request->getVar('household_type'),
            'is_prepared' => $this->request->getVar('is_prepared') ? 1 : 0,
        ];

        // สั่ง Update ตารางหลัก
        $respondentModel->update($id, $data);

        // Update ตารางลูก (ลบของเก่าทิ้งให้หมด แล้วเพิ่มใหม่)
        $diseaseModel->where('respondent_id', $id)->delete();
        $diseases = $this->request->getVar('diseases');
        if ($diseases) {
            foreach ($diseases as $disease) {
                $diseaseModel->save(['respondent_id' => $id, 'disease_name' => $disease]);
            }
        }

        $prepModel->where('respondent_id', $id)->delete();
        $preps = $this->request->getVar('preps');
        if ($preps) {
            foreach ($preps as $prep) {
                $prepModel->save(['respondent_id' => $id, 'prep_aspect' => $prep]);
            }
        }

        return redirect()->to('/respondents')->with('msg', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
    }

    // 6. ลบข้อมูล (Delete)
    public function delete($id = null)
    {
        $respondentModel = new RespondentModel();
        $respondentModel->delete($id);
        return redirect()->to('/respondents')->with('msg', 'ลบข้อมูลเรียบร้อยแล้ว');
    }
}
