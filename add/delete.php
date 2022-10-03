<?php 
include_once("Config/dbconn.php");

if(isset($_POST["ID"]))
{
    $ID =$_POST["ID"];
   
        $query="Delete FROM [VIPUL_DB].[dbo].[tbl_order_items] where [order_items_id]='$ID'
                ";    
                //print_r($query);
               $res= sqlsrv_query($biconn, $query);
    
    if($res)
    {
        $data ="Data Deleted Successfully...";
        echo  $data;
        
    }
}

?>