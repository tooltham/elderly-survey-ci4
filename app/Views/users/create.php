<?= $this->extend('layouts/master') ?>
<?= $this->section('title') ?>เพิ่มผู้ใช้งาน<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card card-custom p-4 mw-600 mx-auto border-top border-4 border-primary shadow-sm" style="max-width: 600px;">
        <h5 class="mb-4 text-primary"><i class="fa-solid fa-user-plus me-2"></i>เพิ่มผู้ใช้งานใหม่</h5>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger py-2"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('/users/store') ?>" method="post">
            <div class="mb-3">
                <label class="form-label">ชื่อ-นามสกุล</label>
                <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Username (สำหรับเข้าสู่ระบบ)</label>
                <input type="text" name="username" class="form-control" value="<?= old('username') ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label text-danger">* Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-danger">* Confirm Password</label>
                    <input type="password" name="confpassword" class="form-control" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">สิทธิ์การใช้งาน</label>
                <select name="role" class="form-select">
                    <option value="staff">Staff (เจ้าหน้าที่บันทึกข้อมูล)</option>
                    <option value="admin">Admin (ผู้ดูแลระบบ)</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4"><i class="fa-solid fa-save me-2"></i>บันทึก</button>
                <a href="<?= base_url('/users') ?>" class="btn btn-secondary px-4">ยกเลิก</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>