<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>บันทึกข้อมูลใหม่<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card card-custom p-4">
        <h4 class="mb-4 text-primary"><i class="fa-solid fa-user-plus me-2"></i>บันทึกแบบสำรวจผู้สูงอายุ</h4>

        <form action="<?= base_url('/respondents/store') ?>" method="post">

            <h5 class="text-muted border-bottom pb-2 mb-3">1. ข้อมูลทั่วไป</h5>

            <div class="row g-3 mb-3">
                <div class="col-md-2">
                    <label class="form-label">เลขที่แบบสอบถาม</label>
                    <input type="text" name="paper_id" class="form-control" placeholder="ระบุเลข..." required>
                </div>

                <div class="col-md-2">
                    <label class="form-label">คำนำหน้า</label>
                    <select name="prefix" class="form-select" required>
                        <option value="" selected disabled>เลือก...</option>
                        <option value="นาย">นาย</option>
                        <option value="นาง">นาง</option>
                        <option value="นางสาว">นางสาว</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">ชื่อ</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">นามสกุล</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">บ้านเลขที่</label>
                    <input type="text" name="house_no" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">หมู่ที่</label>
                    <input type="text" name="village_no" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">เพศ</label>
                    <select name="gender" class="form-select">
                        <option value="male">ชาย</option>
                        <option value="female">หญิง</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">อายุ (ปี)</label>
                    <input type="number" name="age_year" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">อายุ (เดือน)</label>
                    <input type="number" name="age_month" class="form-control" placeholder="ถ้ามี" min="0" max="11">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">สถานภาพสมรส</label>
                    <select name="marital_status" class="form-select">
                        <option value="single">โสด</option>
                        <option value="married">สมรส</option>
                        <option value="widowed_divorced">หม้าย/หย่า/แยก</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">ระดับการศึกษา</label>
                    <select name="education_level" class="form-select">
                        <option value="ไม่ได้เรียน">ไม่ได้เรียน</option>
                        <option value="ประถมศึกษา">ประถมศึกษา</option>
                        <option value="มัธยมศึกษา/ปวช.">มัธยมศึกษา/ปวช.</option>
                        <option value="อนุปริญญา/ปวส.">อนุปริญญา/ปวส.</option>
                        <option value="ปริญญาตรี">ปริญญาตรี</option>
                        <option value="สูงกว่าปริญญาตรี">สูงกว่าปริญญาตรี</option>
                    </select>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label">อาชีพหลัก</label>
                    <select name="occupation" class="form-select">
                        <option value="ไม่ได้ประกอบอาชีพ">ไม่ได้ประกอบอาชีพ</option>
                        <option value="เกษตรกร">เกษตรกร</option>
                        <option value="รับจ้าง">รับจ้าง</option>
                        <option value="ค้าขาย">ค้าขาย</option>
                        <option value="รับราชการ/รัฐวิสาหกิจ">รับราชการ/รัฐวิสาหกิจ</option>
                        <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">รายได้เฉลี่ยต่อเดือน (บาท)</label>
                    <input type="number" name="income" class="form-control" placeholder="ระบุตัวเลข (ถ้าไม่มีใส่ 0)">
                </div>
            </div>

            <h5 class="text-muted border-bottom pb-2 mb-3">2. ข้อมูลสุขภาพ</h5>
            <div class="mb-3">
                <label class="form-label d-block fw-bold">โรคประจำตัว (เลือกได้มากกว่า 1 ข้อ)</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="diseases[]" value="None">
                    <label class="form-check-label">ไม่มีโรคประจำตัว</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="diseases[]" value="High Blood Pressure">
                    <label class="form-check-label">ความดันโลหิตสูง</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="diseases[]" value="Diabetes">
                    <label class="form-check-label">เบาหวาน</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="diseases[]" value="Heart Disease">
                    <label class="form-check-label">โรคหัวใจ</label>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label">การออกกำลังกาย</label>
                    <select name="exercise_freq" class="form-select">
                        <option value="ไม่เคย">ไม่เคย</option>
                        <option value="1-2 ครั้ง/สัปดาห์">1-2 ครั้ง/สัปดาห์</option>
                        <option value="3-5 ครั้ง/สัปดาห์">3-5 ครั้ง/สัปดาห์</option>
                        <option value="ทุกวัน">ทุกวัน</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">การสูบบุหรี่</label>
                    <select name="smoking_status" class="form-select">
                        <option value="ไม่สูบ">ไม่สูบ</option>
                        <option value="เคยสูบแต่เลิกแล้ว">เคยสูบแต่เลิกแล้ว</option>
                        <option value="สูบ">สูบ</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">การดื่มสุรา</label>
                    <select name="alcohol_status" class="form-select">
                        <option value="ไม่ดื่ม">ไม่ดื่ม</option>
                        <option value="เคยดื่มแต่เลิกแล้ว">เคยดื่มแต่เลิกแล้ว</option>
                        <option value="ดื่ม">ดื่ม</option>
                    </select>
                </div>
            </div>

            <h5 class="text-muted border-bottom pb-2 mb-3">3. สภาพความเป็นอยู่</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label">ที่อยู่อาศัย</label>
                    <select name="residence_type" class="form-select">
                        <option value="บ้านตนเอง">บ้านตนเอง</option>
                        <option value="บ้านบุตร">บ้านบุตร</option>
                        <option value="บ้านญาติ/ผู้อื่น">บ้านญาติ/ผู้อื่น</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">ลักษณะครอบครัว</label>
                    <select name="household_type" class="form-select">
                        <option value="อยู่คนเดียว">อยู่คนเดียว</option>
                        <option value="อยู่กับคู่สมรส">อยู่กับคู่สมรส</option>
                        <option value="อยู่กับลูก/หลาน">อยู่กับลูก/หลาน</option>
                    </select>
                </div>
            </div>

            <h5 class="text-muted border-bottom pb-2 mb-3">4. การเตรียมความพร้อมเข้าสู่วัยสูงอายุ</h5>
            <div class="mb-3">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="is_prepared" value="1" id="checkPrepared" onclick="togglePrepOptions()">
                    <label class="form-check-label fw-bold" for="checkPrepared">มีการเตรียมความพร้อม (ถ้าไม่มี ไม่ต้องติ๊ก)</label>
                </div>

                <div id="prepOptions" style="display:none; margin-left: 20px;" class="p-3 bg-light rounded">
                    <label class="mb-2">ด้านที่เตรียมความพร้อม (เลือกได้มากกว่า 1 ข้อ):</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="preps[]" value="Health">
                        <label class="form-check-label">ด้านสุขภาพ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="preps[]" value="Economic">
                        <label class="form-check-label">ด้านเศรษฐกิจ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="preps[]" value="Social">
                        <label class="form-check-label">ด้านสังคม</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="preps[]" value="Environment">
                        <label class="form-check-label">ด้านสิ่งแวดล้อม</label>
                    </div>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary btn-lg"><i class="fa-solid fa-save me-2"></i>บันทึกข้อมูล</button>
            <a href="<?= base_url('/dashboard') ?>" class="btn btn-secondary btn-lg">ยกเลิก</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Script ง่ายๆ เอาไว้ซ่อน/โชว์ตัวเลือกการเตรียมตัว
    function togglePrepOptions() {
        var checkBox = document.getElementById("checkPrepared");
        var optionsDiv = document.getElementById("prepOptions");
        if (checkBox.checked == true) {
            optionsDiv.style.display = "block";
        } else {
            optionsDiv.style.display = "none";
        }
    }
</script>
<?= $this->endSection() ?>