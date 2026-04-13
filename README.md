# Elderly Survey Database System (ESDS)

ระบบฐานข้อมูลการสำรวจและเตรียมความพร้อมเข้าสู่สังคมสูงวัยโดยชุมชน

---

## 🚀 เกี่ยวกับโปรเจค
โปรเจคนี้พัฒนาขึ้นเพื่อจัดเก็บและวิเคราะห์ข้อมูลผู้สูงอายุในชุมชน โดยเน้นไปที่การเตรียมความพร้อมในด้านต่างๆ (สุขภาพ, เศรษฐกิจ, สังคม, และสิ่งแวดล้อม) พร้อมระบบ Dashboard แสดงผลสถิติแบบ Real-time

## 🛠 Tech Stack
- **Framework**: CodeIgniter 4.5+ (PHP 8.1+)
- **Database**: MySQL / MariaDB
- **Frontend**: Bootstrap 5, FontAwesome 6, Chart.js
- **Auth**: Custom Authentication with Session & Filters

## 🛡 Security Features (Updated)
- **Authentication Filter**: ระบบป้องกันการเข้าถึงข้อมูลโดยไม่ได้รับอนุญาตในทุกส่วนสำคัญ
- **Role-based Access Control (RBAC)**: แยกสิทธิ์การใช้งานระหว่าง Admin และ Staff
- **CSRF Protection**: เปิดพวงมาลัยการป้องกันการปลอมแปลงคำสั่ง (Cross-Site Request Forgery)
- **Input Validation**: ระบบตรวจสอบความถูกต้องของข้อมูลก่อนบันทึกลงฐานข้อมูล
- **Database Transactions**: รับประกันความถูกต้องของข้อมูลกรณีบันทึกหลายตารางพร้อมกัน

## ⚙️ การติดตั้ง (Setup)
1. Clone โปรเจคลงเครื่อง
2. รันคำสั่ง `composer update` (แนะนำ)
3. คัดลอกไฟล์ `.env.example` ไปเป็น `.env`
4. ตั้งค่าฐานข้อมูลในหัวข้อ `DATABASE` ในไฟล์ `.env`
5. นำเข้าไฟล์ SQL ฐานข้อมูล (ถ้ามี)
6. รันเซิร์ฟเวอร์ด้วยคำสั่ง `php spark serve`

## 📂 โครงสร้างโฟลเดอร์ที่สำคัญ
- `app/Controllers`: จัดการ Logic ของระบบ (Dashboard, Respondents, Users)
- `app/Models`: ส่วนติดต่อฐานข้อมูล (จัดการ Transaction และ Allowed Fields)
- `app/Filters`: ส่วนตรวจสอบความปลอดภัย (AuthFilter)
- `app/Views`: ส่วนแสดงผล (Layouts & Components)

---
**Developed by**: IoTES Research Unit
**Copyright**: วิทยาลัยพยาบาลบรมราชชนนีนครพนม มหาวิทยาลัยนครพนม
