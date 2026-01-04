<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

include 'db.php';

if($_POST){

    $title  = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $qty    = $_POST['qty'];

    $q = "INSERT INTO books (title, author, available)
          VALUES ('$title', '$author', '$qty')";

    if($conn->query($q)){
        $success = "Book added successfully";
    } else {
        $error = "Error adding book";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book | Library Management</title>

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
            transform: translateY(-6px);
            box-shadow: 0 14px 30px rgba(0,0,0,0.2);
        }

        /* Button animations */
        .btn-success,
        .btn-secondary {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-success:hover {
            transform: scale(1.06);
            box-shadow: 0 6px 15px rgba(25,135,84,0.4);
        }

        .btn-secondary:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(108,117,125,0.4);
        }

        /* Input focus */
        .form-control:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.2rem rgba(25,135,84,0.25);
        }
    </style>
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5 fade-slide">

            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0">📘 Add New Book</h4>
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
                            <label class="form-label">Book Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Author</label>
                            <input type="text" name="author" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="qty" class="form-control" min="1" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mb-2">
                            ➕ Add Book
                        </button>

                        <a href="dashboard.php" class="btn btn-secondary w-100">
                            ← Back to Dashboard
                        </a>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
