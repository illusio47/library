<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
include 'db.php';

$books = $conn->query("SELECT * FROM books WHERE available > 0");

if($_POST){
    $student = $_POST['student'];
    $book_id = $_POST['book'];

    // insert issue record
    $conn->query("INSERT INTO issued_books
        (student_name, book_id, issue_date, status)
        VALUES ('$student', '$book_id', CURDATE(), 'Issued')");

    // reduce book quantity
    $conn->query("UPDATE books SET available = available - 1 WHERE id = $book_id");

    $success = "Book issued successfully";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Issue Book | Library Management</title>

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

        /* Button animation */
        .btn-warning {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-warning:hover {
            transform: scale(1.06);
            box-shadow: 0 6px 15px rgba(255,193,7,0.5);
        }

        /* Select & input focus effect */
        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 0.2rem rgba(255,193,7,0.25);
            border-color: #ffc107;
        }
    </style>
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5 fade-slide">

            <div class="card shadow">
                <div class="card-header bg-warning text-dark text-center">
                    <h4 class="mb-0">📤 Issue Book</h4>
                </div>

                <div class="card-body">

                    <?php if(isset($success)) { ?>
                        <div class="alert alert-success text-center">
                            <?= $success ?>
                        </div>
                    <?php } ?>

                    <form method="post">

                        <div class="mb-3">
                            <label class="form-label">Student Name</label>
                            <input type="text" name="student" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select Book</label>
                            <select name="book" class="form-select" required>
                                <?php while($b = $books->fetch_assoc()){ ?>
                                    <option value="<?= $b['id'] ?>">
                                        <?= $b['title'] ?> (Available: <?= $b['available'] ?>)
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-warning w-100">
                            Issue Book
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
