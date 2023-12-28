<?php
$servername = "localhost";
      $username = "root";
      $password = "";
      $database = "emp";

      $conn = mysqli_connect($servername, $username, $password, $database);
      // Die if connection was not successful
      if (!$conn){
          die("Sorry we failed to connect: ". mysqli_connect_error());
      }
      else{
        echo "<script>console.log('Connected Successfully')</script>";
      }
      ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Area</th>
      <th scope="col">Contact No</th>
      <th scope="col">Experience Year</th>
    </tr>
  </thead>
  <tbody>
  <?php 
          $sql = "SELECT * FROM `emp_data`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <td><a href='emp_deatils.php'>". $row['Name'] . "</a></td>
            <td><a href='emp_deatils.php'>". $row['Area'] . "</a></td>
            <td><a href='emp_deatils.php'>". $row['Contact_no'] . "</a></td>
            <td><a href='emp_deatils.php'>". $row['E_year'] . "</a></td>
          </tr>";
        } 
          ?>
  </tbody>
</table>
</body>
</html>