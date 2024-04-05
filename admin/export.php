<?php  
      //export.php  
 if(isset($_POST["export"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "lib-server");  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=HED Library Book List.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Accession No.', 'Call No.', 'ISBN', 'Title', 'Author', 'Publisher', 'Copyright Year'));  
      $query = "SELECT bookAccession, callNumber, isbn, bookTitle, author, publisher, datePublished FROM books ORDER BY id DESC";  
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
      exit;
 }  
 ?>