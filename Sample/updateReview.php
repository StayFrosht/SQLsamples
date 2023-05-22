<?php

require_once 'header.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['validate'])) {

        $reviewID = $_POST['reviewID'];

        
        $mysqli = new mysqli('localhost', 'root', '', 'bookreview') or die(mysqli_error($mysqli));
        $mysqli->query("UPDATE tblreview SET Status = 1 WHERE Review_ID = $reviewID") or die($mysqli->error);

        
        header("Location: validateReview.php");
        exit();
    }
    
    if (isset($_POST['reject'])) {
        
        $reviewID = $_POST['reviewID'];

        
        $mysqli = new mysqli('localhost', 'root', '', 'bookreview') or die(mysqli_error($mysqli));
        $mysqli->query("DELETE FROM tblreview WHERE Review_ID = $reviewID") or die($mysqli->error);

        
        header("Location: validateReview.php");
        exit();
    }
}
