<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

// เช็คบรรทัดนี้: ต้องเป็น Users (มี s และ U ตัวใหญ่) ตรงกับชื่อไฟล์
class Users extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('users/index', $data);
    }

    public function create()
    {
        return view('users/create');
    }

    // แก้ไข function store()
    public function store()
    {
        $model = new UserModel();

        // 1. รับค่ารหัสผ่านทั้ง 2 ช่อง
        $password = $this->request->getVar('password');
        $confpassword = $this->request->getVar('confpassword');

        // 2. ตรวจสอบว่าตรงกันไหม
        if ($password !== $confpassword) {
            return redirect()->back()->withInput()->with('error', 'รหัสผ่านและการยืนยันรหัสผ่านไม่ตรงกัน');
        }

        $data = [
            'name'     => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => $this->request->getVar('role'),
        ];

        if ($model->where('username', $data['username'])->first()) {
            return redirect()->back()->withInput()->with('error', 'ชื่อผู้ใช้นี้มีอยู่แล้ว');
        }

        $model->save($data);
        return redirect()->to('/users')->with('msg', 'เพิ่มผู้ใช้งานสำเร็จ');
    }

    public function edit($id = null)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);
        return view('users/edit', $data);
    }

    // แก้ไข function update()
    public function update($id = null)
    {
        $model = new UserModel();

        $data = [
            'name' => $this->request->getVar('name'),
            'role' => $this->request->getVar('role'),
        ];

        // รับรหัสผ่านใหม่
        $newPassword = $this->request->getVar('password');
        $confPassword = $this->request->getVar('confpassword');

        // ถ้ามีการกรอกรหัสผ่าน (จะเปลี่ยนรหัส)
        if (!empty($newPassword)) {
            // ต้องเช็คว่าตรงกับ Confirm ไหม
            if ($newPassword !== $confPassword) {
                return redirect()->back()->withInput()->with('error', 'รหัสผ่านใหม่และการยืนยันไม่ตรงกัน');
            }
            $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $model->update($id, $data);
        return redirect()->to('/users')->with('msg', 'แก้ไขข้อมูลสำเร็จ');
    }

    public function delete($id = null)
    {
        $model = new UserModel();
        if (session()->get('id') == $id) {
            return redirect()->to('/users')->with('error', 'ลบตัวเองไม่ได้');
        }
        $model->delete($id);
        return redirect()->to('/users')->with('msg', 'ลบสำเร็จ');
    }
}
