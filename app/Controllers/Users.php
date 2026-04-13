<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

// เช็คบรรทัดนี้: ต้องเป็น Users (มี s และ U ตัวใหญ่) ตรงกับชื่อไฟล์
class Users extends BaseController
{
    private function checkAdmin()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงส่วนนี้')->send();
            exit;
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('users/index', $data);
    }

    public function create()
    {
        $this->checkAdmin();
        return view('users/create');
    }

    public function store()
    {
        $this->checkAdmin();

        $rules = [
            'name'         => 'required|min_length[2]',
            'username'     => 'required|min_length[4]|is_unique[users.username]',
            'password'     => 'required|min_length[6]',
            'confpassword' => 'matches[password]',
            'role'         => 'required|in_list[admin,staff]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        $data = [
            'name'     => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getVar('role'),
        ];

        $model->save($data);
        return redirect()->to('/users')->with('msg', 'เพิ่มผู้ใช้งานสำเร็จ');
    }

    public function edit($id = null)
    {
        $this->checkAdmin();
        $model = new UserModel();
        $data['user'] = $model->find($id);

        if (!$data['user']) {
            return redirect()->to('/users')->with('error', 'ไม่พบรายชื่อผู้ใช้งาน');
        }

        return view('users/edit', $data);
    }

    public function update($id = null)
    {
        $this->checkAdmin();

        $rules = [
            'name' => 'required|min_length[2]',
            'role' => 'required|in_list[admin,staff]'
        ];

        // ถ้ามีการกรอกรหัสผ่านใหม่
        if ($this->request->getVar('password')) {
            $rules['password'] = 'min_length[6]';
            $rules['confpassword'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'role' => $this->request->getVar('role'),
        ];

        if ($this->request->getVar('password')) {
            $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }

        $model->update($id, $data);
        return redirect()->to('/users')->with('msg', 'แก้ไขข้อมูลสำเร็จ');
    }

    public function delete($id = null)
    {
        $this->checkAdmin();
        $model = new UserModel();

        if (session()->get('id') == $id) {
            return redirect()->to('/users')->with('error', 'ลบตัวเองไม่ได้');
        }

        $model->delete($id);
        return redirect()->to('/users')->with('msg', 'ลบสำเร็จ');
    }
}
