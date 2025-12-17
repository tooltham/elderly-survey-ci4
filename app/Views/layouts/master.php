<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> - Elderly Survey</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background-color: #f4f6f9;
        }

        .sidebar {
            min-height: 100vh;
            background: #2c3e50;
            color: white;
        }

        .sidebar a {
            color: #bdc3c7;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #34495e;
            color: white;
            border-left: 4px solid #3498db;
        }

        .content {
            padding: 20px;
        }

        .card-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <div class="sidebar d-flex flex-column flex-shrink-0 p-3" style="width: 250px;">
            <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4"><i class="fa-solid fa-database"></i> Database</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="<?= base_url('/dashboard') ?>" class="nav-link <?= (service('router')->controllerName() == '\App\Controllers\Dashboard') ? 'active' : '' ?>">
                        <i class="fa-solid fa-chart-line me-2"></i> ภาพรวมข้อมูล
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/respondents') ?>" class="nav-link <?= (service('router')->controllerName() == '\App\Controllers\Respondent') ? 'active' : '' ?>">
                        <i class="fa-solid fa-users me-2"></i> ข้อมูลผู้สูงอายุ
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/search') ?>" class="nav-link <?= (service('router')->controllerName() == '\App\Controllers\Search') ? 'active' : '' ?>">
                        <i class="fa-solid fa-magnifying-glass-chart me-2"></i> สืบค้นข้อมูล
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/users') ?>" class="nav-link <?= (service('router')->controllerName() == '\App\Controllers\Users') ? 'active' : '' ?>">
                        <i class="fa-solid fa-user-gear me-2"></i> จัดการผู้ใช้งาน
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/logout') ?>" class="nav-link text-danger mt-5">
                        <i class="fa-solid fa-sign-out-alt me-2"></i> ออกจากระบบ
                    </a>
                </li>
            </ul>
        </div>

        <div class="flex-grow-1 bg-light">
            <nav class="navbar navbar-light bg-white shadow-sm px-4">
                <span class="navbar-brand mb-0 h1">การพัฒนารูปแบบการเตรียมความพร้อมเข้าสู่สังคมสูงวัยโดยชุมชน</span>
                <span class="text-muted">สวัสดี, <?= session()->get('name') ?></span>
            </nav>
            <div class="content">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>