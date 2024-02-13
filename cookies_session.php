<?php
setcookie("category","books",time()+24*60*60,"/");
$a= $_COOKIE["category"];
echo $a;
// verify the user to login info
session_start();
$_SESSION['username']="Nazeer";
echo "we saved your session";
// get info
if(isset($_SESSION['username'])){
  echo "<br> welcome ".$_SESSION['username'];
}else{
  echo "please login to continue";
}
session_unset();
// session_destroy();
if(isset($_SESSION['username'])){
  echo "welcome ".$_SESSION['username'];
}else{
  echo "<br> you have been log out";
}
?>