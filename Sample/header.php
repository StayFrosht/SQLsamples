<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookreview";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tblcategory";
$result = $conn->query($sql);
$categories = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <nav>
        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Categories</a>
                <div class="dropdown-content">
                    <?php
                    foreach ($categories as $category) {
                        echo '<a href="category.php?Category_Key=' . $category['Category_Key'] . '">' . $category['Category_Name'] . '</a>';
                    }
                    ?>
                </div>
            </li>
            <li><a href="reviews.php">Reviews</a></li>
            <li><a href="aboutUs.php">About Us</a></li>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<li><a href="logout.php">Logout</a></li>';
                echo '<li><a href="profile.php">' . $_SESSION['username'] . '</a></li>';
            } else {
                echo '<li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">Login</a>
                    <div class="dropdown-content">
                        <a href="login.php">Sign In</a>
                        <a href="register.php">Register</a>
                    </div>
                </li>';
            }
            ?>
        </ul>
    </nav>
</body>
</html>

<?php
$conn->close();
?>
