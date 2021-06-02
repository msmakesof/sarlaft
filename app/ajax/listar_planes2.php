<?php
session_start();
  /* Connect To Database*/
  require_once ("../components/sql_server.php");

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){

  $query = sqlsrv_query($conn,"SELECT id, CustomerKey, CustomerLogo, CustomerCity, CustomerName, CustomerNit, CustomerColor FROM CustomerSarlaft");
  {   
  ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
<title>Usuarios</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>
function createNew() {
	$("#add-more").hide();
	var data = '<tr class="table-row" id="new_row_ajax">' +
	'<td contenteditable="false" id="txt_id" onBlur="addToHiddenField(this,\'id\')" onClick="editRow(this);"></td>' +
	'<td contenteditable="true" id="txt_CustomerKey" onBlur="addToHiddenField(this,\'CustomerKey\')" onClick="editRow(this);"></td>' +
	'<td contenteditable="true" id="txt_CustomerName" onBlur="addToHiddenField(this,\'CustomerName\')" onClick="editRow(this);"></td>' +
	'<td contenteditable="true" id="txt_CustomerNit" onBlur="addToHiddenField(this,\'CustomerNit\')" onClick="editRow(this);"></td>' +
	'<td><input type="hidden" id="id" /><input type="hidden" id="CustomerKey" /><input type="hidden" id="CustomerName" /><input type="hidden" id="CustomerNit" /><span id="confirmAdd"><a onClick="addToDatabase()" class="ajax-action-links">Guardar</a> / <a onclick="cancelAdd();" class="ajax-action-links">Cancelar</a></span></td>' +	
	'</tr>';
  $("#table-body").append(data);
}
function cancelAdd() {
	$("#add-more").show();
	$("#new_row_ajax").remove();
}
function editRow(editableObj) {
  $(editableObj).css("background","#FFF");
}

function saveToDatabase(editableObj,column,id) {
  $(editableObj).css("background","#FFF url(cargando.gif) no-repeat right");
  $.ajax({
    url: "editar_quest.php",
    type: "POST",
    data:'column='+column+'&editval='+$(editableObj).text()+'&id='+id,
    success: function(data){
      $(editableObj).css("background","#FDFDFD");
    }
  });
}
function addToDatabase() {
  var id = $("#id").val();
  var orden = $("#orden").val();
  var concepto = $("#concepto").val();
  var llave_asamblea = $("#llave_asamblea").val();
  
	  $("#confirmAdd").html('<img src="cargando.gif" />');
	  $.ajax({
		url: "agregar_quest.php?llave_asamblea=<?php echo $_GET['llave_asamblea'];?>",
		type: "POST",
		data:'id='+id+'&orden='+orden+'&concepto='+concepto+'&llave_asamblea='+llave_asamblea,
		success: function(data){
		  $("#new_row_ajax").remove();
		  $("#add-more").show();		  
		  $("#table-body").append(data);
		}
	  });
}
function addToHiddenField(addColumn,hiddenField) {
	var columnValue = $(addColumn).text();
	$("#"+hiddenField).val(columnValue);
}

function deleteRecord(id) {
	if(confirm("Esta seguro de eliminar el registro?")) {
		$.ajax({
			url: "borrar_quest.php",
			type: "POST",
			data:'id='+id,
			success: function(data){
			  $("#table-row-"+id).remove();
			}
		});
	}
}
</script>

<style>

.tbl-qa{width: 98%;font-size:0.9em;background-color: #f5f5f5;}
.tbl-qa th.table-header {padding: 5px;text-align: left;padding:10px;}
.tbl-qa .table-row td {padding:10px;background-color: #FDFDFD;}
.ajax-action-links {color: #09F; margin: 10px 0px;cursor:pointer;}
.ajax-action-button {border:#094 1px solid;color: #09F; margin: 10px 0px;cursor:pointer;display: inline-block;padding: 10px 20px;}
</style>
<meta charset="utf-8">
</head>
<body>
<div class="container">
  <div class="row">

			<table class="table table-striped table-hover">
				<thead style="font-size: 9px">
					<tr>
	  					<th class="table-header">#</th>
                		<th class="table-header" width="10%">CustomerKey</th>
                		<th class="table-header" width="85%">CustomerName</th>
	  					<th class="table-header" width="5%">Acciones</th>
					</tr>
  				</thead>
  				<tbody id="table-body">
					<?php
            			$finales=0;
            			$i=1;
            			while($row = sqlsrv_fetch_array($query)){
	  				?>
	  				<tr class="table-row" id="table-row-<?php echo $row["id"]; ?>">
						<td><?php  echo '-'  ?></td>    
						<td><?php echo $row["CustomerKey"]; ?></td>
						<td><?php echo $row["CustomerName"]; ?></td>
    					<td><?php echo $row["CustomerNit"]; ?></td>
						<td align="right"><a class="ajax-action-links" onClick="deleteRecord(<?php echo $row["id"]; ?>);"><i class="glyphicon glyphicon-trash"></i></a></td>
	  				</tr>
	  				<?php
						}
					?>

  </tbody>
</table>
<a href="#addPlanModal" class="btn btn-primary" id="add-more" onClick="createNew();"><i class="material-icons">&#xE147;</i> <span>Agregar nuevo plan</span></a>

        <hr>

        <hr>



<!--inicio footer-->
</div>
</div>
  </div>
</div>


</body>
</html>
<!-- Fin container -->
<script src="assets/jquery-1.12.4-jquery.min.js"></script> 

<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 

<script src="dist/js/bootstrap.min.js"></script>
<?php 
  } 
}
?> 
