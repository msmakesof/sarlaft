<?php 
require_once ("config/dbx.php");
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

$totregs = 0;
$query=sqlsrv_query($conn, "SELECT count(CLI_IdInfoBasica) AS TOTAL FROM CLI_InfoBasica WHERE CLI_CustomerKey='".$_SESSION['Keyp']."'");
$reg=sqlsrv_fetch_array($query); 
$totregs = $reg['TOTAL'];

$id = 0;
$ActividadEconomica = "";
$ObjetoSocial = "";
$DescripcionGeneral = "";
$Mision = "";
$Vision = "";
$ObjetivosEstrategicos = "";
if( $totregs > 0){	
    include 'curl/infobasica/listar1.php';
    foreach($data as $key => $row) {}				
    if( $key == "message")
    {
        echo '<tr>
                <td colspan="5">'. $data["message"] .'</td>
            </tr>';
    }
    else
    {
        if( $data["itemCount"] > 0)
        {
            $j = 1;
            for($i=0; $i<count($data['body']); $i++)
            {
                $id = $data['body'][$i]['CLI_IdInfoBasica'];
                $ActividadEconomica = $data['body'][$i]['CLI_ActividadEconomica'];
                $ObjetoSocial = $data['body'][$i]['CLI_ObjetoSocial'];
                $DescripcionGeneral = $data['body'][$i]['CLI_DescripcionGeneral'];
                $Mision = $data['body'][$i]['CLI_Mision'];
                $Vision = $data['body'][$i]['CLI_Vision'];
                $ObjetivosEstrategicos = $data['body'][$i]['CLI_ObjetivosEstrategicos'];
                $CustomerKey = $data['body'][$i]['CLI_CustomerKey'];
                $USerKey = $data['body'][$i]['CLI_USerKey'];
            }
        }
    }
}
?>
<!-- summernote -->
<link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <style>
        .modal .modal-dialog {
		max-width: 80% !important;
	}

    form label {
		font-weight: bold;
		color: black; text-shadow: grey 0.1em 0.1em 0.2em
	}
    </style> 
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
    <div class="container">
        <div class="table-wrapper">
            <?php //include("components/color.php");?>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrar <b>Información Básica</b></h2>                        
                    </div>
                    <div class="col-md-12">
                        <div>
                            <a href="" id="xpdf" class="btn btn-success">
                                <i class="fa fa-file-pdf-o"></i>
                                <span>Exportar</span>
                            </a>
                        </div>
                        <br>
                        <div class="form-group row"></div>
                        <!-- <div>
                            <a href="#addInfobasicaModal" class="btn btn-primary" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i>
                                <span>Agregar nueva Info Básica</span>
                            </a>
                        </div> -->
                        <form id="add_infobasica">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Actividad Económica</label>
                                    <textarea class="form-control textarea" id="ActividadEconomicaName2" name="ActividadEconomicaName2" rows="3" required><?php echo $ActividadEconomica; ?></textarea>
									<input type="hidden" name="edit_id" id="edit_id" value="<?php echo $id; ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Objeto Social</label>
                                    <textarea class="form-control textarea" id="ObjetoSocial" name="ObjetoSocial" rows="3" required>
									<?php echo $ObjetoSocial; ?>
									</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Descripción General</label>
                                    <textarea class="form-control textarea" id="DescripcionGeneral" name="DescripcionGeneral" rows="3" required>
									<?php echo $DescripcionGeneral; ?>
									</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Misión</label>
                                    <textarea class="form-control textarea" id="Mision" name="Mision" rows="3" required>
									<?php echo $Mision; ?>
									</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Visión</label>
                                    <textarea class="form-control textarea" id="Vision" name="Vision" rows="3" required>
									<?php echo $Vision; ?>
									</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Objetivos Estratégicos</label>
                                    <textarea class="form-control textarea" id="ObjetivosEstrategicos" name="ObjetivosEstrategicos" rows="3" required>
									<?php echo $ObjetivosEstrategicos; ?>
									</textarea>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="form-group row">
                        <?php if( $totregs == 0)  { ?>
                        <input type="submit" class="btn btn-primary" value="Guardar datos" id="grabar">
                        <?php } else { ?>
                        <input type="submit" class="btn btn-success" value="Actualizar datos" id="actualizar">
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class='clearfix'></div>

            <div id="loader"></div><!-- Carga de datos ajax aqui -->
            <div id="resultados"></div><!-- Carga de datos ajax aqui -->
            <div class='outer_div'></div><!-- Carga de datos ajax aqui -->
            
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <?php // include("modal/infobasica/modal_add.php");?>
    <!-- Edit Modal HTML -->
    <?php // include("modal/infobasica/modal_edit.php");?>
    <!-- Delete Modal HTML -->
    <?php // include("modal/infobasica/modal_delete.php");?>
    <!-- <script src="js/infobasica/infobasica.js"></script> -->
    <script>
    $('.textarea').summernote()	
	var ActividadEconomicaName2 =  $("#ActividadEconomicaName2").val();
	var ObjetoSocial = $("#ObjetoSocial").val()
	var DescripcionGeneral = $("#DescripcionGeneral").val();
	var Mision =$("#Mision").val();
	var Vision =$("#Vision").val();
	var type;
	var txt;
    $("#grabar").on('click',function( event ){        
        /* if( ActividadEconomicaName2 == "" || ObjetoSocial == "" || DescripcionGeneral == "" || Mision == "" || Vision == "" ){
            type = "warning";
            if( ActividadEconomicaName2 == "" ){ txt = "Actividad Económica"; }
            if( ObjetoSocial == "" ){ txt = "Objeto Social"; }
            if( DescripcionGeneral == "" ){ txt = "Descripcion General"; }
            if( Mision == "" ){ txt = "Misión"; }
            if( Vision == "" ){ txt = "Visión"; }
            swal({
                position: 'top-end',
                type: ''+type,
                title: ''+txt,
                showConfirmButton: true,
                timer: 5000
            });
        } */
       
        var parametros = $("#add_infobasica").serializeArray();
        $.ajax({
            type: "POST",
            url: "ajax/infobasica/guardar.php",
            data: parametros,
            beforeSend: function(objeto){
                $("#resultados").html("Enviando...");
            },
            success: function(datos){
                let m= datos.trim();
                $("#resultados").html(datos);
                let msj = m.substr(0,1);
                let type;
                let txt;
                if(msj == 'O'){
                    type = 'success';
                    txt = 'Información Básica ha sido guardada con éxito.';
                }
                else if(msj == 'E'){
                    type= 'warning';
                    txt = 'Ya existe un Registro grabado con el mismo Nombre.';
                }
                else if(msj == 'F'){
                    type= 'error';
                    txt = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.';
                }
                else if(msj == 'D'){
                    type= 'error';
                    txt ='Error Desconocido.';
                }
                else{
                    type= 'error';
                    txt = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.';
                }
                swal({
                    position: 'top-end',
                    type: ''+type,
                    title: ''+txt,
                    showConfirmButton: true,
                    timer: 5000
                });
                setTimeout(function (){
                    location.reload();
                }, 3000)
            }
        })
        event.preventDefault();
    })
	
	$("#actualizar").on('click',function( event ){
        var parametros = $("#add_infobasica").serializeArray();
        $.ajax({
            type: "POST",
            url: "ajax/infobasica/editar.php",
            data: parametros,
            beforeSend: function(objeto){
                $("#resultados").html("Enviando...");
            },
            success: function(datos){
                let m= datos.trim();
                $("#resultados").html(datos);
                let msj = m.substr(0,1);
                let type;
                let txt;
                if(msj == 'U'){
                    type = 'success';
                    txt = 'Información Básica ha sido actualizada con éxito.';
                }
                else if(msj == 'E'){
                    type= 'warning';
                    txt = 'Ya existe un Registro grabado con el mismo Nombre.';
                }
                else if(msj == 'F'){
                    type= 'error';
                    txt = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.';
                }
                else if(msj == 'D'){
                    type= 'error';
                    txt ='Error Desconocido.';
                }
                else{
                    type= 'error';
                    txt = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.';
                }
                swal({
                    position: 'top-end',
                    type: ''+type,
                    title: ''+txt,
                    showConfirmButton: true,
                    timer: 5000
                });
                setTimeout(function (){
                    location.reload();
                }, 3000)
            }
        })
        event.preventDefault();
    })
    </script>