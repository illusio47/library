<?php
session_start();
if(!isset($_SESSION['student'])){
    header("Location: student_login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard | Library Management</title>

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

        /* Card hover effect */
        .card {
            border-radius: 16px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 35px rgba(0,0,0,0.2);
        }

        /* Button animation */
        .btn {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn:hover {
            transform: scale(1.04);
        }

        .btn-outline-primary:hover {
            box-shadow: 0 6px 15px rgba(13,110,253,0.4);
        }

        .btn-danger:hover {
            box-shadow: 0 6px 15px rgba(220,53,69,0.4);
        }
    </style>
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5 fade-slide">

            <div class="card shadow">
                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0">Student Dashboard</h4>
                </div>

                <div class="card-body text-center">
                    <p class="mb-4 fs-5">
                        Welcome, <strong><?php echo $_SESSION['student']; ?></strong>
                    </p>

                    <a href="student_books.php" class="btn btn-outline-primary w-100 mb-3">
                        📚 My Issued Books
                    </a>

                    <a href="student_logout.php" class="btn btn-danger w-100">
                        🚪 Logout
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
