<?= $this->extend('layouts/master') ?>
<?= $this->section('title') ?>Analytics Dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold text-dark"><i class="fa-solid fa-chart-pie me-2 text-primary"></i>รายงานสรุปข้อมูลผู้สูงอายุ (Comprehensive Analytics)</h4>
            <span class="text-muted small">Update: <?= date('d/m/Y H:i') ?></span>
        </div>
        <button class="btn btn-primary btn-sm shadow-sm" onclick="window.print()"><i class="fa-solid fa-print me-1"></i> พิมพ์รายงาน</button>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-custom shadow-sm border-start border-4 border-primary h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">ประชากรทั้งหมด</h6>
                        <h2 class="mb-0 fw-bold"><?= number_format($total_respondents) ?> <span class="fs-6 text-muted">คน</span></h2>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle"><i class="fa-solid fa-users fa-2x text-primary"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom shadow-sm border-start border-4 border-info h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">อายุเฉลี่ย</h6>
                        <h2 class="mb-0 fw-bold"><?= $avg_age ?> <span class="fs-6 text-muted">ปี</span></h2>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-circle"><i class="fa-solid fa-cake-candles fa-2x text-info"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom shadow-sm border-start border-4 border-success h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">เตรียมพร้อมแล้ว</h6>
                        <h2 class="mb-0 fw-bold"><?= $prepared_percent ?>%</h2>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle"><i class="fa-solid fa-check-to-slot fa-2x text-success"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-custom shadow-sm h-100">
                <div class="card-header bg-white fw-bold border-bottom-0"><i class="fa-solid fa-venus-mars me-2 text-purple"></i>สัดส่วนเพศ</div>
                <div class="card-body">
                    <canvas id="genderChart" style="max-height: 250px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-custom shadow-sm h-100">
                <div class="card-header bg-white fw-bold border-bottom-0"><i class="fa-solid fa-arrow-up-right-dots me-2 text-warning"></i>การกระจายตัวช่วงอายุ</div>
                <div class="card-body">
                    <canvas id="ageChart" style="max-height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <h5 class="fw-bold text-secondary mb-3"><i class="fa-solid fa-user-graduate me-2"></i>ข้อมูลทางสังคมและเศรษฐกิจ</h5>
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-custom shadow-sm h-100">
                <div class="card-header bg-white small fw-bold">สถานภาพสมรส</div>
                <div class="card-body"><canvas id="maritalChart"></canvas></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom shadow-sm h-100">
                <div class="card-header bg-white small fw-bold">ระดับการศึกษา</div>
                <div class="card-body"><canvas id="eduChart"></canvas></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom shadow-sm h-100">
                <div class="card-header bg-white small fw-bold">อาชีพหลัก</div>
                <div class="card-body"><canvas id="jobChart"></canvas></div>
            </div>
        </div>
    </div>

    <div class="card card-custom shadow-sm mb-4 border-top border-4 border-danger">
        <div class="card-header bg-white fw-bold">
            <i class="fa-solid fa-heart-pulse me-2 text-danger"></i>การวิเคราะห์พฤติกรรมสุขภาพ (ออกกำลังกาย / สูบบุหรี่ / ดื่มสุรา)
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4"><canvas id="exerciseChart"></canvas></div>
                <div class="col-md-4"><canvas id="smokeChart"></canvas></div>
                <div class="col-md-4"><canvas id="alcoholChart"></canvas></div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-8">
            <div class="card card-custom shadow-sm h-100">
                <div class="card-header bg-white fw-bold"><i class="fa-solid fa-house-user me-2 text-success"></i>สภาพความเป็นอยู่</div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <h6 class="text-center small text-muted mb-2">ลักษณะที่อยู่อาศัย</h6>
                        <canvas id="residenceChart"></canvas>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-center small text-muted mb-2">ลักษณะครอบครัว</h6>
                        <canvas id="householdChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom shadow-sm h-100">
                <div class="card-header bg-white fw-bold"><i class="fa-solid fa-bullseye me-2 text-primary"></i>เรดาร์ความพร้อม</div>
                <div class="card-body">
                    <canvas id="radarChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Config สีให้ดู Professional
    const colors = {
        primary: '#3498db',
        success: '#2ecc71',
        warning: '#f1c40f',
        danger: '#e74c3c',
        purple: '#9b59b6',
        grey: '#95a5a6',
        teal: '#1abc9c',
        orange: '#e67e22'
    };

    // 1. Gender (Doughnut)
    new Chart(document.getElementById('genderChart'), {
        type: 'doughnut',
        data: {
            labels: <?= $gender_labels ?>,
            datasets: [{
                data: <?= $gender_data ?>,
                backgroundColor: [colors.primary, '#ff78cb'],
                borderWidth: 0
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });

    // 2. Age (Bar)
    new Chart(document.getElementById('ageChart'), {
        type: 'bar',
        data: {
            labels: <?= $age_labels ?>,
            datasets: [{
                label: 'จำนวน (คน)',
                data: <?= $age_data ?>,
                backgroundColor: colors.warning,
                borderRadius: 5
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // 3. Socio-Economic (Pie & Bars)
    new Chart(document.getElementById('maritalChart'), {
        type: 'pie',
        data: {
            labels: <?= $marital_labels ?>,
            datasets: [{
                data: <?= $marital_data ?>,
                backgroundColor: [colors.primary, colors.success, colors.grey]
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 10
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('eduChart'), {
        type: 'bar',
        data: {
            labels: <?= $edu_labels ?>,
            datasets: [{
                label: 'คน',
                data: <?= $edu_data ?>,
                backgroundColor: colors.teal,
                borderRadius: 3
            }]
        },
        options: {
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    new Chart(document.getElementById('jobChart'), {
        type: 'bar',
        data: {
            labels: <?= $job_labels ?>,
            datasets: [{
                label: 'คน',
                data: <?= $job_data ?>,
                backgroundColor: colors.orange,
                borderRadius: 3
            }]
        },
        options: {
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // 4. Health Behaviors (ดึง JSON มาแตก)
    const behaviors = <?= $behavior_data ?>;

    // สร้างฟังก์ชันวาดกราฟวงกลมเล็กๆ 3 อันเรียงกัน
    function createDonut(id, rawData, title, colorInfo) {
        new Chart(document.getElementById(id), {
            type: 'doughnut',
            data: {
                labels: rawData.labels,
                datasets: [{
                    data: rawData.data,
                    backgroundColor: colorInfo
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: title
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 10,
                            font: {
                                size: 10
                            }
                        }
                    }
                }
            }
        });
    }
    createDonut('exerciseChart', behaviors.exercise, 'การออกกำลังกาย', [colors.success, colors.warning, colors.danger, colors.grey]);
    createDonut('smokeChart', behaviors.smoking, 'การสูบบุหรี่', [colors.success, colors.grey, colors.danger]);
    createDonut('alcoholChart', behaviors.alcohol, 'การดื่มสุรา', [colors.success, colors.grey, colors.danger]);

    // 5. Living & Readiness
    new Chart(document.getElementById('residenceChart'), {
        type: 'pie',
        data: {
            labels: <?= $residence_labels ?>,
            datasets: [{
                data: <?= $residence_data ?>,
                backgroundColor: [colors.primary, colors.purple, colors.grey]
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 10
                    }
                }
            }
        }
    });
    new Chart(document.getElementById('householdChart'), {
        type: 'pie',
        data: {
            labels: <?= $household_labels ?>,
            datasets: [{
                data: <?= $household_data ?>,
                backgroundColor: [colors.orange, colors.teal, colors.grey]
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 10
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('radarChart'), {
        type: 'radar',
        data: {
            labels: <?= $radar_labels ?>,
            datasets: [{
                label: 'จำนวนคน',
                data: <?= $radar_data ?>,
                backgroundColor: 'rgba(52, 152, 219, 0.2)',
                borderColor: colors.primary,
                pointBackgroundColor: colors.primary
            }]
        },
        options: {
            scales: {
                r: {
                    beginAtZero: true,
                    ticks: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>