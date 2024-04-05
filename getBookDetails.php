<?php
// getBookDetails.php

require 'conn.php';

if (isset($_POST['bookTitle'])) {
    $bookTitle = $_POST['bookTitle'];

    $query = mysqli_query($conn, "SELECT * FROM books WHERE bookTitle = '$bookTitle' LIMIT 1");
    
    if ($query) {
        $bookDetails = mysqli_fetch_assoc($query);
        echo json_encode($bookDetails);
    } else {
        echo json_encode(['error' => 'Unable to fetch book details']);
    }
} else {
    echo json_encode(['error' => 'Book title not provided']);
}
?>
