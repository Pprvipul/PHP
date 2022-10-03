<?php

include_once("Config/dbconn.php");

if(isset($_POST["item_name"]))
{
 $item_name = $_POST["item_name"];
 $item_quantity = $_POST["item_quantity"];
 $item_unit = $_POST["item_unit"];

 for($i=0;$i<count($item_name);$i++)
 {
    $query = "INSERT INTO [dbo].[tbl_order_items] (item_name, item_quantity,item_unit) 
    VALUES('$item_name[$i]', '$item_quantity[$i]','$item_unit[$i]')";
    sqlsrv_query($biconn, $query);
 }

 
 
//   echo 'Data Inserted';

}
?>