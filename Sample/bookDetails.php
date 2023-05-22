<?php
include 'header.php';

$bookKey = $_GET['Book_Key'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookreview";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT b.*, c.Category_Name, AVG(r.Rating) AS AverageRating, COUNT(r.Review_ID) AS ReviewCount
        FROM tblbook b
        JOIN tblcategory c ON b.Category_Key = c.Category_Key
        LEFT JOIN tblreview r ON b.Book_Key = r.Book_Key AND r.Status = 1
        WHERE b.Book_Key = ?
        GROUP BY b.Book_Key";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bookKey);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $book = $result->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body {
                background-color: skyblue;
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            .container {
                display: flex;
                flex-direction: column;
                align-items: center;
                min-height: 100vh;
            }

            .book-details {
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .book-details h2 {
                text-align: center;
                font-weight: bold;
            }

            .book-details p {
                font-weight: bold;
            }

            .review-container {
                margin-top: 20px;
            }

            .review {
                background-color: #f9f9f9;
                padding: 10px;
                border-radius: 5px;
                margin-bottom: 10px;
            }

            .username {
                font-weight: bold;
            }

            .review-title {
                font-weight: bold;
                margin-left: 5px;
            }

            .rating {
                font-weight: bold;
                color: blue;
                display: inline-block;
                margin-left: 5px;
            }

            .review-date {
                font-size: 0.8em;
                color: gray;
                margin-top: 5px;
            }

            .add-review-button {
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .add-review-button:hover {
                background-color: #45a049;
            }

            .delete-btn {
                margin-top: 10px;
                padding: 5px 10px;
                background-color: #FF0000;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .delete-btn:hover {
                background-color: #CC0000;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="book-details">
                <h2><?php echo $book['Title']; ?></h2>
                <p><strong>Category:</strong> <?php echo $book['Category_Name']; ?></p>
                <p><strong>ISBN:</strong> <?php echo $book['ISBN']; ?></p>
                <p><strong>Author:</strong> <?php echo $book['Authors_Firstname'] . ' ' . $book['Authors_Lastname']; ?></p>
                <p><strong>Description:</strong> <?php echo $book['description']; ?></p>
                <p><strong>Average Rating:</strong> <?php echo number_format($book['AverageRating'], 2); ?>/5</p>
                <p><strong>Number of Reviews:</strong> <?php echo $book['ReviewCount']; ?></p>
                
                <?php
                if (isset($_SESSION['userType']) && $_SESSION['userType'] == 2) {
                    echo '<form action="deleteBook.php" method="post">';
                    echo '<input type="hidden" name="book_key" value="' . $book['Book_Key'] . '">';
                    echo '<button class="delete-btn" type="submit" name="delete">Delete Book</button>';
                    echo '</form>';
                }
                ?>
                
            </div>

            <div class="review-container">
                <?php
                $sql = "SELECT * FROM tblreview WHERE Book_Key = ? AND Status = 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $bookKey);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="review">';
                        echo '<p class="username"> ' . $row['Username'] . '</p>';
                        echo '<p class="review-title"><strong>Title:</strong> ' . $row['Title'] . '</p>';
                        echo '<p class="rating"><strong>Rating:</strong> ' . $row['Rating'] . '/5</p>';
                        echo '<p class="review-date">' . $row['Date'] . ', ' . $row['Time'] . '</p>';
                        echo '<p class="review-content">' . $row['Review'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    // No reviews available
                }

                if (isset($_SESSION['username'])) {
                    echo '<a href="addReview.php?Book_Key=' . $bookKey . '" class="add-review-button">Add a Review</a>';
                }

                $stmt->close();
                ?>
            </div>
        </div>

        <?php require_once 'footer.php'; ?>
    </body>
    </html>
    <?php
} else {
    echo "Book not found.";
}

$conn->close();
?>
