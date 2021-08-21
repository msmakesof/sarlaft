<?php
include('../ajax/is_logged.php');
$CustomerKey=$_SESSION['Keyp'];

require_once ("../config/dbx.php");
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

$json = json_encode($_POST['js'],true);
//echo $json;
//echo "<br>";
//echo gettype($json);
$js = json_decode($json, true);
////$js = json_decode($_POST['js'], true);
//echo "<br>";
//echo "tipo......".gettype($js);
//echo "<br>";
//print_r($js);
//echo "<br>";echo "<br>";
$IdEvento = 0;
$consecutivo ="";
$ideventoriesgo ="";
$idproceso = "";
$idcargo ="";
$idresponsable ="";
$mi_probabilidad = "";
$mi_consecuencia = "";
$mc_probabilidad = "";
$mc_consecuencia = "";
$tiporiesgo ="";
$factorriesgo ="";
$riesgoasociado="";
$causa="";
$consecuencia="";
$tratamiento="";
$debilidad="";
$oportunidad="";
$fortaleza="";
$amenaza="";
$updtra1="";
$trastatus = "";
$traprioridad = "";
$trafinicio ="";
$traffinal ="";
$trafseguir ="";
$nro=0;
$mtra=[];
$insert_TRA="";
foreach($js as $key=>$value){
	if(is_array($value)){
		//echo "\n m....".$key . ': ' . '<br>';
		//print_r($value);
		
		foreach($value as $key2=>$value2){
			////echo "\n key2....".$key2 . ': ' . '<br>';
			//echo "filas key2..".count($value2).'<br>';
			
			if($key2 == "CON"){
				////echo "filas key2..".count($value2).'<br>';
				foreach($value2 as $key3=>$value3){
					////echo "\n key3....".$key3 . ': ' .'<br>';
					////echo "filas key3..".count($value3).'<br>';
					
					foreach($value3 as $key4=>$value4){
						////echo "$key4......$value4<br>";						
					}
				}				
			}
			
			foreach($value2 as $key3=>$value3){
				//echo "\n key3....".$key3 . ': ' .'<br>';
				//echo "filas key3..".count($value3).'<br>';
				
				foreach($value3 as $key4=>$value4){
					//echo "\n key4....".$key4 . ': ' . $value4 .'<br>';
					
					// Graba en EVRI_EventoRiesgo
					if($key2=="IDE"){
						$IdEvento = $value4;
					}
					//echo "Nro Evento....$IdEvento<br>";
					if($key2=="ICO"){
						$consecutivo = $value4;
					}
					if($key2=="ERI"){
						$ideventoriesgo = $value4;
					}
					if($key2=="PRO"){
						$idproceso = $value4;
					}
					if($key2=="CAR"){
						$idcargo = $value4;
					}
					if($key2=="RES"){
						$idresponsable = $value4;
					}
					
					//Graba en la Matriz de Riesgo Inherente
					if($key2=="MIP"){
						$mi_probabilidad = $value4;
					}
					if($key2=="MIC"){
						$mi_consecuencia = $value4;
					}
					
					//Graba en la Matriz de Control
					if($key2=="MCP"){
						$mc_probabilidad = $value4;
					}
					if($key2=="MCC"){
						$mc_consecuencia = $value4;
					}
					
					if($key2=="TIR"){
						$tiporiesgo .= "INSERT INTO ETIR_TipoRiesgo (ETIR_IdEventoRiesgo, ETIR_IdTipoRiesgo) VALUES ('?', $value4);" ;
					}
					
					if($key2=="FAR"){
						$factorriesgo .= "INSERT INTO EFAR_FactorRiesgo (EFAR_IdEventoRiesgo, EFAR_IdFactorRiesgo) VALUES ('?', $value4);" ;
					}
					
					if($key2=="RIA"){
						$riesgoasociado .= "INSERT INTO ERIA_RiesgoAsociado (ERIA_IdEventoRiesgo, ERIA_IdRiesgoAsociado) VALUES ('?', $value4);" ;
					}
					
					if($key2=="CAU"){
						$causa .= "INSERT INTO ECAU_Causas (ECAU_IdEventoRiesgo, ECAU_IdCausa) VALUES ('?', $value4);" ;
					}
					
					if($key2=="CON"){
						$consecuencia .= "INSERT INTO ECON_Consecuencias (ECON_IdEventoRiesgo, ECON_IdConsecuencia) VALUES ('?', $value4);" ;
					}
					
					if($key2=="DEB"){
						$debilidad .= "INSERT INTO EDEB_Debilidades (EDEB_IdEventoRiesgo, EDEB_IdDebilidad) VALUES ('?', $value4);" ;
					}
					
					if($key2=="OPO"){
						$oportunidad .= "INSERT INTO EOPO_Oportunidades (EOPO_IdEventoRiesgo, EOPO_IdOportunidad) VALUES ('?', $value4);" ;
					}
					
					if($key2=="FOR"){
						$fortaleza .= "INSERT INTO EFOR_Fortalezas (EFOR_IdEventoRiesgo, EFOR_IdFortaleza) VALUES ('?', $value4);" ;
					}
					
					if($key2=="AME"){
						$amenaza .= "INSERT INTO EAME_Amenazas (EAME_IdEventoRiesgo, EAME_IdAmenaza) VALUES ('?', $value4);" ;
					}
				}
			}
		}		
	}else{
		//echo "\n n....".$key . ': ' . $value . '<br>';
		$grabado="D";
	}
}

// Insertar EVRI_EventoRiesgo
date_default_timezone_set("America/Bogota");
$CustomerKey=$_SESSION['Keyp'];
$EventoKey=time();
$UserKey=$_SESSION['UserKey'];
$DateStamp=date("Y-m-d H:i:s");

//$sql="INSERT INTO EVRI_EventoRiesgo (EVRI_Consecutivo, EVRI_IdEvento, EVRI_IdProceso, EVRI_IdCargo, EVRI_IdResponsable, EVRI_CustomerKey, EVRI_UserKey, EVRI_EventoKey, EVRI_DateStamp) VALUES ('".$consecutivo."',".$ideventoriesgo.",".$idproceso.",".$idcargo.",".$idresponsable.",'".$CustomerKey."','".$UserKey."','".$EventoKey."','".$DateStamp."'); SELECT SCOPE_IDENTITY() as LastId;";
$grabado="N";
$sql="UPDATE EVRI_EventoRiesgo SET EVRI_Consecutivo='".$consecutivo."', EVRI_IdEvento=".$ideventoriesgo.", EVRI_IdProceso=".$idproceso.", EVRI_IdCargo=".$idcargo.", EVRI_IdResponsable=".$idresponsable.", EVRI_CustomerKey='".$CustomerKey."', EVRI_UserKey='".$UserKey."', EVRI_EventoKey='".$EventoKey."', EVRI_DateStamp='".$DateStamp."' WHERE EVRI_Id = ".trim($IdEvento);
//echo "upd.....$sql";
$query = sqlsrv_query($conn,$sql);
$LastId = trim($IdEvento);
////$next_result = sqlsrv_next_result($query);
////$row = sqlsrv_fetch_array($query); 
////$LastId = $row['LastId'];
if($query){
	//echo "OK<br>";
	$grabado="S";
	
	////$sql="INSERT INTO EMRI_MatrizRiesgoInherente (EMRI_IdEventoRiesgo, EMRI_IdProbabilidad, EMRI_IdConsecuencia, EMRI_Posicion ) VALUES($LastId, ////$mi_probabilidad, $mi_consecuencia, '' )";
	////$query = sqlsrv_query($conn,$sql);
	////if($query){
		////echo "OK MRI<br>";
		
		////$sql="INSERT INTO EMRC_MatrizRiesgoControl (EMRC_IdEventoRiesgo, EMRC_IdProbabilidad, EMRC_IdConsecuencia, EMRC_Posicion ) VALUES($LastId, ////$mc_probabilidad, $mc_consecuencia, '' )";
		////$query = sqlsrv_query($conn,$sql);
		////if($query){
			////echo "OK MRC<br>";
			
			$tiporiesgo = str_replace('?', $LastId, $tiporiesgo);
			$sql = $tiporiesgo;
			$query = sqlsrv_query($conn,$sql);
			if($query){
				//echo "OK TIR<br>";
				$grabado="S";
				
				$factorriesgo = str_replace('?', $LastId, $factorriesgo);
				$sql = $factorriesgo;
				$query = sqlsrv_query($conn,$sql);
				if($query){
					//echo "OK FAR<br>";
					$grabado="S";
					
					$riesgoasociado = str_replace('?', $LastId, $riesgoasociado);
					$sql = $riesgoasociado;
					$query = sqlsrv_query($conn,$sql);
					if($query){
						//echo "OK RIA<br>";
						$grabado="S";
						
						$causa = str_replace('?', $LastId, $causa);
						$sql = $causa;
						$query = sqlsrv_query($conn,$sql);
						if($query){
							//echo "OK CAU<br>";
							$grabado="S";
							
							$consecuencia = str_replace('?', $LastId, $consecuencia);
							$sql = $consecuencia;
							$query = sqlsrv_query($conn,$sql);
							if($query){
								//echo "OK CON<br>";
								$grabado="S";
								
								$tratamiento = str_replace('?', $LastId, $tratamiento);
								$sql = $tratamiento;
								$query = sqlsrv_query($conn,$sql);
								if($query){
									//echo "OK TRA<br>";																		
									$grabado="S";
									
									$debilidad = str_replace('?', $LastId, $debilidad);
									$sql = $debilidad;
									$query = sqlsrv_query($conn,$sql);
									if($query){
										//echo "OK DEB<br>";
										$grabado="S";
										
										$oportunidad = str_replace('?', $LastId, $oportunidad);
										$sql = $oportunidad;
										$query = sqlsrv_query($conn,$sql);
										if($query){
											//echo "OK OPO<br>";
											$grabado="S";
											
											$fortaleza = str_replace('?', $LastId, $fortaleza);
											$sql = $fortaleza;
											$query = sqlsrv_query($conn,$sql);
											if($query){
												//echo "OK FOR<br>";
												$grabado="S";
												
												$amenaza = str_replace('?', $LastId, $amenaza);
												$sql = $amenaza;
												$query = sqlsrv_query($conn,$sql);
												if($query){
													//echo "OK AME<br>";
													$grabado="S";													
												}
												else{$grabado="N"; //echo "Fallo AME<br>";
												}												
											}
											else{$grabado="N"; //echo "Fallo FOR<br>";
											}											
										}
										else{$grabado="N"; //echo "Fallo OPO<br>";
										}										
									}
									else{$grabado="N"; //echo "Fallo DEB<br>";
									}									
								}
								else{$grabado="N"; //echo "Fallo TRA<br>";
								}							
							}
							else{$grabado="N"; //echo "Fallo CON<br>";
							}							
						}
						else{$grabado="N"; //echo "Fallo CAU<br>";
						}						
					}
					else{$grabado="N"; //echo "Fallo RIA<br>";
					}					
				}
				else{$grabado="N"; //echo "Fallo FAR<br>";
				}
			}
			else{$grabado="N"; //echo "Fallo TIR<br>";
			}
		/////}	
		////else{echo "Fallo MRC<br>";}
	/////}
	////else {echo "Fallo MRI<br>";}
}
else{
	$grabado="N"; //"Fallo";
}
echo $grabado;
?>