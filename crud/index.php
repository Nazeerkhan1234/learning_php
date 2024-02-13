<?php
$create=false;
$update=false;
$delete=false;
  // connecting to db
$servername="localhost";
$usrname="root";
$pass="";
$db="college"; 
$conn=mysqli_connect($servername,$usrname,$pass,$db);
if($_SERVER["REQUEST_METHOD"]=="POST"){
  // <---------- Update  -------------->
  if(isset($_POST['snoEdit'])){
      $title=$_POST["titleEdit"];
      $desc=$_POST["descEdit"];
      $sn=$_POST["snoEdit"];
     $query1= "UPDATE `notes` SET `description` = ' $desc', `title`='$title' WHERE `notes`.`sno` = $sn";
      $result1 = mysqli_query($conn, $query1);
    if($result1){
      $update=true;
    }

    // <------------------- Create -------------->
  }else if (isset($_POST["title"])){
    $title=$_POST["title"];
    $desc=$_POST["desc"];
   $query2="INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$desc')";
   $result2 = mysqli_query($conn, $query2);
   if($result2){
    $create=true;
   }
  }
}
// <----------------Delete---------->
if(isset($_GET['delete'])){
  $sno=$_GET['delete'];
  $query3="DELETE FROM `notes` WHERE `notes`.`sno` = $sno ";
  $result3 = mysqli_query($conn, $query3);
   if($result3){
    $delete=true;
   }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>iNotes- This makes things easy</title>
  </head>
  <body>
   <!----------- Edit Modal ----------->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"           aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/learning_php/crud/index.php" method="POST">
      <input type="hidden" name="snoEdit" id="snoEdit">
     <div class="mb-2">
    <label for="titleEdit" class="form-label">Note title</label>
    <input type="text" name="titleEdit" class="form-control" id="titleEdit">
     </div>
  <div class="mb-2">
  <label for="descEdit" class="form-label">Note Description</label>
  <textarea class="form-control" id="descEdit" name="descEdit" rows="2"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Update Note</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">iNotes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-1 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/learning_php/crud">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">contact us</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<?php 
if($create){
  echo "<div class='alert alert-primary' role='alert'>
  Your note has been inserted successfully.
</div>";
}
if($update){
  echo "<div class='alert alert-primary' role='alert'>
  Your note has been updated successfully.
</div>";
}
if($delete){
  echo "<div class='alert alert-primary' role='alert'>
  Your note has been deleted successfully.
</div>";
}
?>
<div class="container mt-1">
<form action="/learning_php/crud/index.php" method="POST">
  <h2>Add a Note</h2>
  <div class="mb-2">
    <label for="title" class="form-label">Note title</label>
    <input type="text" name="title" class="form-control" id="title">
  </div>
  <div class="mb-2">
  <label for="desc" class="form-label">Note Description</label>
  <textarea class="form-control" id="desc" name="desc" rows="2"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Add Note</button>
</form>
</div>
<div class="container mt-3">
  <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  //  <------------- Read -----------------> 
  $query4="SELECT * FROM notes";
  $result4=mysqli_query($conn,$query4);
  $sn1=0;
  while($row=mysqli_fetch_assoc($result4)){
    $sn1=$sn1+1;
    $row["sno"]=$sn1;
    echo $row["sno"];
   echo "<tr>
      <th scope='row'>".$sn1."</th>
      <td>".$row['title']."</td>
      <td>".$row['description']."</td>
      <td><button class='edit btn btn-sm btn-primary' id='".$row['sno']."'>Edit</button>
      <button class='delete btn btn-sm btn-primary' id='d".$row['sno']."'>Delete</button></td>
    </tr>";
 
  }
  ?>
  </tbody>
</table>
</div>
<hr>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
      $(document).ready( function () {
         $('#myTable').DataTable();
         } );
    </script>
<script>
  // <---------- Update ------------->
  edits=document.getElementsByClassName('edit');
  Array.from(edits).forEach((e)=>{
    e.addEventListener("click",(e)=>{
      // console.log("edit",e.target.parentNode.parentNode);
      tr=e.target.parentNode.parentNode;
      title=tr.getElementsByTagName("td")[0].innerText;
      description=tr.getElementsByTagName("td")[1].innerText;
      titleEdit.value=title;
      descEdit.value=description;
      snoEdit.value=e.target.id;
      console.log(snoEdit.value);
      $('#editModal').modal('toggle');
    })
  })

  // <---------- Delete ------------->
  deletes=document.getElementsByClassName('delete');
  Array.from(deletes).forEach((e)=>{
    e.addEventListener("click",(e)=>{
      console.log(e.target.id);
      sn=e.target.id.substr(1,);
      console.log(sn);
     if(confirm("press a button!")){
      window.location=`/learning_php/crud/index.php?delete=${sn}`;
     }
    })
  })
</script>
  </body>
</html>