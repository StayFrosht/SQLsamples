<?php
include 'header.php';


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookreview";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT userType FROM tbluseraccount WHERE Username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$userType = $row['userType'];


?>

<div class="container">
    <div class="hello">
        <h2>
            <?php
            switch ($userType) {
                case 0:
                    echo "Hello, User " . $_SESSION['username'];
                    break;
                case 1:
                    echo "Hello, Moderator " . $_SESSION['username'];
                    break;
                case 2:
                    echo "Hello, Admin " . $_SESSION['username'];
                    break;
            }
            ?>
        </h2>
    </div>

    <div class="buttons">
        <?php
        switch ($userType) {
            case 0:
                echo '<button class="profile-button" onclick="location.href=\'editProfile.php\'">Edit Profile</button>';
                break;
            case 1:
                echo '<button class="profile-button" onclick="location.href=\'validateReview.php\'">Review Validations</button>';
                echo '<button class="profile-button" onclick="location.href=\'banUser.php\'">Ban Management</button>';

                break;
            case 2:
                echo '<button class="profile-button" onclick="location.href=\'addBook.php\'">Add Books</button>';
                echo '<button class="profile-button" onclick="location.href=\'addAdmin.php\'">Add Admins</button>';
                echo '<button class="profile-button" onclick="location.href=\'addModerator.php\'">Add Moderators</button>';
                echo '<button class="profile-button" onclick="location.href=\'addCategory.php\'">Add Categories</button>';
                echo '<button class="profile-button" onclick="location.href=\'deleteAdmin.php\'">Delete Admin</button>';
                echo '<button class="profile-button" onclick="location.href=\'deleteModerator.php\'">Delete Moderator</button>';
                echo '<button class="profile-button" onclick="location.href=\'deleteUser.php\'">Delete User</button>';

                break;
        }
        ?>
        <button class="logout-button" onclick="location.href='logout.php'">Logout</button>
    </div>
</div>

<?php include 'footer.php'; ?>

<?php
$conn->close();
?>
