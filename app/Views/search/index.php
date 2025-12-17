<?= $this->extend('layouts/master') ?>
<?= $this->section('title') ?>สืบค้นข้อมูลเชิงลึก<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h4 class="mb-3"><i class="fa-solid fa-magnifying-glass-chart me-2"></i>ระบบสืบค้นและคัดกรองข้อมูล (Advanced Search)</h4>

    <div class="card card-custom mb-4 border-top border-4 border-info shadow-sm">
        <div class="card-header bg-white">
            <h6 class="mb-0 text-info"><i class="fa-solid fa-filter me-2"></i>กำหนดเงื่อนไขการค้นหา</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('/search') ?>" method="get">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label small text-muted">รหัส/ชื่อ-สกุล</label>
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="ระบุคำค้น..." value="<?= esc(request()->getGet('name')) ?>">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small text-muted">หมู่ที่</label>
                        <input type="text" name="village_no" class="form-control form-control-sm" placeholder="เช่น 1, 5" value="<?= esc(request()->getGet('village_no')) ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small text-muted">ช่วงอายุ (ปี)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" name="age_min" class="form-control" placeholder="ต่ำสุด" value="<?= esc(request()->getGet('age_min')) ?>">
                            <span class="input-group-text">-</span>
                            <input type="number" name="age_max" class="form-control" placeholder="สูงสุด" value="<?= esc(request()->getGet('age_max')) ?>">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small text-muted">เพศ</label>
                        <select name="gender" class="form-select form-select-sm">
                            <option value="">ทั้งหมด</option>
                            <option value="male" <?= (request()->getGet('gender') == 'male') ? 'selected' : '' ?>>ชาย</option>
                            <option value="female" <?= (request()->getGet('gender') == 'female') ? 'selected' : '' ?>>หญิง</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small text-muted">โรคประจำตัว</label>
                        <select name="disease" class="form-select form-select-sm">
                            <option value="">ทั้งหมด</option>
                            <option value="None" <?= (request()->getGet('disease') == 'None') ? 'selected' : '' ?>>ไม่มีโรค</option>
                            <option value="High Blood Pressure" <?= (request()->getGet('disease') == 'High Blood Pressure') ? 'selected' : '' ?>>ความดันฯ</option>
                            <option value="Diabetes" <?= (request()->getGet('disease') == 'Diabetes') ? 'selected' : '' ?>>เบาหวาน</option>
                            <option value="Heart Disease" <?= (request()->getGet('disease') == 'Heart Disease') ? 'selected' : '' ?>>โรคหัวใจ</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small text-muted">การเตรียมพร้อม</label>
                        <select name="is_prepared" class="form-select form-select-sm">
                            <option value="">ทั้งหมด</option>
                            <option value="1" <?= (request()->getGet('is_prepared') == '1') ? 'selected' : '' ?>>เตรียมตัวแล้ว</option>
                            <option value="0" <?= (request()->getGet('is_prepared') === '0') ? 'selected' : '' ?>>ยังไม่เตรียม</option>
                        </select>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-info text-white btn-sm w-100 me-1">
                            <i class="fa-solid fa-search me-1"></i> ค้นหา
                        </button>
                        <a href="<?= base_url('/search') ?>" class="btn btn-secondary btn-sm" title="ล้างค่า">
                            <i class="fa-solid fa-rotate-right"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-custom p-0 overflow-hidden shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <span class="fw-bold">
                <i class="fa-solid fa-list me-2"></i>ผลลัพธ์การค้นหา
                <span class="badge bg-primary ms-2"><?= number_format($total_found) ?> รายการ</span>
            </span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle table-striped">
                <thead class="table-dark small">
                    <tr>
                        <th>ID</th>
                        <th>ชื่อ-สกุล</th>
                        <th>ที่อยู่</th>
                        <th>อายุ/เพศ</th>
                        <th>โรคประจำตัว</th>
                        <th>การเตรียมตัว</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($respondents): ?>
                        <?php foreach ($respondents as $row): ?>
                            <tr>
                                <td><span class="badge bg-secondary"><?= $row['paper_id'] ?></span></td>
                                <td class="fw-bold">
                                    <?= $row['prefix'] . $row['first_name'] . ' ' . $row['last_name'] ?>
                                    <br><small class="text-muted"><?= $row['occupation'] ?></small>
                                </td>
                                <td><small>บ้านเลขที่ <?= $row['house_no'] ?> <br>หมู่ <?= $row['village_no'] ?></small></td>
                                <td>
                                    <?= $row['age_year'] ?> ปี
                                    <br>
                                    <?php if ($row['gender'] == 'male'): ?>
                                        <span class="text-primary small"><i class="fa-solid fa-mars"></i> ชาย</span>
                                    <?php else: ?>
                                        <span class="text-danger small"><i class="fa-solid fa-venus"></i> หญิง</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('respondents/edit/' . $row['id']) ?>" class="btn btn-outline-info btn-sm" style="font-size: 0.7rem;">ดูข้อมูล</a>
                                </td>
                                <td>
                                    <?php if ($row['is_prepared']): ?>
                                        <span class="badge bg-success"><i class="fa-solid fa-check me-1"></i>พร้อม</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">ไม่พร้อม</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('respondents/edit/' . $row['id']) ?>" class="btn btn-warning btn-sm text-white" title="แก้ไข">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">ไม่พบข้อมูลตามเงื่อนไข</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        <?= $pager->links() ?>
    </div>
</div>
<?= $this->endSection() ?>