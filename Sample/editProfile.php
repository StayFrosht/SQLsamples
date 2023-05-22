<?php 
$title = 'Edit Profile';
require_once 'header.php'; 

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$mysqli = new mysqli('localhost', 'root', '', 'bookreview') or die(mysqli_error($mysqli));
$username = $_SESSION['username'];
$result = $mysqli->query("SELECT * FROM tbluseraccount WHERE username='$username'") or die($mysqli->error);
$row = $result->fetch_assoc();

if(isset($_POST['submit'])) {   
    $newUsername = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $mysqli->query("UPDATE tbluseraccount SET username='$newUsername', password='$password', firstname='$firstname', lastname='$lastname' WHERE username='$username'") or die($mysqli->error);

    // Destroy the current session
    session_destroy();

    header("Location: login.php");
    exit();
}
?>

<link rel="stylesheet" href="css/all.css">

<div class="container">
    <h2>Edit Profile</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($row['username']) ? $row['username'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo isset($row['firstname']) ? $row['firstname'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo isset($row['lastname']) ? $row['lastname'] : ''; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary profile-button" name="submit">Save Changes</button>
    </form>
</div>

<?php require_once 'footer.php'; ?>
