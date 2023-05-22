<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookreview";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbluseraccount WHERE Username = ? AND Password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $_POST['username'], $_POST['password']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    session_start();
    $row = $result->fetch_assoc();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['userType'] = $row['userType'];
    header("Location: index.php");
} else {
    echo "Invalid credentials";
}

$conn->close();
?>
