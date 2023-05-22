<?php
$title = 'Delete Admin';
require_once 'header.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$mysqli = new mysqli('localhost', 'root', '', 'bookreview') or die(mysqli_error($mysqli));
$currentUsername = $_SESSION['username'];

// Check if the delete operation is performed
if (isset($_GET['username'])) {
    $deleteUsername = $_GET['username'];

    // Get the user type of the user to be deleted
    $result = $mysqli->query("SELECT userType FROM tbluseraccount WHERE username = '$deleteUsername'") or die($mysqli->error);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $deleteUserType = $row['userType'];
    } else {
        echo "Error: User to delete not found.";
        exit();
    }

    // Check if the current user has the privilege to delete the user based on userType
    if ($currentUsername !== $deleteUsername && $deleteUserType == 2) {
        $mysqli->query("DELETE FROM tbluseraccount WHERE username = '$deleteUsername'") or die($mysqli->error);

        echo "User deleted successfully.";
    } else {
        echo "You do not have sufficient privileges to delete this user.";
    }
}

// Get all admins except the current session's username
$result = $mysqli->query("SELECT * FROM tbluseraccount WHERE userType = 2 AND username != '$currentUsername'") or die($mysqli->error);

?>

<div class="container">
    <h2>Delete Admin</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['Username']; ?></td>
                    <td><?php echo $row['Firstname']; ?></td>
                    <td><?php echo $row['Lastname']; ?></td>
                    <td>
                        <a href="?username=<?php echo $row['Username']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require_once 'footer.php'; ?>
