<?= $this->extend('layouts/master') ?>
<?= $this->section('title') ?>แก้ไขข้อมูล<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card card-custom p-4 border-warning border-top border-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-warning"><i class="fa-solid fa-pen-to-square me-2"></i>แก้ไขข้อมูล (ID: <?= $respondent['paper_id'] ?>)</h4>
            <a href="<?= base_url('/respondents') ?>" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-arrow-left me-1"></i> ย้อนกลับ</a>
        </div>

        <form action="<?= base_url('/respondents/update/' . $respondent['id']) ?>" method="post">

            <h5 class="text-muted border-bottom pb-2 mb-3">1. ข้อมูลทั่วไป</h5>
            <div class="row g-3 mb-3">
                <div class="col-md-2">
                    <label class="form-label">เลขที่แบบสอบถาม</label>
                    <input type="text" name="paper_id" class="form-control" value="<?= $respondent['paper_id'] ?>" required>
                </div>

                <div class="col-md-2">
                    <label class="form-label">คำนำหน้า</label>
                    <select name="prefix" class="form-select" required>
                        <option value="นาย" <?= ($respondent['prefix'] == 'นาย') ? 'selected' : '' ?>>นาย</option>
                        <option value="นาง" <?= ($respondent['prefix'] == 'นาง') ? 'selected' : '' ?>>นาง</option>
                        <option value="นางสาว" <?= ($respondent['prefix'] == 'นางสาว') ? 'selected' : '' ?>>นางสาว</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">ชื่อ</label>
                    <input type="text" name="first_name" class="form-control" value="<?= $respondent['first_name'] ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">นามสกุล</label>
                    <input type="text" name="last_name" class="form-control" value="<?= $respondent['last_name'] ?>" required>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">บ้านเลขที่</label>
                    <input type="text" name="house_no" class="form-control" value="<?= $respondent['house_no'] ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">หมู่ที่</label>
                    <input type="text" name="village_no" class="form-control" value="<?= $respondent['village_no'] ?>" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">เพศ</label>
                    <select name="gender" class="form-select">
                        <option value="male" <?= ($respondent['gender'] == 'male') ? 'selected' : '' ?>>ชาย</option>
                        <option value="female" <?= ($respondent['gender'] == 'female') ? 'selected' : '' ?>>หญิง</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">อายุ (ปี)</label>
                    <input type="number" name="age_year" class="form-control" value="<?= $respondent['age_year'] ?>" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">อายุ (เดือน)</label>
                    <input type="number" name="age_month" class="form-control" value="<?= $respondent['age_month'] ?>">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">สถานภาพสมรส</label>
                    <select name="marital_status" class="form-select">
                        <?php $statuses = ['single' => 'โสด', 'married' => 'สมรส', 'widowed_divorced' => 'หม้าย/หย่า/แยก']; ?>
                        <?php foreach ($statuses as $val => $label): ?>
                            <option value="<?= $val ?>" <?= ($respondent['marital_status'] == $val) ? 'selected' : '' ?>><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">ระดับการศึกษา</label>
                    <select name="education_level" class="form-select">
                        <?php $edus = ['ไม่ได้เรียน', 'ประถมศึกษา', 'มัธยมศึกษา/ปวช.', 'อนุปริญญา/ปวส.', 'ปริญญาตรี', 'สูงกว่าปริญญาตรี']; ?>
                        <?php foreach ($edus as $edu): ?>
                            <option value="<?= $edu ?>" <?= ($respondent['education_level'] == $edu) ? 'selected' : '' ?>><?= $edu ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label">อาชีพหลัก</label>
                    <select name="occupation" class="form-select">
                        <?php $jobs = ['ไม่ได้ประกอบอาชีพ', 'เกษตรกร', 'รับจ้าง', 'ค้าขาย', 'รับราชการ/รัฐวิสาหกิจ', 'อื่นๆ']; ?>
                        <?php foreach ($jobs as $job): ?>
                            <option value="<?= $job ?>" <?= ($respondent['occupation'] == $job) ? 'selected' : '' ?>><?= $job ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">รายได้</label>
                    <input type="number" name="income" class="form-control" value="<?= $respondent['income'] ?>">
                </div>
            </div>

            <h5 class="text-muted border-bottom pb-2 mb-3">2. พฤติกรรมสุขภาพ</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label">การออกกำลังกาย</label>
                    <select name="exercise_freq" class="form-select">
                        <?php $exercises = ['ไม่เคย', '1-2 ครั้ง/สัปดาห์', '3-5 ครั้ง/สัปดาห์', 'ทุกวัน']; ?>
                        <?php foreach ($exercises as $ex): ?>
                            <option value="<?= $ex ?>" <?= ($respondent['exercise_freq'] == $ex) ? 'selected' : '' ?>><?= $ex ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">การสูบบุหรี่</label>
                    <select name="smoking_status" class="form-select">
                        <?php $smokes = ['ไม่สูบ', 'เคยสูบแต่เลิกแล้ว', 'สูบ']; ?>
                        <?php foreach ($smokes as $sm): ?>
                            <option value="<?= $sm ?>" <?= ($respondent['smoking_status'] == $sm) ? 'selected' : '' ?>><?= $sm ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">การดื่มสุรา</label>
                    <select name="alcohol_status" class="form-select">
                        <?php $alcohols = ['ไม่ดื่ม', 'เคยดื่มแต่เลิกแล้ว', 'ดื่ม']; ?>
                        <?php foreach ($alcohols as $alc): ?>
                            <option value="<?= $alc ?>" <?= ($respondent['alcohol_status'] == $alc) ? 'selected' : '' ?>><?= $alc ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <h5 class="text-muted border-bottom pb-2 mb-3">3. สภาพความเป็นอยู่</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label">ที่อยู่อาศัย</label>
                    <select name="residence_type" class="form-select">
                        <?php $residences = ['บ้านตนเอง', 'บ้านบุตร', 'บ้านญาติ/ผู้อื่น']; ?>
                        <?php foreach ($residences as $res): ?>
                            <option value="<?= $res ?>" <?= ($respondent['residence_type'] == $res) ? 'selected' : '' ?>><?= $res ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">ลักษณะครอบครัว</label>
                    <select name="household_type" class="form-select">
                        <?php $households = ['อยู่คนเดียว', 'อยู่กับคู่สมรส', 'อยู่กับลูก/หลาน']; ?>
                        <?php foreach ($households as $house): ?>
                            <option value="<?= $house ?>" <?= ($respondent['household_type'] == $house) ? 'selected' : '' ?>><?= $house ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <h5 class="text-muted border-bottom pb-2 mb-3">4. ข้อมูลสุขภาพและการเตรียมพร้อม</h5>

            <div class="mb-4 p-3 bg-light rounded border">
                <label class="form-label d-block fw-bold text-primary">โรคประจำตัว</label>
                <?php
                $diseaseList = ['None' => 'ไม่มีโรคประจำตัว', 'High Blood Pressure' => 'ความดันโลหิตสูง', 'Diabetes' => 'เบาหวาน', 'Heart Disease' => 'โรคหัวใจ'];
                foreach ($diseaseList as $val => $label):
                ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="diseases[]" value="<?= $val ?>"
                            <?= (isset($my_diseases) && is_array($my_diseases) && in_array($val, $my_diseases)) ? 'checked' : '' ?>>
                        <label class="form-check-label"><?= $label ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mb-3 p-3 bg-light rounded border">
                <label class="form-label d-block fw-bold text-primary">การเตรียมความพร้อม</label>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="is_prepared" value="1" id="checkPrepared" onclick="togglePrepOptions()"
                        <?= ($respondent['is_prepared'] == 1) ? 'checked' : '' ?>>
                    <label class="form-check-label fw-bold" for="checkPrepared">มีการเตรียมความพร้อม</label>
                </div>

                <div id="prepOptions" style="display: <?= ($respondent['is_prepared'] == 1) ? 'block' : 'none' ?>; margin-left: 20px;">
                    <label class="mb-2 text-muted small">ด้านที่เตรียมความพร้อม (เลือกได้มากกว่า 1 ข้อ):</label><br>
                    <?php
                    $prepList = ['Health' => 'ด้านสุขภาพ', 'Economic' => 'ด้านเศรษฐกิจ', 'Social' => 'ด้านสังคม', 'Environment' => 'ด้านสิ่งแวดล้อม'];
                    foreach ($prepList as $val => $label):
                    ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="preps[]" value="<?= $val ?>"
                                <?= (isset($my_preps) && is_array($my_preps) && in_array($val, $my_preps)) ? 'checked' : '' ?>>
                            <label class="form-check-label"><?= $label ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-warning text-white btn-lg shadow-sm"><i class="fa-solid fa-save me-2"></i>อัปเดตข้อมูล</button>
            <a href="<?= base_url('/respondents') ?>" class="btn btn-secondary btn-lg">ยกเลิก</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function togglePrepOptions() {
        var checkBox = document.getElementById("checkPrepared");
        var optionsDiv = document.getElementById("prepOptions");
        if (checkBox.checked == true) {
            optionsDiv.style.display = "block";
        } else {
            optionsDiv.style.display = "none";
            // Optional: เคลียร์ค่าที่ติ๊กไว้เมื่อกดยกเลิก
            var checkboxes = optionsDiv.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
    }
</script>
<?= $this->endSection() ?>