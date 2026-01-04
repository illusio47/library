<?php
session_start();
if(!isset($_SESSION['user'])){   // admin only
    header("Location: login.php");
}
include 'db.php';

if($_POST){
    $name = $_POST['name'];
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $q = "INSERT INTO students (name, username, password)
          VALUES ('$name', '$user', '$pass')";

    if($conn->query($q)){
        $success = "Student added successfully";
    } else {
        $error = "Error adding student";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student | Library Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Fade + slide animation */
        .fade-slide {
            animation: fadeSlide 0.9s ease forwards;
            opacity: 0;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(35px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Card hover animation */
        .card {
            border-radius: 16px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 35px rgba(0,0,0,0.2);
        }

        /* Button animation */
        .btn-secondary {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-secondary:hover {
            transform: scale(1.04);
            box-shadow: 0 6px 15px rgba(108,117,125,0.4);
        }
    </style>
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5 fade-slide">

            <div class="card shadow">
                <div class="card-header bg-secondary text-white text-center">
                    <h4 class="mb-0">Add Student</h4>
                </div>

                <div class="card-body">

                    <?php if(isset($success)) { ?>
                        <div class="alert alert-success text-center">
                            <?= $success ?>
                        </div>
                    <?php } ?>

                    <?php if(isset($error)) { ?>
                        <div class="alert alert-danger text-center">
                            <?= $error ?>
                        </div>
                    <?php } ?>

                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Student Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-secondary w-100">
                            ➕ Add Student
                        </button>
                    </form>

                </div>

                <div class="card-footer text-center">
                    <a href="dashboard.php">← Back to Dashboard</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
