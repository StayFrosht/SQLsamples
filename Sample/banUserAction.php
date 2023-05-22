<?php
require_once 'header.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookreview";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['ban'])) {
    $username = $_POST['username'];

    $stmt = $conn->prepare("UPDATE tbluseraccount SET Status = 1 WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    echo "User '$username' has been banned.";
} elseif (isset($_POST['unban'])) {
    $username = $_POST['username'];
    $stmt = $conn->prepare("UPDATE tbluseraccount SET Status = 0 WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    echo "User '$username' has been unbanned.";
}

$stmt->close();
$conn->close();

require_once 'footer.php';
?>
