<?php
$title = "Add Book";
require_once 'header.php';
if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookreview";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding books
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['addBook'])) {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $isbn = $_POST['isbn'];
        $authorFirstName = $_POST['authorFirstName'];
        $authorLastName = $_POST['authorLastName'];
        $description = $_POST['description'];

        // Perform any validation or checks here

        $sql = "INSERT INTO tblbook (Title, Category_Key, ISBN, Authors_Firstname, Authors_Lastname, Description) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $title, $category, $isbn, $authorFirstName, $authorLastName, $description);
        if ($stmt->execute()) {
            echo "Category added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>

<style>
.container select,
.container textarea {
    height: 200px;
    width: 435px;
    resize: horizontal;
}

.container select#category {
    height: 40px; /* Adjust the height as needed */
}
</style>

<div class="container">
    <h2>Add Book</h2>

    <form action="" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <label for="category">Category:</label>
        <?php
        // Retrieve categories from the database
        $categorySql = "SELECT * FROM tblcategory";
        $categoryResult = $conn->query($categorySql);
        ?>
        <select id="category" name="category" required>
            <?php while ($categoryRow = $categoryResult->fetch_assoc()) : ?>
                <option value="<?php echo $categoryRow['Category_Key']; ?>"><?php echo $categoryRow['Category_Name']; ?></option>
            <?php endwhile; ?>
        </select>
        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" required>
        <label for="authorFirstName">Author's First Name:</label>
        <input type="text" id="authorFirstName" name="authorFirstName" required>
        <label for="authorLastName">Author's Last Name:</label>
        <input type="text" id="authorLastName" name="authorLastName" required>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <input type="submit" name="addBook" value="Add Book">
    </form>
</div>

<?php include 'footer.php'; ?>
