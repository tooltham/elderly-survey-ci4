<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>รายชื่อผู้สูงอายุ<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><i class="fa-solid fa-users me-2"></i>รายชื่อผู้สูงอายุทั้งหมด</h4>
        <a href="<?= base_url('/respondents/create') ?>" class="btn btn-primary shadow-sm">
            <i class="fa-solid fa-plus me-1"></i> เพิ่มข้อมูลใหม่
        </a>
    </div>

    <?php if (session()->getFlashdata('msg')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa-solid fa-check-circle me-2"></i><?= session()->getFlashdata('msg') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card card-custom p-0 overflow-hidden shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <!-- <th style="width: 5%;">ID</th> -->
                        <th style="width: 15%;">รหัสแบบสอบถาม</th>
                        <th style="width: 20%;">ชื่อ-สกุล</th>
                        <th style="width: 15%;">อายุ</th>
                        <th style="width: 10%;">เพศ</th>
                        <th style="width: 15%;">อาชีพ</th>
                        <th style="width: 20%;" class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($respondents): ?>
                        <?php foreach ($respondents as $row): ?>
                            <tr>
                                <!-- <td><?= $row['id'] ?></td> -->
                                <td><span class="badge bg-secondary rounded-pill"><?= $row['paper_id'] ?></span></td>
                                <td class="fw-bold"><?= $row['prefix'] . $row['first_name'] . ' ' . $row['last_name'] ?></td>
                                <td><?= $row['age_year'] ?> ปี <?= $row['age_month'] ?> เดือน</td>
                                <td>
                                    <?php if ($row['gender'] == 'male'): ?>
                                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary"><i class="fa-solid fa-mars"></i> ชาย</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger"><i class="fa-solid fa-venus"></i> หญิง</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $row['occupation'] ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('respondents/edit/' . $row['id']) ?>" class="btn btn-warning btn-sm text-white me-1" title="แก้ไข">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <a href="<?= base_url('respondents/delete/' . $row['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันที่จะลบข้อมูลนี้? (กู้คืนไม่ได้นะจ๊ะ!)');" title="ลบ">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">ยังไม่มีข้อมูลในระบบ</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        <?= $pager->links() ?>
    </div>
</div>
<?= $this->endSection() ?>