<?php
require_once 'header.php';

$mysqli = new mysqli('localhost', 'root', '', 'bookreview') or die(mysqli_error($mysqli));

if (isset($_POST['delete'])) {
    $reviewID = $_POST['review_id']; 


    $mysqli->query("DELETE FROM tblreview WHERE Review_ID = $reviewID") or die($mysqli->error);

    echo "Review deleted successfully.";
}

?>

<?php require_once 'footer.php'; ?>
