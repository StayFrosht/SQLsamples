<?php

require_once 'header.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$title = 'Validate Review';

$mysqli = new mysqli('localhost', 'root', '', 'bookreview') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM tblreview WHERE Status = 0") or die($mysqli->error);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
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

        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            margin-right: 10px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><?php echo $title; ?></h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="review-box">';
            echo '<div class="review">';
            echo '<p class="username"><strong>Username:</strong> ' . $row['Username'] . '</p>';
            echo '<div class="review-content">';
            echo '<p class="review-text"><strong>Review:</strong></p>';
            echo '<p>' . $row['Review'] . '</p>';
            echo '</div>';
            echo '<form action="updateReview.php" method="post">';
            echo '<input type="hidden" name="reviewID" value="' . $row['Review_ID'] . '">';
            echo '<button type="submit" class="btn btn-primary" name="validate">Validate</button>';
            echo '<button type="submit" class="btn btn-danger" name="reject">Reject</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>No reviews to validate.</p>';
    }
    ?>
</div>

<?php require_once 'footer.php'; ?>

</body>
</html>
