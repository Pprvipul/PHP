<?php

include_once("dbconn.php");
// $connect = mysqli_connect("localhost", "root", "", "testing");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM [dbo].[user] WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($biconn, $query))
 {
  echo 'Data Deleted';
 }
}
?>