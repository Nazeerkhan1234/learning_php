<?php
// connecting to db
$servername="localhost";
$usrname="root";
$pass="";// it take value from remote server
$db="harry";
//create a connection 
$conn=mysqli_connect($servername,$usrname,$pass,$db);
if($conn){
  echo "connection successful";
}else{
  die("sorry we failed to connect ". mysqli_connect_error());
}
// query
$query="SELECT * FROM employe";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
// Fetching rows from the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Process each row
    // $row is an associative array where keys are column names
    echo $row['username']; // Accessing column values by column name
}
// Free the result set
mysqli_free_result($result);

?>