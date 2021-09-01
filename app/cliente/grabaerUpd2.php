<?php
include('../ajax/is_logged.php');
$CustomerKey=$_SESSION['Keyp'];

require_once ("../config/dbx.php");
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

$IdEvento = $_POST['er'];
//echo "ER::::::::......$IdEvento";

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
//$IdEvento = 0;
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
$grabado="N";

// Guardamos en variables los valores de cada lista antes de borrarlos, esto para recuperar la infor en caso que el 
// borrado falle.
// Para Tipo Riesgo
$arrayTR = array(); 
//$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
$query = sqlsrv_query($conn,"SELECT ETIR_Id, ETIR_IdTipoRiesgo FROM ETIR_TipoRiesgo WHERE ETIR_IdEventoRiesgo=".$IdEvento);
{
    if ( $query === false)
    {
        $grabado="D";
        die(print_r(sqlsrv_errors(), true));
    }						
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
        $id=$row['ETIR_Id'];
        $IdTipoRiesgo=trim($row['ETIR_IdTipoRiesgo']);
        array_push($arrayTR, $IdTipoRiesgo );
    }
}

// Para Factor Riesgo
$arrayFR = array(); 
//$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
$query = sqlsrv_query($conn,"SELECT EFAR_Id, EFAR_IdFactorRiesgo FROM EFAR_FactorRiesgo WHERE EFAR_IdEventoRiesgo=".$IdEvento);
{
    if ( $query === false)
    {
        $grabado="D";
        die(print_r(sqlsrv_errors(), true));
    }						
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
        $id=$row['EFAR_Id'];
        $IdFactorRiesgo=trim($row['EFAR_IdFactorRiesgo']);
        array_push($arrayFR, $IdFactorRiesgo );
    }
}

// Para Riesgo Asociado
$arrayRA = array(); 
//$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
$query = sqlsrv_query($conn,"SELECT ERIA_Id, ERIA_IdRiesgoAsociado FROM ERIA_RiesgoAsociado WHERE ERIA_IdEventoRiesgo=".$IdEvento);
{
    if ( $query === false)
    {
        $grabado="D";
        die(print_r(sqlsrv_errors(), true));
    }						
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
        $id=$row['ERIA_Id'];
        $IdRiesgoAsociado=trim($row['ERIA_IdRiesgoAsociado']);
        array_push($arrayRA, $IdRiesgoAsociado );
    }
}

// Para Causas
$arrayCA = array(); 
//$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
$query = sqlsrv_query($conn,"SELECT ECAU_Id, ECAU_IdCausa FROM ECAU_Causas WHERE ECAU_IdEventoRiesgo=".$IdEvento);
{
    if ( $query === false)
    {
        $grabado="D";
        die(print_r(sqlsrv_errors(), true));
    }						
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
        $id=$row['ECAU_Id'];
        $IdCausa=trim($row['ECAU_IdCausa']);
        array_push($arrayCA, $IdCausa );
    }
}

// Para Consecuencias
$arrayCO = array(); 
//$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
$query = sqlsrv_query($conn,"SELECT ECON_Id, ECON_IdConsecuencia FROM ECON_Consecuencias WHERE ECON_IdEventoRiesgo=".$IdEvento);
{
    if ( $query === false)
    {
        $grabado="D";
        die(print_r(sqlsrv_errors(), true));
    }						
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
        $id=$row['ECON_Id'];
        $IdConsecuencia=trim($row['ECON_IdConsecuencia']);
        array_push($arrayCO, $IdConsecuencia );
    }
}

// Para Debilidades
$arrayDE = array(); 
//$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
$query = sqlsrv_query($conn,"SELECT EDEB_Id, EDEB_IdDebilidad FROM EDEB_Debilidades WHERE EDEB_IdEventoRiesgo=".$IdEvento);
{
    if ( $query === false)
    {
        $grabado="D";
        die(print_r(sqlsrv_errors(), true));
    }						
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
        $id=$row['EDEB_Id'];
        $IdDebilidad=trim($row['EDEB_IdDebilidad']);
        array_push($arrayDE, $IdDebilidad );
    }
}

// Para Oportunidades
$arrayOP = array(); 
//$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
$query = sqlsrv_query($conn,"SELECT EOPO_Id, EOPO_IdOportunidad FROM EOPO_Oportunidades WHERE EOPO_IdEventoRiesgo=".$IdEvento);
{
    if ( $query === false)
    {
        $grabado="D";
        die(print_r(sqlsrv_errors(), true));
    }						
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
        $id=$row['EOPO_Id'];
        $IdOportunidad=trim($row['EOPO_IdOportunidad']);
        array_push($arrayOP, $IdOportunidad );
    }
}

// Para Fortalezas
$arrayFO = array(); 
//$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
$query = sqlsrv_query($conn,"SELECT EFOR_Id, EFOR_IdFortaleza FROM EFOR_Fortalezas WHERE EFOR_IdEventoRiesgo=".$IdEvento);
{
    if ( $query === false)
    {
        $grabado="D";
        die(print_r(sqlsrv_errors(), true));
    }						
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
        $id=$row['EFOR_Id'];
        $IdFortaleza=trim($row['EFOR_IdFortaleza']);
        array_push($arrayFO, $IdFortaleza );
    }
}

// Para Amenazas
$arrayAM = array(); 
//$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
$query = sqlsrv_query($conn,"SELECT EAME_Id, EAME_IdAmenaza FROM EAME_Amenazas WHERE EAME_IdEventoRiesgo=".$IdEvento);
{
    if ( $query === false)
    {
        $grabado="D";
        die(print_r(sqlsrv_errors(), true));
    }						
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
        $id=$row['EAME_Id'];
        $IdAmenaza=trim($row['EAME_IdAmenaza']);
        array_push($arrayAM, $IdAmenaza );
    }
}

if( $grabado != "D" ){
    //borramos los items de cada lista
    $queryDel  ="";
    $queryDel .="DELETE FROM ETIR_TipoRiesgo WHERE ETIR_IdEventoRiesgo =$IdEvento; \n";
    $queryDel .="DELETE FROM EFAR_FactorRiesgo WHERE EFAR_IdEventoRiesgo =$IdEvento; \n";
    $queryDel .="DELETE FROM ERIA_RiesgoAsociado WHERE ERIA_IdEventoRiesgo =$IdEvento; \n";
    $queryDel .="DELETE FROM ECAU_Causas WHERE ECAU_IdEventoRiesgo =$IdEvento; \n";
    $queryDel .="DELETE FROM ECON_Consecuencias WHERE ECON_IdEventoRiesgo =$IdEvento; \n";
    $queryDel .="DELETE FROM EDEB_Debilidades WHERE EDEB_IdEventoRiesgo =$IdEvento; \n";
    $queryDel .="DELETE FROM EOPO_Oportunidades WHERE EOPO_IdEventoRiesgo =$IdEvento; \n";
    $queryDel .="DELETE FROM EFOR_Fortalezas WHERE EFOR_IdEventoRiesgo =$IdEvento; \n";
    $queryDel .="DELETE FROM EAME_Amenazas WHERE EAME_IdEventoRiesgo =$IdEvento; \n";
    $query = sqlsrv_query($conn,$queryDel);
    if($query){

        //print_r ($js);
        foreach ($js as $key0=>$value0) {    
            ////echo "key....$key<br>";
            //echo "value....$value<br>";
            foreach ($value0 as $mkey1=>$mvalue1) {
                ///echo "mkey1....$mkey1<br>";
                if( $mkey1 == "IDE"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $IdEvento = $mvalue3;
                        }
                    }
                } // fin del if
            }
        } // Fin foreach ppal

    }
    else{
        $grabado="N";
                // Para volver a recuperar la infor en caso de presentarse un error
                foreach ($arrayTR as &$valor) {    
                    $valor = trim($valor);
                    //echo $valor."\n";
                    $tiporiesgo = "";
                    // Buscamos No si existe el id para insertarlo
                    $query=sqlsrv_query($conn,"SELECT count(ETIR_IdTipoRiesgo) AS Tot FROM ETIR_TipoRiesgo WHERE ETIR_IdEventoRiesgo=".$IdEvento." AND ETIR_IdTipoRiesgo=".$valor);
                    $reg=sqlsrv_fetch_array($query);
                    if( $reg['Tot'] == 0 ){
                        // insert record
                        $tiporiesgo = "INSERT INTO ETIR_TipoRiesgo (ETIR_IdEventoRiesgo, ETIR_IdTipoRiesgo) VALUES (".$IdEvento.",".$valor.");" ;
                        //echo $tiporiesgo."\n";
                        $query = sqlsrv_query($conn,$tiporiesgo);
                    }    
                }
                // Para volver a recuperar la infor en caso de presentarse un error
                foreach ($arrayFR as &$valor) {    
                    $valor = trim($valor);
                    //echo $valor."\n";
                    $factoriesgo = "";
                    // Buscamos No si existe el id para insertarlo
                    $query=sqlsrv_query($conn,"SELECT count(EFAR_IdFactorRiesgo) AS Tot FROM EFAR_FactorRiesgo WHERE EFAR_IdEventoRiesgo=".$IdEvento." AND EFAR_IdFactorRiesgo=".$valor);
                    $reg=sqlsrv_fetch_array($query);
                    if( $reg['Tot'] == 0 ){
                        // insert record
                        $factoriesgo = "INSERT INTO EFAR_FactorRiesgo (EFAR_IdEventoRiesgo, EFAR_IdFactorRiesgo) VALUES (".$IdEvento.",".$valor.");" ;
                        echo $factoriesgo."\n";
                        //$query = sqlsrv_query($conn,$factoriesgo);
                    }    
                }
                // Para volver a recuperar la infor en caso de presentarse un error
                foreach ($arrayRA as &$valor) {    
                    $valor = trim($valor);
                    //echo $valor."\n";
                    $riesgoasociado = "";
                    // Buscamos No si existe el id para insertarlo
                    $query=sqlsrv_query($conn,"SELECT count(ERIA_IdRiesgoAsociado) AS Tot FROM ERIA_RiesgoAsociado WHERE ERIA_IdEventoRiesgo=".$IdEvento." AND ERIA_IdRiesgoAsociado=".$valor);
                    $reg=sqlsrv_fetch_array($query);
                    if( $reg['Tot'] == 0 ){
                        // insert record
                        $riesgoasociado = "INSERT INTO ERIA_RiesgoAsociado (ERIA_IdEventoRiesgo, ERIA_IdRiesgoAsociado) VALUES (".$IdEvento.",".$valor.");" ;
                        echo $riesgoasociado."\n";
                        //$query = sqlsrv_query($conn,$riesgoasociado);
                    }    
                }
                // Para volver a recuperar la infor en caso de presentarse un error
                foreach ($arrayCA as &$valor) {    
                    $valor = trim($valor);
                    //echo $valor."\n";
                    $causas = "";
                    // Buscamos No si existe el id para insertarlo
                    $query=sqlsrv_query($conn,"SELECT count(ECAU_IdCausa) AS Tot FROM ECAU_Causas WHERE ECAU_IdEventoRiesgo=".$IdEvento." AND ECAU_IdCausa=".$valor);
                    $reg=sqlsrv_fetch_array($query);
                    if( $reg['Tot'] == 0 ){
                        // insert record
                        $causas = "INSERT INTO ECAU_Causas (ECAU_IdEventoRiesgo, ECAU_IdCausa) VALUES (".$IdEvento.",".$valor.");" ;
                        echo $causas."\n";
                        //$query = sqlsrv_query($conn,$causas);
                    }    
                }
                // Para volver a recuperar la infor en caso de presentarse un error
                foreach ($arrayCO as &$valor) {    
                    $valor = trim($valor);
                    //echo $valor."\n";
                    $consecuencias = "";
                    // Buscamos No si existe el id para insertarlo
                    $query=sqlsrv_query($conn,"SELECT count(ECON_IdConsecuencia) AS Tot FROM ECON_Consecuencias WHERE ECON_IdEventoRiesgo=".$IdEvento." AND ECON_IdConsecuencia=".$valor);
                    $reg=sqlsrv_fetch_array($query);
                    if( $reg['Tot'] == 0 ){
                        // insert record
                        $consecuencias = "INSERT INTO ECON_Consecuencias (ECON_IdEventoRiesgo, ECON_IdConsecuencia) VALUES (".$IdEvento.",".$valor.");" ;
                        echo $consecuencias."\n";
                        //$query = sqlsrv_query($conn,$consecuencias);
                    }    
                }
                // Para volver a recuperar la infor en caso de presentarse un error
                foreach ($arrayDE as &$valor) {    
                    $valor = trim($valor);
                    //echo $valor."\n";
                    $debilidades = "";
                    // Buscamos No si existe el id para insertarlo
                    $query=sqlsrv_query($conn,"SELECT count(EDEB_IdDebilidad) AS Tot FROM EDEB_Debilidades WHERE EDEB_IdEventoRiesgo=".$IdEvento." AND EDEB_IdDebilidad=".$valor);
                    $reg=sqlsrv_fetch_array($query);
                    if( $reg['Tot'] == 0 ){
                        // insert record
                        $debilidades = "INSERT INTO EDEB_Debilidades (EDEB_IdEventoRiesgo, EDEB_IdDebilidad) VALUES (".$IdEvento.",".$valor.");" ;
                        echo $debilidades."\n";
                        //$query = sqlsrv_query($conn,$debilidades);
                    }    
                }
                // Para volver a recuperar la infor en caso de presentarse un error
                foreach ($arrayOP as &$valor) {    
                    $valor = trim($valor);
                    //echo $valor."\n";
                    $oportunidades = "";
                    // Buscamos No si existe el id para insertarlo
                    $query=sqlsrv_query($conn,"SELECT count(EOPO_IdOportunidad) AS Tot FROM EOPO_Oportunidades WHERE EOPO_IdEventoRiesgo=".$IdEvento." AND EOPO_IdOportunidad=".$valor);
                    $reg=sqlsrv_fetch_array($query);
                    if( $reg['Tot'] == 0 ){
                        // insert record
                        $oportunidades = "INSERT INTO EOPO_Oportunidades (EOPO_IdEventoRiesgo, EOPO_IdOportunidad) VALUES (".$IdEvento.",".$valor.");" ;
                        echo $oportunidades."\n";
                        //$query = sqlsrv_query($conn,$oportunidades);
                    }    
                }
        
                // Para volver a recuperar la infor en caso de presentarse un error
                foreach ($arrayFO as &$valor) {
                    $valor = trim($valor);
                    //echo $valor."\n";
                    $fortalezas = "";
                    // Buscamos No si existe el id para insertarlo
                    $query=sqlsrv_query($conn,"SELECT count(EFOR_IdFortaleza) AS Tot FROM EFOR_Fortalezas WHERE EFOR_IdEventoRiesgo=".$IdEvento." AND EFOR_IdFortaleza=".$valor);
                    $reg=sqlsrv_fetch_array($query);
                    if( $reg['Tot'] == 0 ){
                        // insert record
                        $fortalezas = "INSERT INTO EFOR_Fortalezas (EFOR_IdEventoRiesgo, EFOR_IdFortaleza) VALUES (".$IdEvento.",".$valor.");" ;
                        echo $fortalezas."\n";
                        //$query = sqlsrv_query($conn,$fortalezas);
                    }    
                }
        
                // Para volver a recuperar la infor en caso de presentarse un error
                foreach ($arrayAM as &$valor) {    
                    $valor = trim($valor);
                    //echo $valor."\n";
                    $amenazas = "";
                    // Buscamos No si existe el id para insertarlo
                    $query=sqlsrv_query($conn,"SELECT count(EAME_IdAmenaza) AS Tot FROM EAME_Amenazas WHERE EAME_IdEventoRiesgo=".$IdEvento." AND EAME_IdAmenaza=".$valor);
                    $reg=sqlsrv_fetch_array($query);
                    if( $reg['Tot'] == 0 ){
                        // insert record
                        $amenazas = "INSERT INTO EAME_Amenazas (EAME_IdEventoRiesgo, EAME_IdAmenaza) VALUES (".$IdEvento.",".$valor.");" ;
                        echo $amenazas."\n";
                        //$query = sqlsrv_query($conn,$amenazas);
                    }    
                }
    }    
}
////    echo "IdEvento.....".$IdEvento;


/*
//$tiporiesgo .="DELETE FROM ETIR_TipoRiesgo WHERE ETIR_IdEventoRiesgo =$IdEvento; ";
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
						//
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
*/
?>