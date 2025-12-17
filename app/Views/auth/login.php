<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เข้าสู่ระบบ - ระบบฐานข้อมูลผู้สูงอายุ</title>

    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            /* พื้นหลังไล่สีจางๆ ดูสะอาด */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 500px;
            /* ขยายกว้างขึ้นหน่อยเพื่อให้ใส่โลโก้พอ */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            background: white;
            border-top: 5px solid #0d6efd;
            /* เส้นสีน้ำเงินด้านบนเพิ่มมิติ */
        }

        .logo-row img {
            height: 50px;
            /* บังคับความสูงโลโก้ให้เท่ากัน */
            width: auto;
            object-fit: contain;
            margin: 0 5px;
            transition: transform 0.2s;
        }

        .logo-row img:hover {
            transform: scale(1.1);
            /* ลูกเล่นเมาส์ชี้แล้วขยาย */
        }

        .project-title {
            color: #2c3e50;
            font-weight: 600;
            line-height: 1.4;
        }

        .footer-text {
            text-align: center;
            padding: 15px;
            font-size: 0.85rem;
            color: #6c757d;
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body>

    <div class="main-container">
        <div class="login-card">

            <div class="d-flex justify-content-center align-items-center mb-4 flex-wrap logo-row gap-2">
                <img src="<?= base_url('images/mhesi.png') ?>" alt="อว." title="กระทรวง อว.">
                <img src="<?= base_url('images/tsri.png') ?>" alt="สกสว." title="สกสว.">
                <div style="border-left: 1px solid #ccc; height: 40px; margin: 0 10px;"></div> <img src="<?= base_url('images/bcnnp.png') ?>" alt="วิทยาลัยพยาบาล" title="วิทยาลัยพยาบาลบรมราชชนนีนครพนม">
                <img src="<?= base_url('images/npu.png') ?>" alt="ม.นครพนม" title="มหาวิทยาลัยนครพนม">
            </div>

            <div class="text-center mb-4">
                <h5 class="project-title">
                    การพัฒนารูปแบบการเตรียมความพร้อม<br>
                    เข้าสู่สังคมสูงวัยโดยชุมชน
                </h5>
                <span class="badge bg-light text-secondary mt-2 fw-normal">System Login</span>
            </div>

            <?php if (session()->getFlashdata('msg')): ?>
                <div class="alert alert-danger text-center py-2"><small><?= session()->getFlashdata('msg') ?></small></div>
            <?php endif; ?>

            <form action="<?= base_url('/loginAuth') ?>" method="post">
                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                    <label for="username"><i class="fa-solid fa-user me-2"></i>ชื่อผู้ใช้งาน</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password"><i class="fa-solid fa-lock me-2"></i>รหัสผ่าน</label>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                        เข้าสู่ระบบ <i class="fa-solid fa-arrow-right-to-bracket ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer-text">
        Copyright &copy; 2025 วิทยาลัยพยาบาลบรมราชชนนีนครพนม มหาวิทยาลัยนครพนม<br>
        <small class="text-muted">Developed by IoTES Research Unit</small>
    </footer>

</body>

</html>