<?php
$title = "About Us";
require_once 'header.php';

?>

<style>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: calc(100vh - 60px);
}

.about-title {
  text-align: center;
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}

.about-text {
  text-align: justify;
  max-width: 600px;
  padding: 20px;
  background-color: #f5f5f5;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
</style>

<div class="container">
  <div class="about-text">
    <h2 class="about-title">About Us</h2>
    <p>Welcome to our book review website! We are students from Cebu Institute Of Technology - University (CIT-U) currently pursuing our second year in Computer Science. As avid readers and technology enthusiasts, we have created this platform to share our thoughts and opinions on various books.</p>
    <p>Our goal is to provide helpful and insightful book reviews that can guide readers in their literary adventures. Whether you're a fan of fantasy, science fiction, romance, mystery, or any other genre, our website aims to offer you valuable recommendations and critiques.</p>
    <p>Thank you for visiting our website and we hope you enjoy exploring our book reviews. Happy reading!</p>
  </div>
</div>

<?php include 'footer.php'; ?>
