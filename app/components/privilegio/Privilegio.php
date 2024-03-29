<?php 
//include('ajax/is_logged.php');	
/* Connect To Database*/
require_once 'config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if (isset($_POST['id']) && $_POST['id'] != "") 
{
  include('curl/rol/idrol.php'); 
  $NombreRol = $datarol['RolNombre'];
  $iduser =$_SESSION['UserKey'];
}
else{
?> 
<script> 
  location.href = 'Roles.php';	
</script>
<?php
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sarlaft Privilegios por Rol</title>
    <!-- Font Awesome -->
	  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Google Font: Source Sans Pro -->
	  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">	
    <!-- Tempusdominus Bbootstrap 4 -->
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">    
</head>
<body>
<section class="content">		
	 <!-- Content Header (Page header) -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12">
					<h3>
					  <i class="nav-icon fas fa-id-card" style="color:red"></i>&nbsp;
					  Crear Privilegios para Rol: <?php echo $NombreRol; ?>
					</h3> 
				</div>				
			</div>
		</div><!-- /.container-fluid -->
	</section>
    <form id="formqry">
      <div class="card-body">              
          <!-- Cargo los Menus -->
          <?php
          include('curl/privilegio/listaraccion.php');
          include('curl/privilegio/listarmenu.php');            
          
          foreach($data as $key => $row) {}
          echo '<table id="example" class="table table-bordered table-striped table-sm" style="width:100%;"><tbody>';
          if( $key == "message")
          {
            echo '<tr>
                <td colspan="5">'. $data["message"] .'</td>
              </tr>
              </tbody>
            </table>';
          }
          else
          {
            echo '
              <table id="example1" class="table table-bordered table-striped table-sm" style="width:100%;">
                <thead>
                  <tr>
                    <th rowspan="2" style="text-align:center">Nombre Menu</th>
                    <th colspan="4" style="text-align:center">
                      <div style="float:left; width:45%; margin-left:20px">Acción</div>
                      <div style="float:left; width:45%; margin-left:20px"><input type="checkbox" id="selectall"> Marcar Todos</div>
                    </th>
                  </tr>
                  <tr>';
                  $query_acc=sqlsrv_query($conn,"SELECT ACC_IdAccion, ACC_Nombre FROM Action WHERE ACC_IdEstado = 1 ORDER BY ACC_Nombre");
                  if( $query_acc === false) {
                    die( print_r( sqlsrv_errors(), true) );
                  }
                  while($row = sqlsrv_fetch_array( $query_acc, SQLSRV_FETCH_ASSOC ) ){
                    $ACC_Nombre = trim($row['ACC_Nombre']);
                    echo  '<th style="text-align:center">'.$ACC_Nombre.'</th>';
                  }
                echo '</tr>
                </thead>
              ';
            
              if( $data["itemCount"] > 0)
              {
                for($i=0; $i<count($data['body']); $i++)
                {
                  $id = $data['body'][$i]['OPC_Id'];
                  $NombreMenu = trim($data['body'][$i]['OPC_Nombre']);
                  $StatusMenu = $data['body'][$i]['OPC_IdEstado'];

                  echo "<tr>";
                  echo "<td>$NombreMenu</td>";
                  if( $dataAccion["itemCount"] > 0)
                  {
                    for($j=0; $j<count($dataAccion['body']); $j++)
                    {
                      $idAccion = $dataAccion['body'][$j]['ACC_IdAccion'];
                      $NombreAccion = trim($dataAccion['body'][$j]['ACC_Nombre']);
                      $StatusAccion = $dataAccion['body'][$j]['ACC_IdEstado'];
                        
                        echo '<td style="text-align:center">
                          <input type="checkbox" class="form-check-input" value="'.$id.'A'.$idAccion.'" name="chk[]">
                        </td>';
                    }
                  }
                  echo "</tr>";
                }
              }
            echo '</table>';
          }
          ?>  
              
            <div>
              <button type="button" id="grabar" class="btn btn-primary">Grabar</button>
              <button type="button" id="salir" class="btn btn-danger">Salir</button>
            </div>
      </div>
    </form>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
$( document ).ready(function() {

  $('#grabar').click(function(e) {
    var selected = [];
    $(":checkbox[name='chk[]']").each(function() {
      if (this.checked) {
        // agregar cada elemento.
        selected.push($(this).val());
      }
    });
    e.preventDefault()
    if (selected.length) {	  
		$.post("ajax/privilegio/guarda.php", {'id': <?php echo $_POST['id']; ?>, 'iduser': <?php echo  $iduser; ?>, 'ids': JSON.stringify($('[name="chk[]"]').serializeArray())}, function(result){			
			let tipo = ""
			let titulo = ""
			if( result.substr(1, 1) == "S")
			{
				tipo = "success"
				titulo = "El(los) Privilegio(s) han sido grabados al Rol."
			}
			else
			{
				tipo = "warning"
				titulo = "Registro no fue Actualizado"
			}
			 swal({
				position: 'top-end',
				type: ''+tipo,
				title: ''+titulo,
				showConfirmButton: true,
				timer: 3000
			});
		});
    }
    else{
      swal({
						position: 'top-end',
						type: 'warning',
						title: 'Debe seleccionar al menos una opción',
						showConfirmButton: true,
						timer: 5000
					});
    }
  }); 

  $("#selectall").on("click", function() {  
    $(".form-check-input").prop("checked", this.checked);  
  });

  // if all checkbox are selected, check the selectall checkbox and viceversa  
  $(".form-check-input").on("click", function() {  
    if ($(".form-check-input").length == $(".form-check-input:checked").length) {  
      $("#selectall").prop("checked", true);  
    } else {  
      $("#selectall").prop("checked", false);  
    }  
  });  

  $("#salir").on('click', function(event){
		location.href = 'Roles.php';	
	});	
});
</script>
</body>
</html>