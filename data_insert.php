<?php

$insert = false;
$update = false;
$delete = false;
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "emp";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn) {
  die("Sorry we failed to connect: " . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `emp_data` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['snoEdit'])) {
    // Update the record
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "emp";
    // Sql query to be executed
    $sql = "UPDATE `emp_data` SET `Name`='$name',`Area`='$Area',`Contact_no`='$con',`E_year`='$year'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $update = true;
    } else {
      echo "We could not update the record successfully";
    }
  } else {
    $name = $_POST['name'];
    $Area = $_POST['area'];
    $con = $_POST['con'];
    $year = $_POST['year'];

    // Sql query to be executed
    $sql = "INSERT INTO `emp_data`(`Name`, `Area`, `Contact_no`, `E_year`) VALUES ('$name','$Area','$con','$year')";
    $result = mysqli_query($conn, $sql);


    if ($result) {
      $insert = true;
    } else {
      echo "The record was not inserted successfully because of this error ---> " . mysqli_error($conn);
    }
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


  <title>Employee Details</title>

</head>

<body>


  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="data_insert.php" method="post">
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
      </div>
    </div>
  </div>

  <?php
  if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if ($delete) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your data has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if ($update) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <div class="container my-4">
    <h2>Employee Details</h2>
    <form action="data_insert.php" method="post">
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
  </div>

  <div class="container my-4">


    <table class="table" id="myTable">
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
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo "<tr>
             <th scope='row'>" . $sno . "</th>
             <td><a href='emp_deatils.php'>" . $row['Name'] . "</a></td>
             <td><a href='emp_deatils.php'>" . $row['Area'] . "</a></td>
             <td><a href='emp_deatils.php'>" . $row['Contact_no'] . "</a></td>
             <td><a href='emp_deatils.php'>" . $row['E_year'] . "</a></td>
            <td> <button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button> <button class='delete btn btn-sm btn-primary' id=d" . $row['sno'] . ">Delete</button>  </td>
          </tr>";
        }
        ?>


      </tbody>
    </table>
  </div>
  <hr>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this data!")) {
          console.log("yes");
          window.location = `/ASSIMENT/data_insert.php?delete=${sno}`;
        } else {
          console.log("no");
        }
      })
    })
  </script>
</body>

</html>