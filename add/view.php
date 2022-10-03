<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled JQuery  -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    


</head>
<body style="margin: 50px;">
    <h1>Product List</h1>
    <br>

    <table class="table" id="main">
  <thead class="thead-dark">
    <tr>
      <th scope="col">order_items_id</th>
      <th scope="col">item_name</th>
      <th scope="col">item_quantity</th>
      <th scope="col">item_unit</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
    <?php
    include_once("Config/dbconn.php");

    // red all row from database
    $sql=" Select * FROM [VIPUL_DB].[dbo].[tbl_order_items]";
    $result = sqlsrv_query($biconn,$sql);

    if(!$result){
        die("Invalid query:" .$biconn->error);
    }
// read data of eatch row

while($row = sqlsrv_fetch_array($result)){

    echo"<tr>
     
      <td>".$row["order_items_id"]."</td>
      <td>".$row["item_name"]."</td>
      <td>".$row["item_quantity"]."</td>
      <td>".$row["item_unit"]."</td>
      <td>
        <a href='Edit.php?edit_id=".$row["order_items_id"]."' class= 'btn btn-success btn-sm'>Edit </a>
        <a class ='btn btn-danger btn-sm' onclick='delete_data(".$row["order_items_id"].")'>Delete</a>
        </td>
     </tr>";
    
}
    
    ?>
  </tbody>
</table>


    
</body>
</html>

<script>

function delete_data(ID)
{
    
    if(ID != '')  
	  {  
        
	         $.ajax({  
	              url:"delete.php",  
	              method:"POST",  
	              data:{ID:ID},  
	              success:function(data){
	               alert(data)
                   location.reload();
	              }  
	         });  
	    }
	  else
	  {
		  alert("ID Not Exist");
	  }

}
</script>
<!-- Edit code -->
<script>
function edit_id(order_items_id){
  $('#hidden_user_id').val(order_items_id);

  $.post("update.php",{
    order_items_id:order_items_id
  },function(data,status){
    var user  = JSON.parse(data);
    $('#u_item_name').val(user.item_name);
    $('#u_item_quantity').val(user.item_quantity);
    $('#u_item_unit').val(user.item_unit);
  });
$('#update_user_model').model("show");

}


</script>



<script> 
$(document).ready( function () {
    $('#main').DataTable();
} );
</script>
