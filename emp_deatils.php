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
            $name = $_POST['name'];
            $Area = $_POST['area'];
            $con = $_POST['con'];
            $year=$_POST['year'];
            
        echo "<script>console.log('Connection Successful')</script>";
        $sql = "UPDATE `emp_data` SET `Name`='$name',`Area`='$Area',`Contact_no`='$con',`E_year`='$year'";
        $result = mysqli_query($conn, $sql);
        if($result){
          $update = true;
      }
      else{
          echo "We could not update the record successfully";
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
</head>
<body>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit empl</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/ASSIMENT/emp_deatils.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Name</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Area</label>
              <input type="text" name="area" class="form-control" id="exampleInputPassword1">
            </div> 
            <div class="mb-3">
             <label for="exampleInputPassword1" class="form-label">Contact No</label>
             <input type="text" name="con" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
             <label for="exampleInputPassword1" class="form-label">Experience Year</label>
             <input type="text" name="year" class="form-control" id="exampleInputPassword1">
            </div>
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button> 

<?php
{
    $sql= "SELECT * FROM `emp_data`";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    echo "Employee Details";
    if($num> 0){
    while($row = mysqli_fetch_assoc($result)){
    // echo var_dump($row);
    echo "Name:". $row['Name'] ."<br>";
    echo "Area:".$row['Area'] ."<br>";
    echo " Contact No:". $row['Contact_no']."<br>";
    echo "Experience Year:".$row['E_year'];
    echo "<br>";
    echo "<br>";
       }
  }
}
?>
</body>
 <script>
    $(document).ready(function () {
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

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/ASSIMENT/emp_deatils.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</html>