<?php
include_once("dbconn.php");
// $connect = mysqli_connect("localhost", "root", "", "testing");
if(isset($_POST["id"]))
{
 $value = $_POST["value"];
 $query = "UPDATE [dbo].[user] SET ".$_POST["column_name"]."='".$value."' WHERE id = '".$_POST["id"]."'";
 if(sqlsrv_query($biconn, $query))
 {
  echo 'Data Updated';
 }
}
?>
