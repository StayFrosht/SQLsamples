<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bookreview";

    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    
    $sql = "SELECT * FROM tbluseraccount WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username already exists";
        exit;
    }

    $sql = "INSERT INTO tbluseraccount (Username, Password, userType, Firstname, Lastname, Email)
            VALUES (?, ?, 0, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $password, $firstname, $lastname, $email);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<?php include 'header.php'; ?>

<div class="container">
    <h2>Register</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
        <input type="submit" value="Register">
    </form>
</div>

<?php include 'footer.php'; ?>
