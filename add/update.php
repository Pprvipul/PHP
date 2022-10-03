<?php
include_once("Config/dbconn.php");

if(!empty($_POST["T_ID"]))
{
    $T_ID =$_POST["T_ID"];
    $item_name = $_POST["item_name"];
    $item_quantity = $_POST["item_quantity"];
    $item_unit = $_POST["item_unit"];

    for($i=0;$i<count($item_name);$i++)
  {
    $query ="
    update [VIPUL_DB].[dbo].[tbl_order_items]
    set
    [item_name]='$item_name[$i]'
      ,[item_quantity]='$item_quantity[$i]'
      ,[item_unit]='$item_unit[$i]'
      where [order_items_id]='$T_ID[$i]'   
    
    ";

     sqlsrv_query($biconn, $query);   

}



}

?>