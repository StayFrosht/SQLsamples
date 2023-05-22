<?php
require_once 'header.php';

$bookKey = $_POST['book_key'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookreview";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("DELETE FROM tblbook WHERE Book_Key = ?");
$stmt->bind_param("i", $bookKey);
$stmt->execute();


$stmt = $conn->prepare("DELETE FROM tblreview WHERE Book_Key = ?");
$stmt->bind_param("i", $bookKey);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: index.php");
exit();
?>
