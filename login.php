<?php
session_start();
include 'db.php';

if($_POST){
    $u = $_POST['user'];
    $p = $_POST['pass'];

    $q = "SELECT * FROM users WHERE username='$u' AND password='$p'";
    $res = $conn->query($q);

    if($res->num_rows > 0){
        $_SESSION['user'] = $u;
        header("Location: dashboard.php");
    } else {
        $error = "Invalid Login";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login | Library Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Page animation */
        .fade-slide {
            animation: fadeSlide 0.8s ease forwards;
            opacity: 0;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Card hover animation */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.2);
        }

        /* Button animation */
        .btn-primary {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 15px rgba(13,110,253,0.4);
        }
    </style>
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4 fade-slide">

            <div class="card shadow">
                <div class="card-header bg-dark text-white text-center">
                    <h4 class="mb-0">Admin Login</h4>
                </div>

                <div class="card-body">

                    <?php if(isset($error)) { ?>
                        <div class="alert alert-danger text-center">
                            <?= $error ?>
                        </div>
                    <?php } ?>

                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input name="user" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="pass" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Login
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
