<?= $this->extend('layouts/master') ?>
<?= $this->section('title') ?>แก้ไขผู้ใช้งาน<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card card-custom p-4 mx-auto border-top border-4 border-warning shadow-sm" style="max-width: 600px;">
        <h5 class="mb-4 text-warning"><i class="fa-solid fa-user-pen me-2"></i>แก้ไขผู้ใช้งาน: <?= $user['username'] ?></h5>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger py-2"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('/users/update/' . $user['id']) ?>" method="post">
            <div class="mb-3">
                <label class="form-label">ชื่อ-นามสกุล</label>
                <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
            </div>

            <div class="p-3 bg-light rounded mb-3 border">
                <label class="form-label fw-bold mb-2"><i class="fa-solid fa-key me-1"></i> เปลี่ยนรหัสผ่าน (ถ้าไม่เปลี่ยนให้เว้นว่างไว้)</label>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="password" name="password" class="form-control form-control-sm" placeholder="รหัสผ่านใหม่">
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="password" name="confpassword" class="form-control form-control-sm" placeholder="ยืนยันรหัสผ่านใหม่">
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">สิทธิ์การใช้งาน</label>
                <select name="role" class="form-select">
                    <option value="staff" <?= ($user['role'] == 'staff') ? 'selected' : '' ?>>Staff</option>
                    <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning text-white px-4"><i class="fa-solid fa-save me-2"></i>บันทึกการแก้ไข</button>
                <a href="<?= base_url('/users') ?>" class="btn btn-secondary px-4">ยกเลิก</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>