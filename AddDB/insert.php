<?php

include_once("dbconn.php");
// $connect = mysqli_connect("localhost", "root", "", "testing");
//echo $_POST["last_name"];
if(isset($_POST["first_name"], $_POST["last_name"]))
{
 $first_name = $_POST["first_name"];
 $last_name = $_POST["last_name"];
 $query = "INSERT INTO [dbo].[user](first_name, last_name) VALUES('$first_name', '$last_name')";
//  print_r($query);
 if(sqlsrv_query($biconn, $query))
 {
  echo 'Data Inserted';
 }
}
?>