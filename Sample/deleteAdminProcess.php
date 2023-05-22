<?php


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$mysqli = new mysqli('localhost', 'root', '', 'bookreview') or die(mysqli_error($mysqli));
$currentUsername = $_SESSION['username'];
$deleteUsername = $_GET['username'];

$result = $mysqli->query("SELECT userType FROM tbluseraccount WHERE username = '$currentUsername'") or die($mysqli->error);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentUserType = $row['userType'];
} else {
    echo "Error: Current user not found.";
    exit();
}

$result = $mysqli->query("SELECT userType FROM tbluseraccount WHERE username = '$deleteUsername'") or die($mysqli->error);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $deleteUserType = $row['userType'];
} else {
    echo "Error: User to delete not found.";
    exit();
}

if ($currentUserType > $deleteUserType) {
    $mysqli->query("DELETE FROM tbluseraccount WHERE username = '$deleteUsername'") or die($mysqli->error);

    echo "User deleted successfully.";
} else {
    echo "You do not have sufficient privileges to delete this user.";
}

$mysqli->close();
