<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>ภาพรวม<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card card-custom bg-primary text-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">ผู้ตอบแบบสอบถาม</h6>
                        <h2 class="mb-0"><?= $total_respondents ?></h2>
                    </div>
                    <i class="fa-solid fa-users fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom bg-success text-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">เพศชาย</h6>
                        <h2 class="mb-0"><?= $total_male ?></h2>
                    </div>
                    <i class="fa-solid fa-mars fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom bg-info text-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">เพศหญิง</h6>
                        <h2 class="mb-0"><?= $total_female ?></h2>
                    </div>
                    <i class="fa-solid fa-venus fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-custom p-4">
                <h5><i class="fa-solid fa-chart-pie me-2"></i>ช่วงอายุผู้สูงวัย</h5>
                <canvas id="ageChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-custom p-4">
                <h5><i class="fa-solid fa-heart-pulse me-2"></i>โรคประจำตัวที่พบบ่อย</h5>
                <canvas id="diseaseChart"></canvas>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. กราฟช่วงอายุ (Dynamic Data)
    const ctxAge = document.getElementById('ageChart').getContext('2d');
    new Chart(ctxAge, {
        type: 'pie',
        data: {
            labels: <?= $age_labels ?>, // ดึงจาก PHP
            datasets: [{
                data: <?= $age_data ?>, // ดึงจาก PHP
                backgroundColor: ['#3498db', '#2ecc71', '#f1c40f', '#e74c3c']
            }]
        }
    });

    // 2. กราฟโรคประจำตัว (Dynamic Data)
    const ctxDisease = document.getElementById('diseaseChart').getContext('2d');
    new Chart(ctxDisease, {
        type: 'bar',
        data: {
            labels: <?= $disease_labels ?>, // ดึงจาก PHP
            datasets: [{
                label: 'จำนวนคน',
                data: <?= $disease_data ?>, // ดึงจาก PHP
                backgroundColor: '#9b59b6'
            }]
        }
    });
</script>
<?= $this->endSection() ?>