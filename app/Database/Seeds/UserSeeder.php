<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'name'    => 'Super Admin',
            'role'    => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // ใส่ข้อมูลลงตาราง users
        $this->db->table('users')->insert($data);
    }
}
