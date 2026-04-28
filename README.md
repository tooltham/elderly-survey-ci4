# Elderly Survey System (ระบบฐานข้อมูลผู้สูงอายุ)

[![CodeIgniter 4](https://img.shields.io/badge/CodeIgniter-v4.6.4-firebrick.svg)](https://codeigniter.com/)
[![Docker](https://img.shields.io/badge/Docker-Ready-blue.svg)](https://www.docker.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

ระบบฐานข้อมูลเพื่อการพัฒนารูปแบบการเตรียมความพร้อมเข้าสู่สังคมสูงวัยโดยชุมชน พัฒนาโดยหน่วยวิจัย **IoTES Research Unit** วิทยาลัยพยาบาลบรมราชชนนีนครพนม มหาวิทยาลัยนครพนม

## 🚀 คุณสมบัติเด่น (Features)
- **Respondent Management:** จัดการข้อมูลผู้สูงอายุ ข้อมูลพื้นฐาน การศึกษา และอาชีพ
- **Health Tracking:** บันทึกข้อมูลโรคประจำตัวและการเตรียมความพร้อมด้านสุขภาพ
- **Soft Deletes:** รองรับการลบข้อมูลแบบปลอดภัย (กู้คืนได้)
- **Role-based Access:** ระบบจัดการสิทธิ์ผู้ใช้งาน (Admin/Staff)
- **Dashboard Data:** สรุปภาพรวมสถิติผู้สูงอายุในระบบ

## 🛠 Tech Stack
- **Backend:** PHP 8.3 + CodeIgniter 4.6.4
- **Database:** MariaDB 11.x
- **Infrastructure:** Docker & Docker Compose
- **Security:** CSRF Protection, Session Hijacking Protection, Security Hardening (Pulsar Framework)
- **Deployment:** Google Cloud Platform (GCP)

## 📦 การติดตั้งและเริ่มต้นใช้งาน (Getting Started)

### 1. เตรียมความพร้อม (Prerequisites)
- ติดตั้ง [Docker Desktop](https://www.docker.com/products/docker-desktop/) หรือ Docker Engine
- เตรียมไฟล์ `.env` (ดูตัวอย่างที่ `.env.example`)

### 2. รันระบบผ่าน Docker (Development)
```bash
docker compose up -d
```
เข้าใช้งานได้ที่: `http://localhost:8080`

### 3. รันระบบผ่าน Docker (Production)
```bash
docker compose -f docker-compose.prod.yml up -d --build
```
เข้าใช้งานได้ที่: `http://your-server-ip`

## 🗄 การจัดการฐานข้อมูล (Database)

### การรัน Migration และ Seeding
```bash
docker exec elderly-survey-app-prod php spark migrate
docker exec elderly-survey-app-prod php spark db:seed UserSeeder
```

### การ Restore ข้อมูลจากไฟล์ Backup
```bash
docker exec -i elderly-survey-db-prod sh -c 'mariadb -u root -p"$MYSQL_ROOT_PASSWORD" elderly_survey' < backup_file.sql
```

## 🔒 Security Configuration
ระบบนี้ได้รับการปรับแต่งเพื่อความปลอดภัยในระดับ Production:
- **Environment:** แยกการตั้งค่า `development` และ `production` ชัดเจน
- **Cache Handler:** ใช้ `dummy` cache ในโหมด Docker เพื่อเลี่ยงปัญหา Permission
- **Hardened Permissions:** ตั้งค่าสิทธิ์โฟลเดอร์ `writable` อย่างเข้มงวดใน Dockerfile

## 🤝 ทีมงานพัฒนา (Contributors)
- **ดร.อภิรักษ์ ทูลธรรม** (Developer)
  **IoTES Research Unit**
  **วิทยาลัยเทคโนโลยีอุตสาหกรรมศรีสงคราม มหาวิทยาลัยนครพนม**
- **ผศ.ดร.เบญจยามาศ พิลายนต์** (Research Project Leader)
  **วิทยาลัยพยาบาลบรมราชชนนีนครพนม มหาวิทยาลัยนครพนม**

---
Copyright &copy; 2025-2026 BCNNP, Nakhon Phanom University. All rights reserved.
