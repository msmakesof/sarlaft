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
              Tareas del Plan: <?php echo $NombrePlan; ?>
            </h3> 
          </div>				
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <form id="formqry">
		<div class="loader"></div>
      <div class="card-body"> 
        <?php //include('components/table.php'); ?>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th style="text-align:center; width:80%">Nombre Tarea</th>
                <th style="text-align:center; width:20%">Acciones</th>
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
            </tbody>
          </table>
        </div>
        <div style="margin-top:3%">
          <button type="button" id="grabar" class="btn btn-primary">Crear</button>
          <button type="button" id="salir" class="btn btn-danger">Salir</button>
        </div>
      </div>
    </form>
</section>


<script>
//$.noConflict();
$( document ).ready(function() {	
	$(".loader").fadeOut("slow");

	var idioma= {
		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "NingÃºn dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_.  Total de _TOTAL_ registros",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Ãšltimo",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		},
		"buttons": {
			"copyTitle": 'Informacion copiada',
			"copyKeys": 'Use your keyboard or menu to select the copy command',
			"copySuccess": {
				"_": '%d filas copiadas al portapapeles',
				"1": '1 fila copiada al portapapeles'
			},

			"pageLength": {
			"_": "Mostrar %d filas",
			"-1": "Mostrar Todo"
			}
		}
	};

	$('#dataTable').DataTable({
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": true,
		"lengthMenu": [ [5, 10, 25, 50, -1], [5, 10,25, 50, "Mostrar Todo"] ],
		"language": idioma
	});

  	alert(7);
  	$("#salir").on('click', function(event){
		location.href = 'Planes.php';	
	})
  		
})
</script>
</body>
</html>