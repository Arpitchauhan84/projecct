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
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = $_POST['name'];
            $Area = $_POST['area'];
            $con = $_POST['con'];
            $year=$_POST['year'];

$sql = "INSERT INTO `emp_data`(`Name`, `Area`, `Contact_no`, `E_year`) VALUES ('$name','$Area','$con','$year')";

        $result = mysqli_query($conn, $sql);
 
        if($result){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your entry has been submitted successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
        }
        else{
           
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
        }

      }

    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<form action="data_insert1.php" method="post">
  <div class="mb-3 m-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="name" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb- m-3">
    <label for="exampleInputPassword1" class="form-label">Area</label>
    <input type="text" name="area" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 m-3">
    <label for="exampleInputPassword1" class="form-label">Contact No</label>
    <input type="text" name="con" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 m-3">
    <label for="exampleInputPassword1" class="form-label">Experience Year</label>
    <input type="text" name="year" class="form-control" id="exampleInputPassword1">
  </div>

  <button type="submit" name="submit" class="btn btn-primary m-3">Submit</button>
</form>
</body>
</html>