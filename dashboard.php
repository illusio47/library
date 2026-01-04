<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard | Library Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Fade in animation */
        .fade-in {
            animation: fadeIn 0.9s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        /* Card hover animation */
        .dash-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 15px;
        }

        .dash-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        /* Icon animation */
        .dash-icon {
            font-size: 2rem;
            transition: transform 0.3s ease;
        }

        .dash-card:hover .dash-icon {
            transform: scale(1.15);
        }
    </style>
</head>

<body class="bg-light">

<div class="container mt-5 fade-in">

    <div class="card shadow mb-4">
        <div class="card-header text-white"
             style="background: linear-gradient(135deg, #4e73df, #224abe);">
            <h4 class="mb-0">Admin Dashboard</h4>
        </div>
        <div class="card-body">
            <p>Welcome, <strong><?php echo $_SESSION['user']; ?></strong></p>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <a href="books.php" class="text-decoration-none text-dark">
                <div class="card dash-card text-center p-4">
                    <i class="bi bi-book dash-icon text-primary"></i>
                    <h5 class="mt-3">View Books</h5>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="add_book.php" class="text-decoration-none text-dark">
                <div class="card dash-card text-center p-4">
                    <i class="bi bi-bookmark-plus dash-icon text-success"></i>
                    <h5 class="mt-3">Add Book</h5>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="issue_book.php" class="text-decoration-none text-dark">
                <div class="card dash-card text-center p-4">
                    <i class="bi bi-box-arrow-up dash-icon text-warning"></i>
                    <h5 class="mt-3">Issue Book</h5>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="return_book.php" class="text-decoration-none text-dark">
                <div class="card dash-card text-center p-4">
                    <i class="bi bi-box-arrow-in-down dash-icon text-info"></i>
                    <h5 class="mt-3">Return Book</h5>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="add_student.php" class="text-decoration-none text-dark">
                <div class="card dash-card text-center p-4">
                    <i class="bi bi-person-plus dash-icon text-secondary"></i>
                    <h5 class="mt-3">Add Student</h5>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="logout.php" class="text-decoration-none text-dark">
                <div class="card dash-card text-center p-4">
                    <i class="bi bi-box-arrow-right dash-icon text-danger"></i>
                    <h5 class="mt-3">Logout</h5>
                </div>
            </a>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
