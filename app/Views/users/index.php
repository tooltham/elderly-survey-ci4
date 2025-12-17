<?= $this->extend('layouts/master') ?>
<?= $this->section('title') ?>จัดการผู้ใช้งาน<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><i class="fa-solid fa-user-gear me-2"></i>จัดการผู้ใช้งาน (Users)</h4>
        <a href="<?= base_url('/users/create') ?>" class="btn btn-primary shadow-sm">
            <i class="fa-solid fa-plus me-1"></i> เพิ่มผู้ใช้งาน
        </a>
    </div>

    <?php if (session()->getFlashdata('msg')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="card card-custom p-0 overflow-hidden shadow-sm">
        <table class="table table-striped table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ชื่อ-สกุล</th>
                    <th>Username</th>
                    <th>สิทธิ์ (Role)</th>
                    <th>วันที่สร้าง</th>
                    <th class="text-center">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td>
                            <?php if ($user['role'] == 'admin'): ?>
                                <span class="badge bg-danger">Administrator</span>
                            <?php else: ?>
                                <span class="badge bg-info text-dark">Staff</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d/m/Y H:i', strtotime($user['created_at'])) ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('users/edit/' . $user['id']) ?>" class="btn btn-warning btn-sm text-white">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="<?= base_url('users/delete/' . $user['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันลบผู้ใช้งานนี้?');">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>