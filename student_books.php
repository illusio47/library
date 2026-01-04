<?php
session_start();
if(!isset($_SESSION['student'])){
    header("Location: student_login.php");
}

include 'db.php';

$student = $_SESSION['student'];

$q = "
SELECT books.title, issued_books.issue_date, issued_books.return_date, issued_books.status
FROM issued_books
JOIN books ON issued_books.book_id = books.id
WHERE issued_books.student_name = '$student'
";

$res = $conn->query($q);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Issued Books | Library Management</title>

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

        /* Table row hover animation */
        table tbody tr {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        table tbody tr:hover {
            background-color: #f1f5ff;
            transform: scale(1.01);
        }

        /* Badge animation */
        .badge {
            font-size: 0.9rem;
            padding: 0.5em 0.75em;
            transition: transform 0.2s ease;
        }

        .badge:hover {
            transform: scale(1.1);
        }

        /* Button animation */
        .btn-secondary {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-secondary:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(108,117,125,0.4);
        }
    </style>
</head>

<body class="bg-light">

<div class="container mt-5 fade-slide">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📚 My Issued Books</h4>
        </div>

        <div class="card-body">

            <?php if($res->num_rows > 0) { ?>
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Book Title</th>
                            <th>Issue Date</th>
                            <th>Return Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $res->fetch_assoc()){ ?>
                        <tr>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['issue_date'] ?></td>
                            <td><?= $row['return_date'] ?></td>
                            <td>
                                <?php if($row['status'] == 'Issued'){ ?>
                                    <span class="badge bg-warning text-dark">Issued</span>
                                <?php } else { ?>
                                    <span class="badge bg-success">Returned</span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="alert alert-info text-center">
                    No books issued yet.
                </div>
            <?php } ?>

            <a href="student_dashboard.php" class="btn btn-secondary mt-3">
                ← Back to Dashboard
            </a>

        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
