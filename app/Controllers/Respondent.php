<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RespondentModel;
use App\Models\RespondentDiseaseModel;
use App\Models\RespondentPrepModel;

class Respondent extends BaseController
{
    protected $rules = [
        'paper_id'        => 'required|alpha_numeric_space|max_length[50]',
        'prefix'          => 'required',
        'first_name'      => 'required|min_length[2]|max_length[100]',
        'last_name'       => 'required|min_length[2]|max_length[100]',
        'house_no'        => 'required',
        'village_no'      => 'required|numeric',
        'age_year'        => 'required|numeric|greater_than[0]',
        'gender'          => 'required|in_list[male,female]',
        'marital_status'  => 'required',
        'education_level' => 'required',
        'occupation'      => 'required',
    ];

    // 1. แสดงรายการข้อมูลทั้งหมด (ตาราง)
    public function index()
    {
        $model = new RespondentModel();

        $data = [
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

    // Helper: แมปข้อมูลจาก request
    private function mapData()
    {
        $income = $this->request->getVar('income');
        if ($income == "" || $income === null) $income = 0;

        $age_month = $this->request->getVar('age_month');
        if ($age_month == "" || $age_month === null) $age_month = 0;

        return [
            'paper_id'        => $this->request->getVar('paper_id'),
            'prefix'          => $this->request->getVar('prefix'),
            'first_name'      => $this->request->getVar('first_name'),
            'last_name'       => $this->request->getVar('last_name'),
            'house_no'        => $this->request->getVar('house_no'),
            'village_no'      => $this->request->getVar('village_no'),
            'gender'          => $this->request->getVar('gender'),
            'age_year'        => $this->request->getVar('age_year'),
            'age_month'       => $age_month,
            'marital_status'  => $this->request->getVar('marital_status'),
            'education_level' => $this->request->getVar('education_level'),
            'occupation'      => $this->request->getVar('occupation'),
            'income'          => $income,
            'exercise_freq'   => $this->request->getVar('exercise_freq'),
            'smoking_status'  => $this->request->getVar('smoking_status'),
            'alcohol_status'  => $this->request->getVar('alcohol_status'),
            'residence_type'  => $this->request->getVar('residence_type'),
            'household_type'  => $this->request->getVar('household_type'),
            'is_prepared'     => $this->request->getVar('is_prepared') ? 1 : 0,
        ];
    }

    // 3. บันทึกข้อมูลลงฐานข้อมูล
    public function store()
    {
        if (!$this->validate($this->rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $respondentModel = new RespondentModel();
        $diseaseModel = new RespondentDiseaseModel();
        $prepModel = new RespondentPrepModel();

        $db->transStart();

        $data = $this->mapData();
        $data['created_by'] = session()->get('id');

        $respondentModel->save($data);
        $respondent_id = $respondentModel->getInsertID();

        // จัดการโรคประจำตัว
        $diseases = $this->request->getVar('diseases');
        if ($diseases) {
            foreach ($diseases as $disease) {
                $diseaseModel->save(['respondent_id' => $respondent_id, 'disease_name' => $disease]);
            }
        }

        // จัดการด้านที่เตรียมความพร้อม
        if ($data['is_prepared']) {
            $preps = $this->request->getVar('preps');
            if ($preps) {
                foreach ($preps as $prep) {
                    $prepModel->save(['respondent_id' => $respondent_id, 'prep_aspect' => $prep]);
                }
            }
        }

        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            return redirect()->back()->withInput()->with('error', 'ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
        }

        return redirect()->to('/dashboard')->with('msg', 'บันทึกข้อมูลสำเร็จ!');
    }

    // 4. แสดงฟอร์มแก้ไขข้อมูล
    public function edit($id = null)
    {
        $respondentModel = new RespondentModel();
        $data['respondent'] = $respondentModel->find($id);

        if (!$data['respondent']) {
            return redirect()->to('/respondents')->with('error', 'ไม่พบข้อมูลผู้ตอบแบบสอบถาม');
        }

        $diseaseModel = new RespondentDiseaseModel();
        $prepModel = new RespondentPrepModel();

        $diseases = $diseaseModel->where('respondent_id', $id)->findAll();
        $data['my_diseases'] = array_column($diseases, 'disease_name');

        $preps = $prepModel->where('respondent_id', $id)->findAll();
        $data['my_preps'] = array_column($preps, 'prep_aspect');

        return view('respondents/edit', $data);
    }

    // 5. อัปเดตข้อมูล (Update)
    public function update($id = null)
    {
        if (!$this->validate($this->rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $respondentModel = new RespondentModel();
        $diseaseModel = new RespondentDiseaseModel();
        $prepModel = new RespondentPrepModel();

        $db->transStart();

        $data = $this->mapData();
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
        if ($data['is_prepared']) {
            $preps = $this->request->getVar('preps');
            if ($preps) {
                foreach ($preps as $prep) {
                    $prepModel->save(['respondent_id' => $id, 'prep_aspect' => $prep]);
                }
            }
        }

        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            return redirect()->back()->withInput()->with('error', 'ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
        }

        return redirect()->to('/respondents')->with('msg', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
    }

    // 6. ลบข้อมูล (Delete)
    public function delete($id = null)
    {
        $db = \Config\Database::connect();
        $respondentModel = new RespondentModel();
        $diseaseModel = new RespondentDiseaseModel();
        $prepModel = new RespondentPrepModel();

        $db->transStart();

        // ลบข้อมูลที่เกี่ยวข้องก่อน (Cascade Delete manual)
        $diseaseModel->where('respondent_id', $id)->delete();
        $prepModel->where('respondent_id', $id)->delete();

        // ลบข้อมูลหลัก
        $respondentModel->delete($id);

        $db->transComplete();

        return redirect()->to('/respondents')->with('msg', 'ลบข้อมูลเรียบร้อยแล้ว');
    }
}
