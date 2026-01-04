<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
include 'db.php';

$issued = $conn->query("
SELECT issued_books.id, books.title, issued_books.book_id
FROM issued_books
JOIN books ON issued_books.book_id = books.id
WHERE status='Issued'
");

if(isset($_GET['id']) && isset($_GET['book'])){
    $issue_id = $_GET['id'];
    $book_id  = $_GET['book'];

    // update issued_books
    $conn->query("
      UPDATE issued_books
      SET status='Returned', return_date=CURDATE()
      WHERE id=$issue_id
    ");

    // increase book quantity
    $conn->query("
      UPDATE books SET available = available + 1
      WHERE id=$book_id
    ");

    header("Location: return_book.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Return Book | Library Management</title>

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
            background-color: #eef7ff;
            transform: scale(1.01);
        }

        /* Return button animation */
        .btn-success {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-success:hover {
            transform: scale(1.07);
            box-shadow: 0 6px 15px rgba(25,135,84,0.4);
        }

        /* Back button animation */
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
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">📥 Return Book</h4>
        </div>

        <div class="card-body">

            <?php if($issued->num_rows > 0){ ?>
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Issue ID</th>
                            <th>Book Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($r = $issued->fetch_assoc()){ ?>
                        <tr>
                            <td><?= $r['id'] ?></td>
                            <td><?= $r['title'] ?></td>
                            <td>
                                <a href="return_book.php?id=<?= $r['id'] ?>&book=<?= $r['book_id'] ?>"
                                   class="btn btn-success btn-sm"
                                   onclick="return confirm('Are you sure you want to return this book?');">
                                    Return
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="alert alert-info text-center">
                    No books to return.
                </div>
            <?php } ?>

            <a href="dashboard.php" class="btn btn-secondary mt-3">
                ← Back to Dashboard
            </a>

        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
