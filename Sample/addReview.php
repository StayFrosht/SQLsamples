<?php

include 'header.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


if (!isset($_GET['Book_Key'])) {
    echo "Book not found.";
    exit();
}

$bookKey = $_GET['Book_Key'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bookreview";

  
    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_SESSION['username'];
    $title = $_POST['title'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];
    $status = "Pending";

    $sql = "INSERT INTO tblreview (Book_Key, Username, Date, Time, Title, Review, Rating, Status)
    VALUES (?, ?, CURDATE(), CURTIME(), ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssii", $bookKey, $username, $title, $review, $rating, $status);

    if ($stmt->execute()) {
        echo "Review added successfully.";
        header("Location: bookDetails.php?Book_Key=" . $bookKey);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Review</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-weight: bold;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        
        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .btn-primary:hover {
            background-color: #0069d9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Review</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="title">Review Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="review">Review</label>
                <textarea class="form-control" id="review" name="review" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="rating">Rating</label>
                <select class="form-control" id="rating" name="rating" required>
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3 <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>