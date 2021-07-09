<?php 
//include('ajax/is_logged.php');	
/* Connect To Database*/
require_once 'config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if (isset($_POST['id']) && $_POST['id'] != "") 
{
  //echo "<br>id...".$_POST['id']."<br>"; echo "<br>ck...".$_POST['ck']."<br>";
  include('curl/plan/idplan.php'); 
  $NombrePlan = strtoupper($datarol['PlanesName']);
  $iduser =$_SESSION['UserKey'];
}
else{
?> 
<script> 
  location.href = 'Planes.php';	
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
    <title>Sarlaft Tareas por Plan</title>
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

<!--
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
-->

<!-- Bootstrap core JavaScript-->


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
              Tareas del Plan: <?php echo $NombrePlan; ?>
            </h3> 
          </div>				
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <form id="formqry">
		<div class="xloader"></div>
      <div class="card-body"> 
      <?php include('components/table.php'); ?>
            <tr>
              <th style="text-align:center;">Nombre Tarea</th>
              <th style="text-align:center;">Acciones</th>
            </tr>
          </thead>
          <tbody>
          <!-- Cargo Tareas -->
          <?php         
          include('curl/plan/listartareas.php');
          foreach($data as $key => $row) {}
          if( $key == "message")
          {
            echo '<tr>
                <td colspan="2">'. $data["message"] .'</td>
              </tr>
              </tbody>
            </table>';
          }
          else{
            for($i=0; $i<count($data['body']); $i++)
            {
              $id = $data['body'][$i]['TPP_IdTareaxPlan'];
              $IdPlan = trim($data['body'][$i]['TPP_IdPlan']);
              $NombreTarea = $data['body'][$i]['TPP_NombreTarea'];
          ?>
          <tr>
              <td><?php echo trim($NombreTarea); ?></td>
              <td>
                <a href="#deletePlanModal" class="delete" data-toggle="modal" data-id="<?php echo $IdPlan;?>">
                  <i class="material-icons" data-toggle="tooltip" title="Eliminar Tarea">&#xE872;</i>
                </a>
              </td>
          </tr>
          <?php
            }
          }
          ?>              
            <div>
              <button type="button" id="grabar" class="btn btn-primary">Grabar</button>
              <button type="button" id="salir" class="btn btn-danger">Salir</button>
            </div>
      </div>
    </form>
</section>
<script>
<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
$( document ).ready(function() {
	$(".loader").fadeOut("slow");
  alert(7);
	
  /*
  $('#grabar').click(function() {		
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
					titulo = "Tarea grabada al Plan correctamente."
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
	}); */

 
  $("#salir").on('click', function(event){
    alert(7);
		location.href = 'Planes.php';	
	});	
});

/*
function xver(par1) {
	var total = par1
	alert("Tot..."+total);
    //if (selected.length > 0) {
	if ( total > 0) {		
		$.post("ajax/plan/guarda.php", {'id': <?php echo $_POST['id']; ?>, 'iduser': <?php echo  $iduser; ?>, 'ids': JSON.stringify($('[name="chk[]"]').serializeArray())}, function(result){						
			let tipo = ""
			let titulo = ""
			let rta  = result			
			alert(rta.length);
				//$(".loader").fadeOut("slow");
			
				if( rta.substr(1, 1) == "S")
				{
					tipo = "success"
					titulo = "Tarea han sido grabados al Plan."
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
} */
</script>
</body>
</html>