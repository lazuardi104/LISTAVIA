<?php
include 'config.php';
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTAVIA</title>
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
        .table {
            margin-bottom: 0;
        }
        .btn {
            border-radius: 8px;
            padding: 8px 16px;
        }
        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,.05);
        }
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }
        .btn-sm {
            padding: 5px 10px;
            margin: 2px;
        }
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2) !important;
        }
        
        .alert {
            background-color: rgba(255, 255, 255, 0.95);
        }
        
        .btn-dark {
            background: linear-gradient(45deg, #2b2b2b, #3a3a3a);
            border: none;
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
        <div class="alert alert-info shadow-sm border-start border-info border-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-user-circle fa-2x me-3"></i>
                <div>
                    <h5 class="mb-0">Selamat datang!</h5>
                    <h5 class="mb-0"><?= $_SESSION['username'] ?></h5>
                </div>
            </div>
        </div>
        
        <a href="tambah.php" class="btn btn-dark mb-3 shadow-sm hover-lift">
            <i class="fas fa-plus-circle me-2"></i>
            <span class="fw-semibold">Tambah Todolist Baru</span>
        </a>
        <div class="mt-4">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-list me-2"></i>Todolist</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Prioritas</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $user_id = $_SESSION['user_id'];
                            $search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
                            $query = "SELECT * FROM tasks WHERE user_id = $user_id";
                            if (!empty($search)) {
                                $query .= " AND (judul LIKE '%$search%' OR deskripsi LIKE '%$search%' OR status LIKE '%$search%' OR prioritas LIKE '%$search%')";
                            }
                            $query .= " ORDER BY id DESC";
                            $result = mysqli_query($koneksi, $query);
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $status_class = '';
                                switch($row['status']) {
                                    case 'selesai':
                                        $status_class = 'text-success';
                                        break;
                                    case 'sedang dikerjakan':
                                        $status_class = 'text-warning';
                                        break;
                                    default:
                                        $status_class = 'text-danger';
                                }
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><strong><?= $row['judul'] ?></strong></td>
                                    <td><?= $row['deskripsi'] ?></td>
                                    <td><span class="<?= $status_class ?>"><?= $row['status'] ?></span></td>
                                    <td><i class="far fa-calendar-alt me-1"></i><?= $row['prioritas'] ?></td>
                                    <td><i class="far fa-calendar-alt me-1"></i><?= $row['tanggal_mulai'] ?></td>
                                    <td><i class="far fa-calendar-check me-1"></i><?= $row['tanggal_selesai'] ?></td>
                                    <td>
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
