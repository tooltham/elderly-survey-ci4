<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        helper(['form']);
        return view('auth/login');
    }

    public function loginAuth()
    {
        $session = session();
        $userModel = new UserModel();

        // เพิ่ม Validation
        $rules = [
            'username' => 'required|min_length[3]',
            'password' => 'required|min_length[4]'
        ];

        if (!$this->validate($rules)) {
            $session->setFlashdata('msg', 'กรุณากรอกข้อมูลให้ครบถ้วนและถูกต้อง');
            return redirect()->to('/login')->withInput();
        }

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // 1. ค้นหา User
        $data = $userModel->where('username', $username)->first();

        if ($data) {
            // 2. ตรวจสอบรหัสผ่าน
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);

            if ($verify_pass) {
                $ses_data = [
                    'id'       => $data['id'],
                    'name'     => $data['name'],
                    'role'     => $data['role'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('msg', 'รหัสผ่านไม่ถูกต้อง');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'ไม่พบชื่อผู้ใช้นี้');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
