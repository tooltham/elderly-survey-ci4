<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InitialTables extends Migration
{
    public function up()
    {
        // 1. Users Table
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'role' => ['type' => 'ENUM', 'constraint' => ['admin', 'staff'], 'default' => 'staff'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

        // 2. Respondents Table
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'paper_id' => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true, 'null' => true],
            'prefix' => ['type' => 'VARCHAR', 'constraint' => 20],
            'first_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'last_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'house_no' => ['type' => 'VARCHAR', 'constraint' => 50],
            'village_no' => ['type' => 'VARCHAR', 'constraint' => 50],
            'gender' => ['type' => 'ENUM', 'constraint' => ['male', 'female']],
            'age_year' => ['type' => 'INT', 'constraint' => 3],
            'age_month' => ['type' => 'INT', 'constraint' => 2, 'default' => 0],
            'marital_status' => ['type' => 'VARCHAR', 'constraint' => 50],
            'education_level' => ['type' => 'VARCHAR', 'constraint' => 100],
            'occupation' => ['type' => 'VARCHAR', 'constraint' => 100],
            'income' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'exercise_freq' => ['type' => 'VARCHAR', 'constraint' => 50],
            'smoking_status' => ['type' => 'VARCHAR', 'constraint' => 50],
            'alcohol_status' => ['type' => 'VARCHAR', 'constraint' => 50],
            'residence_type' => ['type' => 'VARCHAR', 'constraint' => 50],
            'household_type' => ['type' => 'VARCHAR', 'constraint' => 50],
            'is_prepared' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'created_by' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('respondents');

        // 3. Diseases Table
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'respondent_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'disease_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'other_detail' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('respondent_id', 'respondents', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('respondent_diseases');

        // 4. Preps Table
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'respondent_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'prep_aspect' => ['type' => 'VARCHAR', 'constraint' => 50],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('respondent_id', 'respondents', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('respondent_preps');
    }

    public function down()
    {
        $this->forge->dropTable('respondent_preps');
        $this->forge->dropTable('respondent_diseases');
        $this->forge->dropTable('respondents');
        $this->forge->dropTable('users');
    }
}
