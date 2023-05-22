<?php
require_once 'header.php';

$mysqli = new mysqli('localhost', 'root', '', 'bookreview') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM tblreview WHERE Status = 1") or die($mysqli->error);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reviews</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .container {
            padding: 20px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .review-box {
            width: 400px;
            margin-bottom: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            word-wrap: break-word;
        }

        .book-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .username {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .review-content {
            margin-top: 10px;
        }

        .review-text {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .delete-btn {
            margin-top: 10px;
            padding: 6px 12px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Reviews</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $bookID = $row['Book_Key'];
            $bookResult = $mysqli->query("SELECT * FROM tblbook WHERE Book_Key = $bookID") or die($mysqli->error);
            $book = $bookResult->fetch_assoc();

            echo '<div class="review-box">';
            echo '<p class="book-title"><strong>Book Title:</strong> ' . $book['Title'] . '</p>';
            echo '<p class="username"><strong>Username:</strong> ' . $row['Username'] . '</p>';
            echo '<div class="review-content">';
            echo '<p class="review-text"><strong>Review:</strong></p>';
            echo '<p>' . $row['Review'] . '</p>';

            if (isset($_SESSION['userType']) && ($_SESSION['userType'] == 1 || $_SESSION['userType'] == 2)) {
                echo '<form action="deleteReview.php" method="post">';
                echo '<input type="hidden" name="review_id" value="' . $row['Review_ID'] . '">';
                echo '<button class="delete-btn" type="submit" name="delete">Delete</button>';
                echo '</form>';
            }

            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>No reviews available.</p>';
    }
    ?>
</div>

<?php require_once 'footer.php'; ?>

</body>
</html>
