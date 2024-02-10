<?php
// connecting to db
$servername="localhost";
$usrname="root";
$pass="";// it take value from remote server
$db="college";

//create a connection 
$conn=mysqli_connect($servername,$usrname,$pass,$db);
if($conn){
  echo "connection successful";
  echo "</br>";
}else{
  die("sorry we failed to connect ". mysqli_connect_error());
}
// query
$query="SELECT * FROM student";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
// Fetching rows from the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Process each row
    // $row is an associative array where keys are column names
    echo $row['name']; // Accessing column values by column name
    echo "</br>";
}
//create table 
$tbl="CREATE TABLE `student2` (`sno` INT(10) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `age` INT(12) NOT NULL , `city` VARCHAR(13) NOT NULL , PRIMARY KEY (`sno`))";
$table = mysqli_query($conn, $tbl);
if($table){
  echo "table created successful";
}else{
  die("table not created successful ". mysqli_connect_error());
}
// Free the result set
mysqli_free_result($result);


?>