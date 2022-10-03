<?php
include_once("Config/dbconn.php");

function fill_unit_select_box()
{
    require("Config/dbconn.php");
	// $output = '';

	$sql = "SELECT * FROM [dbo].[tbl_unit] ORDER BY unit_name ASC";
    $res=sqlsrv_query($biconn,$sql);
	// $result = $biconn->sqlsrv_query($query);
    while($list=sqlsrv_fetch_array($res)) {

	    echo  '<option value="'.$list["unit_name"].'">'.$list["unit_name"] . '</option>';
	}

	
}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Add Remove Select Box Fields Dynamically using jQuery Ajax in PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">Add Remove Select Box Fields Dynamically using jQuery Ajax in PHP</h3>
   <br />
   <h4 align="center">Enter Item Details</h4>
   <br />
   <form method="post" id="insert_form">
    <div class="table-repsonsive">
     <span id="error"></span>
     <table class="table table-bordered" id="item_table">
      <tr>
        <th>SL.No</th>
       <th>Enter Item Name</th>
       <th>Enter Quantity</th>
       <th>Select Unit</th>
       <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
      </tr>
     </table>
     <div align="center">
      <input type="submit" name="submit" class="btn btn-info" value="Insert" />
     </div>
    </div>
   </form>
  </div>

  <div id="Test"></div>
 </body>
</html>

<script>

$(document).ready(function(){

	var count = 0;
	
	function add_input_field(count)
	{
 var row_count =parseInt(count)+1;

		var html = '';

		html += '<tr>';
        html += '<td><input type="text" name="SL.No" value="'+row_count+'"class="form-control" /></td>';
		html += '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';

		html += '<td><input type="text" name="item_quantity[]" class="form-control item_quantity" /></td>';

		html += '<td><select name="item_unit[]" class="form-control selectpicker" data-live-search="true"><option value="">Select Unit</option><?php echo fill_unit_select_box(); ?></select></td>';

		var remove_button = '';

		if(count > 0)
		{
			remove_button = '<button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="glyphicon glyphicon-remove"></i></button>';
		}

		html += '<td>'+remove_button+'</td></tr>';

		return html;

	}

    //$("#Test").html(add_input_field(count));

	$('#item_table').append(add_input_field(0));

	//$('.selectpicker').selectpicker('refresh');

	$(document).on('click', '.add', function(){

		count++;

		$('#item_table').append(add_input_field(count));

		//$('.selectpicker').selectpicker('refresh');

	});

	$(document).on('click', '.remove', function(){

		$(this).closest('tr').remove();

	});

	$('#insert_form').on('submit', function(event){

		event.preventDefault();

		var error = '';

       
		count = 1;

		$('.item_name').each(function(){

			if($(this).val() == '')
			{

				error += "<li>Enter Item Name at "+count+" Row</li>";

			}

			count = count + 1;

		});

		count = 1;

		$('.item_quantity').each(function(){

			if($(this).val() == '')
			{

				error += "<li>Enter Item Quantity at "+count+" Row</li>";

			}

			count = count + 1;

		});

		count = 1;

		$("select[name='item_unit[]']").each(function(){

			if($(this).val() == '')
			{

				error += "<li>Select Unit at "+count+" Row</li>";

			}

			count = count + 1;

		});

		var form_data = $(this).serialize();

		if(error == '')
		{
            

			$.ajax({

				url:"insert.php",

				method:"POST",

				data:form_data,

				beforeSend:function()
	    		{

	    			$('#submit_button').attr('disabled', 'disabled');

	    		},

				success:function(data)
				{

                    
                    $('#Test').html(data);
					

						$('#item_table').find('tr:gt(0)').remove();

						$('#error').html('<div class="alert alert-success">Item Details Saved</div>');

						$('#item_table').append(add_input_field(0));

						//$('.selectpicker').selectpicker('refresh');

						$('#submit_button').attr('disabled', false);

							if (confirm('Data is saved')) {
								window.location.href='view.php';
							} else {
								window.location.href='index.php';
							}
													
					

				}
			})

		}
		else
		{
			$('#error').html('<div class="alert alert-danger"><ul>'+error+'</ul></div>');
		}

	});
	 
});



</script>