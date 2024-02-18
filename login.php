<?php

$uname = $_POST['uname'];
$psw  = $_POST['psw'];





if (!empty($uname) || !empty($psw))
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "event";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT uname From login Where uname = ? Limit 1";
  $INSERT = "INSERT Into login (uname , psw )values(?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $uname);
     $stmt->execute();
     $stmt->bind_result($uname);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ss", $uname,$psw);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>