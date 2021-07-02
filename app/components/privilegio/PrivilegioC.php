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
	<style>
	.loader {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url('img/ajax-loader.gif') 50% 50% no-repeat rgb(249,249,249);
		opacity: .8;
	}
	</style>
</head>
<body>
<section class="content">
	  <!-- Content Header (Page header) -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12">
					<h3>
						<i class="nav-icon fas fa-id-card" style="color:blue"></i>&nbsp;
						Consulta Privilegios para Rol: <?php echo $NombreRol; ?>
					</h3> 
				</div>				
			</div>
		</div><!-- /.container-fluid -->
	</section>
    <form id="formqry">
		<div class="loader"></div>
      <div class="card-body">              
          <!-- Cargo los Menus -->
          <?php
          include('curl/privilegio/listaraccion.php');
          include('curl/privilegio/listarmenu.php');
          include('curl/privilegio/privilegiosxrol.php');
          
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
              <table id="example1" class="table table-bordered table-striped table-sm" style="width:100%; padding:0px 10%">
                <thead>
                  <tr>
                    <th rowspan="2" style="text-align:center">Nombre Menu</th>
                    <th colspan="4" style="text-align:center">
                      <div style="float:left; width:45%; margin-left:20px">Acción</div>
                      <div style="float:left; width:45%; margin-left:20px"><input type="checkbox" id="selectall"> Marcar Todos</div>
                    </th>
                  </tr>
                  <tr>
                    <th style="text-align:center">Consultar</th>
                    <th style="text-align:center">Crear</th>
                    <th style="text-align:center">Eliminar</th>
                    <th style="text-align:center">Modificar</th>
                  </tr>
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
                      
                      $checked = "";
                      foreach($dataprixrol as $key => $row) {}
                      if( $key == "message")
                      {
                        //echo '<td colspan="5">'. $dataprixrol["message"] .'</td>';
                      }
                      else{

                        for($k=0; $k<count($dataprixrol['body']); $k++)
                        {
                          $IdPermisoxRol = $dataprixrol['body'][$k]['PER_IdPermisoxRol'];
                          $PER_IdRol = $dataprixrol['body'][$k]['PER_IdRol'];
                          $PER_IdMenu = $dataprixrol['body'][$k]['PER_IdMenu'];
                          $PER_IdAccion = $dataprixrol['body'][$k]['PER_IdAccion'];
                          
                          //echo "xxx....".$PER_IdMenu.'A'.$PER_IdAccion;
                          if ($PER_IdMenu == $id && $PER_IdAccion == $idAccion)
                          {
                            $checked = "checked";
                          }
                        }
                      }
                      echo '<td style="text-align:center">
                      <input type="checkbox" class="form-check-input" value="'.$id.'A'.$idAccion.'" name="chk[]" '.$checked.'>
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
	$(".loader").fadeOut("slow");
	
  	$('#grabar').click(function() {
		var selected = [];
		$(":checkbox[name='chk[]']").each(function() {
		  if (this.checked) {
			// agregar cada elemento.
			selected.push($(this).val());
		  }
		});		
		
		var parametros = {'id': <?php echo $_POST['id']; ?>, 'iduser': <?php echo  $iduser; ?>, 'ids': JSON.stringify($('[name="chk[]"]').serializeArray())};		
		$.ajax({
			type: "POST",
			url: "ajax/privilegio/guarda.php", 
			data: parametros,
			beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				var str2 = datos.replace(/\n|\r/g, "");
				//alert("str2....."+str2);				
				if( str2 == "S")
				{
					tipo = "success"
					titulo = "Privilegio grabado al Rol correctamente."
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
					timer: 2000
				})
			}
		})
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

function xver(par1) {
	var total = par1
	alert("Tot..."+total);
    //if (selected.length > 0) {
	if ( total > 0) {		
		$.post("ajax/privilegio/guarda.php", {'id': <?php echo $_POST['id']; ?>, 'iduser': <?php echo  $iduser; ?>, 'ids': JSON.stringify($('[name="chk[]"]').serializeArray())}, function(result){						
			let tipo = ""
			let titulo = ""
			let rta  = result			
			alert(rta.length);
				//$(".loader").fadeOut("slow");
			
				if( rta.substr(1, 1) == "S")
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
					//timer: 5000
				})
			
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
}
</script>
</body>
</html>