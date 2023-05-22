<?php 

$title = 'Home';
require_once 'header.php'; 

?>
<!DOCTYPE html>
<html>
<head>
    
</head>
<body>

<div class="container">
    <h2>Book List</h2>
    <div id="books"></div>
</div>

<script>
fetch('getBooks.php')
.then(response => response.json())
.then(data => {
    const booksDiv = document.getElementById('books');
    data.forEach(book => {
        const bookDiv = document.createElement('div');
        bookDiv.className = 'book';
        bookDiv.innerHTML = '<h3>' + book.Title + '</h3>' +
            '<p>Author: ' + book.Authors_Firstname + ' ' + book.Authors_Lastname + '</p>';
        bookDiv.onclick = function() {
            window.location.href = 'bookDetails.php?Book_Key=' + book.Book_Key;
        };
        booksDiv.appendChild(bookDiv);
    });
})
.catch(error => console.error(error));
</script>

</body>
</html>
<?php 
include 'footer.php'; 
?>
