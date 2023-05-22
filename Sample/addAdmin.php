<?php
$title = "Add Admin";
require_once 'header.php';
if(!isset($_SESSION['username'])){
  header("Location: index.php");
  exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookreview";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['addAdmin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];

        $sql = "INSERT INTO tbluseraccount (Username, Password, userType, Firstname, Lastname, Email) VALUES (?, ?, 2, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $username, $password, $firstname, $lastname, $email);
        if ($stmt->execute()) {
          echo "Admin added successfully";
      } else {
          echo "Error: " . $stmt->error;
      }
    }
}
?>

<div class="container">
    <h2>Add Admin</h2>

    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required>
        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <input type="submit" name="addAdmin" value="Add Admin">
    </form>
</div>

<?php include 'footer.php'; ?>
