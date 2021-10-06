<?php
//include './ajax/is_logged.php';
$CustomerKey = $_SESSION['Keyp'];
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
<!--
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
 <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script> -->
  
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.1/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.1/summernote.js"></script>
    <div class="container">
        <div class="table-wrapper">
            <?php //include("components/color.php");?>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrar <b>Información Básica</b></h2>                        
                    </div>
                    <div class="col-md-12">
						<div class="form-group row">
							<div style="float:left">
								<?php if( $totregs == 0)  { 
									if( $crear == 1 ) {
								?>
								<input type="submit" class="btn btn-primary" value="Guardar datos" id="grabar">
								<?php }
									} 
									else { 
										if( $modificar == 1 ) {
								?>
								<input type="submit" class="btn btn-success" value="Actualizar datos" id="actualizar">
								<?php } 
									}
								?>
							</div>
							
							 <div style="float:left; margin-left:0.6em">
								<?php if( $exportar == 1 ) { ?>
									<button type="submit" href="" id="xpdf" class="btn btn-success">
										<i class="fa fa-file-pdf-o"></i>
										<span>Exportar</span>
									</button>
								<?php } ?>
							</div>
						</div>					
                       
                        <br>
                        <div class="form-group row"></div>
                        <!-- <div>
                            <a href="#addInfobasicaModal" class="btn btn-primary" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i>
                                <span>Agregar nueva Info Básica</span>
                            </a>
                        </div> -->
                        <form id="add_infobasica" method="post" action="components/infobasica/infopdf.php">
						
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Actividad Económica</label>
                                    <textarea class="summernote" id="ActividadEconomicaName2" name="ActividadEconomicaName2" rows="3" required><?php echo $ActividadEconomica; ?></textarea>
									<input type="hidden" name="edit_id" id="edit_id" value="<?php echo $id; ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Objeto Social</label>
                                    <textarea class="form-control summernote" id="ObjetoSocial" name="ObjetoSocial" rows="3" required>
									<?php echo $ObjetoSocial; ?>
									</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Descripción General</label>
                                    <textarea class="form-control summernote" id="DescripcionGeneral" name="DescripcionGeneral" rows="3" required>
									<?php echo $DescripcionGeneral; ?>
									</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Misión</label>
                                    <textarea class="form-control summernote" id="Mision" name="Mision" rows="3" required>
									<?php echo $Mision; ?>
									</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Visión</label>
                                    <textarea class="form-control summernote" id="Vision" name="Vision" rows="3" required>
									<?php echo $Vision; ?>
									</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Objetivos Estratégicos</label>
                                    <textarea class="form-control summernote" id="ObjetivosEstrategicos" name="ObjetivosEstrategicos" rows="3" required>
									<?php echo $ObjetivosEstrategicos; ?>
									</textarea>
                                </div>
                            </div>
                        </form>
						
						<div class="form-group row">
							<div style="float:left">
								<?php if( $totregs == 0)  { 
									if( $crear == 1 ) {
								?>
								<input type="submit" class="btn btn-primary" value="Guardar datos" id="grabar">
								<?php }
									} 
									else { 
										if( $modificar == 1 ) {
								?>
								<input type="submit" class="btn btn-success" value="Actualizar datos" id="actualizar">
								<?php } 
									}
								?>
							</div>
							
							 <div style="float:left; margin-left:0.6em">
								<?php if( $exportar == 1 ) { ?>
									<a href="" id="xpdf" class="btn btn-success">
										<i class="fa fa-file-pdf-o"></i>
										<span>Exportar</span>
									</a>
								<?php } ?>
							</div>
						</div>
						
						<div class="form-group row">
							<table class="table table-striped">
								<tbody>
									<tr>
										<td>Debilidades</td>
										<td>
											<?php 
												$getUrl = new Database();
												$urlServicios = $getUrl->getUrl();
												if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
												{
													$url = $urlServicios."api/debilidades/lista_eve.php?ck=$CustomerKey";
													$resultado="";
													$ch = curl_init();
													curl_setopt($ch, CURLOPT_VERBOSE, true);
													curl_setopt($ch, CURLOPT_URL, $url);
													curl_setopt($ch, CURLOPT_TIMEOUT, 30);
													curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
													curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
													curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
													curl_setopt($ch, CURLOPT_POST, 0);
													$resultado = curl_exec ($ch);
													curl_close($ch);
													$mestado =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
													$data = json_decode($mestado, true);	
													
													$json_errors = array(
														JSON_ERROR_NONE => 'No se ha producido ningún error',
														JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
														JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
														JSON_ERROR_SYNTAX => 'Error de Sintaxis',
													);
												}
												foreach($data as $key => $row) {}	
												if( $key == "message")
												{
													echo $data["message"];
												}
												else
												{
													for($i=0; $i<count($data['body']); $i++)
													{												
														$id = $data['body'][$i]["id"];
														$nombreDeb = trim($data['body'][$i]["DebilidadesName"]);
														$ck = trim($data['body'][$i]["CustomerKey"]);
														$uk = trim($data['body'][$i]["UserKey"]);														
														echo "
														<ul>
															<li>$nombreDeb</li>
														</ul>";
													}
												}
											?>
										</td>
									</tr>
									<tr>
										<td>Oportunidades</td>
										<td>
										<?php 
												$getUrl = new Database();
												$urlServicios = $getUrl->getUrl();
												if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
												{
													$url = $urlServicios."api/oportunidades/lista_eve.php?ck=$CustomerKey";
													$resultado="";
													$ch = curl_init();
													curl_setopt($ch, CURLOPT_VERBOSE, true);
													curl_setopt($ch, CURLOPT_URL, $url);
													curl_setopt($ch, CURLOPT_TIMEOUT, 30);
													curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
													curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
													curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
													curl_setopt($ch, CURLOPT_POST, 0);
													$resultado = curl_exec ($ch);
													curl_close($ch);
													$mestado =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
													$data = json_decode($mestado, true);	
													
													$json_errors = array(
														JSON_ERROR_NONE => 'No se ha producido ningún error',
														JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
														JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
														JSON_ERROR_SYNTAX => 'Error de Sintaxis',
													);
												}
												foreach($data as $key => $row) {}	
												if( $key == "message")
												{
													echo $data["message"];
												}
												else
												{
													for($i=0; $i<count($data['body']); $i++)
													{												
														$id = $data['body'][$i]["id"];
														$nombreOpo = trim($data['body'][$i]["OportunidadesName"]);
														$ck = trim($data['body'][$i]["CustomerKey"]);
														$uk = trim($data['body'][$i]["UserKey"]);														
														echo "
														<ul>
															<li>$nombreOpo</li>
														</ul>";
													}
												}
											?>
										</td>
									</tr>
									<tr>
										<td>Fortalezas</td>
										<td>
										<?php 
												$getUrl = new Database();
												$urlServicios = $getUrl->getUrl();
												if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
												{
													$url = $urlServicios."api/fortalezas/lista_eve.php?ck=$CustomerKey";
													$resultado="";
													$ch = curl_init();
													curl_setopt($ch, CURLOPT_VERBOSE, true);
													curl_setopt($ch, CURLOPT_URL, $url);
													curl_setopt($ch, CURLOPT_TIMEOUT, 30);
													curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
													curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
													curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
													curl_setopt($ch, CURLOPT_POST, 0);
													$resultado = curl_exec ($ch);
													curl_close($ch);
													$mestado =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
													$data = json_decode($mestado, true);	
													
													$json_errors = array(
														JSON_ERROR_NONE => 'No se ha producido ningún error',
														JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
														JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
														JSON_ERROR_SYNTAX => 'Error de Sintaxis',
													);
												}
												foreach($data as $key => $row) {}	
												if( $key == "message")
												{
													echo $data["message"];
												}
												else
												{
													for($i=0; $i<count($data['body']); $i++)
													{												
														$id = $data['body'][$i]["id"];
														$nombreFor = trim($data['body'][$i]["FortalezasName"]);
														$ck = trim($data['body'][$i]["CustomerKey"]);
														$uk = trim($data['body'][$i]["UserKey"]);														
														echo "
														<ul>
															<li>$nombreFor</li>
														</ul>";
													}
												}
											?>
										</td>
									</tr>
									<tr>
										<td>Amenazas</td>
										<td>
										<?php 
												$getUrl = new Database();
												$urlServicios = $getUrl->getUrl();
												if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
												{
													$url = $urlServicios."api/amenazas/lista_eve.php?ck=$CustomerKey";
													$resultado="";
													$ch = curl_init();
													curl_setopt($ch, CURLOPT_VERBOSE, true);
													curl_setopt($ch, CURLOPT_URL, $url);
													curl_setopt($ch, CURLOPT_TIMEOUT, 30);
													curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
													curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
													curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
													curl_setopt($ch, CURLOPT_POST, 0);
													$resultado = curl_exec ($ch);
													curl_close($ch);
													$mestado =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
													$data = json_decode($mestado, true);	
													
													$json_errors = array(
														JSON_ERROR_NONE => 'No se ha producido ningún error',
														JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
														JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
														JSON_ERROR_SYNTAX => 'Error de Sintaxis',
													);
												}
												foreach($data as $key => $row) {}	
												if( $key == "message")
												{
													echo $data["message"];
												}
												else
												{
													for($i=0; $i<count($data['body']); $i++)
													{												
														$id = $data['body'][$i]["id"];
														$nombreAme = trim($data['body'][$i]["AmenazasName"]);
														$ck = trim($data['body'][$i]["CustomerKey"]);
														$uk = trim($data['body'][$i]["UserKey"]);
														echo "
														<ul>
															<li>$nombreAme</li>
														</ul>";
													}
												}
											?>
										</td>
									</tr>
								</tbody>
							</table>	
						</div>

                    </div>
                </div>
            </div>

            <div class='clearfix'></div>

            <div id="loader"></div><!-- Carga de datos ajax aqui -->
            <div id="resultados"></div><!-- Carga de datos ajax aqui -->
            <div class='outer_div'></div><!-- Carga de datos ajax aqui -->
            
        </div>
    </div>
    <script>	
	$('.summernote').toggle(this.checked)
	$('.summernote').summernote()
	$('#summernote').summernote({
  fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather'],  
});
	var type;
	var txt;
    $("#grabar").on('click',function( event ){
       
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
                    timer: 4000
                });
                setTimeout(function (){
                    location.reload();
                }, 3000)
            }
        })
        event.preventDefault();
	})
	
	$("#xpdf").on('click',function(){
		alert(80);
		$( "#add_infobasica" ).submit();
		
	})
    </script>