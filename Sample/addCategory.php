<?php
include 'header.php';
if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bookreview";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $categoryName = $_POST['categoryName'];

    $sql = "SELECT * FROM tblcategory WHERE Category_Name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $categoryName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Category already exists";
        exit;
    }

    $sql = "INSERT INTO tblcategory (Category_Name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $categoryName);

    if ($stmt->execute()) {
        echo "Category added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<?php  ?>

<div class="container">
    <h2>Add Category</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="categoryName">Category Name:</label>
        <input type="text" id="categoryName" name="categoryName" required>
        <input type="submit" value="Add Category">
    </form>
</div>

<?php include 'footer.php'; ?>
