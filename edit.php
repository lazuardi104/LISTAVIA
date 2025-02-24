<?php
include 'config.php';

session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM tasks WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $status = $_POST['status'];
    $prioritas = $_POST['prioritas'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];

    $query = "UPDATE tasks SET 
              judul = '$judul',
              deskripsi = '$deskripsi',
              status = '$status',
              prioritas = '$prioritas',
              tanggal_mulai = '$tanggal_mulai',
              tanggal_selesai = '$tanggal_selesai'
              WHERE id = $id";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Todolist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-image: url('images/bg2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,.1);
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: none;
            border-radius: 15px 15px 0 0 !important;
        }
        .btn {
            border-radius: 8px;
            padding: 8px 16px;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
        }
        .form-label {
            font-weight: 500;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="images/logo1.png" alt="TODOLIST APP" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                </ul>
                <form class="d-flex me-3" method="GET" action="">
                    <input class="form-control me-2" type="search" name="search" placeholder="Cari todolist..." aria-label="Search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                    <button class="btn btn-light" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt me-1"></i>Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-edit me-2"></i>Edit Todolist</h3>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-heading me-1"></i>Judul</label>
                        <input type="text" class="form-control" name="judul" value="<?= $data['judul'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-align-left me-1"></i>Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3" required><?= $data['deskripsi'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-tasks me-1"></i>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="belum dikerjakan" <?= $data['status'] == 'belum dikerjakan' ? 'selected' : '' ?>>Belum Dikerjakan</option>
                            <option value="sedang dikerjakan" <?= $data['status'] == 'sedang dikerjakan' ? 'selected' : '' ?>>Sedang Dikerjakan</option>
                            <option value="selesai" <?= $data['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prioritas</label>
                        <select name="prioritas" class="form-control" required>
                            <option value="biasa" <?= $data['prioritas'] == 'biasa' ? 'selected' : '' ?>>Biasa</option>
                            <option value="segera" <?= $data['prioritas'] == 'segera' ? 'selected' : '' ?>>Segera</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="far fa-calendar-alt me-1"></i>Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tanggal_mulai" value="<?= $data['tanggal_mulai'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="far fa-calendar-check me-1"></i>Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tanggal_selesai" value="<?= $data['tanggal_selesai'] ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-dark">
                        <i class="fas fa-save me-1"></i>Update
                    </button>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
