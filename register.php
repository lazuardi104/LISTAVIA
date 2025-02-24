<?php
session_start();
include 'config.php';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $full_name = mysqli_real_escape_string($koneksi, $_POST['full_name']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Cek username sudah ada atau belum
    $check_username = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    $check_email = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");
    
    if (mysqli_num_rows($check_username) > 0) {
        $error = "Username sudah digunakan!";
    } elseif (mysqli_num_rows($check_email) > 0) {
        $error = "Email sudah digunakan!";
    } else {
        $query = "INSERT INTO users (username, email, full_name, password) 
                 VALUES ('$username', '$email', '$full_name', '$password')";
        if (mysqli_query($koneksi, $query)) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Gagal mendaftar!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TODOLIST APP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: #000000;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 15px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            width: 100%;
        }
        .card-header {
            background: transparent;
            border-bottom: none;
            padding: 15px;
        }
        .card-header h3 {
            color: #2d3436;
            font-weight: 600;
        }
        .card-body {
            padding: 20px;
        }
        .form-control {
            font-size: 14px;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #dfe6e9;
            margin-bottom: 15px;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(161, 196, 253, 0.3);
            border-color: #a1c4fd;
        }
        .btn-primary {
            background: linear-gradient(to right, #6c5ce7, #a1c4fd);
            border: none;
            padding: 10px;
            border-radius: 10px;
            width: 100%;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
            transition: transform 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 92, 231, 0.3);
        }
        .btn-link {
            color: #6c5ce7;
            text-decoration: none;
            font-weight: 500;
        }
        .btn-link:hover {
            color: #4834d4;
        }
        .alert {
            border-radius: 10px;
            border: none;
            font-size: 14px;
            padding: 10px;
        }
        .input-group-text {
            background: transparent;
            border: 1px solid #dfe6e9;
            border-right: none;
            font-size: 14px;
        }
        .card-header img {
            max-width: 100%;
            height: auto;
            max-height: 80px;
        }
        @media (max-width: 576px) {
            .col-md-5 {
                padding: 0 10px;
            }
            .card-body {
                padding: 15px;
            }
            .btn-link {
                font-size: 14px;
            }
            .alert {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                <div class="card-header">
                        <div class="text-center">
                            <img src="images/logo2.png" alt="TODOLIST APP" height="100">
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i><?= $error ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" name="full_name" class="form-control" placeholder="Masukkan nama lengkap" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                                </div>
                            </div>
                            <button type="submit" name="register" class="btn btn-primary">
                                <i class="fas fa-user-plus me-2"></i>Daftar
                            </button>
                            <div class="text-center">
                                <a href="login.php" class="btn btn-link">
                                    <i class="fas fa-sign-in-alt me-1"></i>Sudah punya akun? Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>