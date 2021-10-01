<?php
include('../ajax/is_logged.php');
$CustomerKey=$_SESSION['Keyp'];

require_once ("../config/dbx.php");
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

$IdEvento = trim($_POST['er']);
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
//$consecutivo ="";
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
$segclientes="";
$segproductos="";
$segcanales="";
$segjurisdiccion="";
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
$insert="";
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

// Para Segmento Cliente
$arraySC = array(); 
//$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
$query = sqlsrv_query($conn,"SELECT ESCL_Id, ESCL_IdSegmentoCliente FROM ESCL_SegmentoClientes WHERE ESCL_IdEventoRiesgo=".$IdEvento);
{
    if ( $query === false)
    {
        $grabado="D";
        die(print_r(sqlsrv_errors(), true));
    }						
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
        $id=$row['ESCL_Id'];
        $IdSegmentoCliente=trim($row['ESCL_IdSegmentoCliente']);
        array_push($arraySC, $IdSegmentoCliente );
    }
}

// Para Segmento Producto
$arraySP = array(); 
//$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
$query = sqlsrv_query($conn,"SELECT ESPR_Id, ESPR_IdSegmentoProducto FROM ESPR_SegmentoProductos WHERE ESPR_IdEventoRiesgo=".$IdEvento);
{
    if ( $query === false)
    {
        $grabado="D";
        die(print_r(sqlsrv_errors(), true));
    }						
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
        $id=$row['ESPR_Id'];
        $IdSegmentoProducto=trim($row['ESPR_IdSegmentoProducto']);
        array_push($arraySP, $IdSegmentoProducto );
    }
}

// Para Segmento Canal
$arraySN = array(); 
//$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
$query = sqlsrv_query($conn,"SELECT ESCA_Id, ESCA_IdSegmentoCanal FROM ESCA_SegmentoCanales WHERE ESCA_IdEventoRiesgo=".$IdEvento);
{
    if ( $query === false)
    {
        $grabado="D";
        die(print_r(sqlsrv_errors(), true));
    }						
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
        $id=$row['ESCA_Id'];
        $IdSegmentoCanal=trim($row['ESCA_IdSegmentoCanal']);
        array_push($arraySN, $IdSegmentoCanal );
    }
}

// Para Segmento Jurisdiccion
$arraySJ = array(); 
//$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
$query = sqlsrv_query($conn,"SELECT ESJU_Id, ESJU_IdSegmentoJurisdiccion FROM ESJU_SegmentoJurisdiccion WHERE ESJU_IdEventoRiesgo=".$IdEvento);
{
    if ( $query === false)
    {
        $grabado="D";
        die(print_r(sqlsrv_errors(), true));
    }						
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
        $id=$row['ESJU_Id'];
        $IdSegmentoJurisdiccion=trim($row['ESJU_IdSegmentoJurisdiccion']);
        array_push($arraySJ, $IdSegmentoJurisdiccion );
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
    $queryProg  ="";
    $queryProg .="DELETE FROM EFAR_FactorRiesgo WHERE EFAR_IdEventoRiesgo =$IdEvento; \n";
    $queryProg .="DELETE FROM ETIR_TipoRiesgo WHERE ETIR_IdEventoRiesgo =$IdEvento; \n";
    $queryProg .="DELETE FROM ERIA_RiesgoAsociado WHERE ERIA_IdEventoRiesgo =$IdEvento; \n";
    $queryProg .="DELETE FROM ECAU_Causas WHERE ECAU_IdEventoRiesgo =$IdEvento; \n";
    $queryProg .="DELETE FROM ECON_Consecuencias WHERE ECON_IdEventoRiesgo =$IdEvento; \n";	
	$queryProg .="DELETE FROM ESCL_SegmentoClientes WHERE ESCL_IdEventoRiesgo =$IdEvento; \n";
	$queryProg .="DELETE FROM ESPR_SegmentoProductos WHERE ESPR_IdEventoRiesgo =$IdEvento; \n";
	$queryProg .="DELETE FROM ESCA_SegmentoCanales WHERE ESCA_IdEventoRiesgo =$IdEvento; \n";
	$queryProg .="DELETE FROM ESJU_SegmentoJurisdiccion WHERE ESJU_IdEventoRiesgo =$IdEvento; \n";	
    $queryProg .="DELETE FROM EDEB_Debilidades WHERE EDEB_IdEventoRiesgo =$IdEvento; \n";
    $queryProg .="DELETE FROM EOPO_Oportunidades WHERE EOPO_IdEventoRiesgo =$IdEvento; \n";
    $queryProg .="DELETE FROM EFOR_Fortalezas WHERE EFOR_IdEventoRiesgo =$IdEvento; \n";
    $queryProg .="DELETE FROM EAME_Amenazas WHERE EAME_IdEventoRiesgo =$IdEvento; \n";

    //echo $queryProg;
    //$query = sqlsrv_query($conn,$queryProg);
    //if($query){

        //print_r ($js);
        foreach ($js as $key0=>$value0) {    
            ////echo "key....$key<br>";
            //echo "value....$value<br>";
            foreach ($value0 as $mkey1=>$mvalue1) {

                if( $mkey1 == "ERI"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $ideventoriesgo = $mvalue3;
                        }
                    }
                } // fin del if ERI

                if( $mkey1 == "PRO"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $idproceso = $mvalue3;
                        }
                    }
                } // fin del if PRO

                if( $mkey1 == "CAR"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $idcargo = $mvalue3;
                        }
                    }
                } // fin del if CAR

                if( $mkey1 == "RES"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $idresponsable = $mvalue3;
                        }
                    }
                } // fin del if RES

                if( $mkey1 == "TIR"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $queryProg .= "INSERT INTO ETIR_TipoRiesgo (ETIR_IdEventoRiesgo, ETIR_IdTipoRiesgo) VALUES ($IdEvento, $mvalue3); \n" ;
                        }
                    }
                } // fin del if TIR

                if( $mkey1 == "FAR"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $queryProg .= "INSERT INTO EFAR_FactorRiesgo (EFAR_IdEventoRiesgo, EFAR_IdFactorRiesgo) VALUES ($IdEvento, $mvalue3); \n" ;
                        }
                    }
                } // fin del if FAR

                if( $mkey1 == "RIA"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $queryProg .= "INSERT INTO ERIA_RiesgoAsociado (ERIA_IdEventoRiesgo, ERIA_IdRiesgoAsociado) VALUES ($IdEvento, $mvalue3); \n" ;
                        }
                    }
                } // fin del if RIA

                if( $mkey1 == "CAU"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $queryProg .= "INSERT INTO ECAU_Causas (ECAU_IdEventoRiesgo, ECAU_IdCausa) VALUES ($IdEvento, $mvalue3); \n" ;
                        }
                    }
                } // fin del if CAU

                if( $mkey1 == "CON"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $queryProg .= "INSERT INTO ECON_Consecuencias (ECON_IdEventoRiesgo, ECON_IdConsecuencia) VALUES ($IdEvento, $mvalue3); \n" ;
                        }
                    }
                } // fin del if CON

                if( $mkey1 == "SCL"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $queryProg .= "INSERT INTO ESCL_SegmentoClientes (ESCL_IdEventoRiesgo, ESCL_IdSegmentoCliente) VALUES ($IdEvento, $mvalue3); \n" ;
                        }
                    }
                } // fin del if SCL
				
				
				if( $mkey1 == "SPR"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $queryProg .= "INSERT INTO ESPR_SegmentoProductos (ESPR_IdEventoRiesgo, ESPR_IdSegmentoProducto) VALUES ($IdEvento, $mvalue3); \n" ;
                        }
                    }
                } // fin del if SPR
				
				if( $mkey1 == "SCA"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $queryProg .= "INSERT INTO ESCA_SegmentoCanales (ESCA_IdEventoRiesgo, ESCA_IdSegmentoCanal) VALUES ($IdEvento, $mvalue3); \n" ;
                        }
                    }
                } // fin del if SCA
				
				if( $mkey1 == "SJU"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $queryProg .= "INSERT INTO ESJU_SegmentoJurisdiccion (ESJU_IdEventoRiesgo, ESJU_IdSegmentoJurisdiccion) VALUES ($IdEvento, $mvalue3); \n" ;
                        }
                    }
                } // fin del if SJU
				
				
				if( $mkey1 == "DEB"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $queryProg .= "INSERT INTO EDEB_Debilidades (EDEB_IdEventoRiesgo, EDEB_IdDebilidad) VALUES ($IdEvento, $mvalue3); \n" ;
                        }
                    }
                } // fin del if DEB
				

                if( $mkey1 == "OPO"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $queryProg .= "INSERT INTO EOPO_Oportunidades (EOPO_IdEventoRiesgo, EOPO_IdOportunidad) VALUES ($IdEvento, $mvalue3); \n" ;
                        }
                    }
                } // fin del if OPO

                if( $mkey1 == "FOR"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $queryProg .= "INSERT INTO EFOR_Fortalezas (EFOR_IdEventoRiesgo, EFOR_IdFortaleza) VALUES ($IdEvento, $mvalue3); \n" ;
                        }
                    }
                } // fin del if FOR

                if( $mkey1 == "AME"){
                    ////echo "mvalue....$mvalue<br>";
                    foreach ($mvalue1 as $mkey2=>$mvalue2) {
                        //echo "mkey2....$mkey2<br>";

                        foreach ($mvalue2 as $mkey3=>$mvalue3) {
                            ///echo "mkey3....$mkey3<br>";
                            ///echo "mvalue3....$mvalue3<br>";
                            $queryProg .= "INSERT INTO EAME_Amenazas (EAME_IdEventoRiesgo, EAME_IdAmenaza) VALUES ($IdEvento, $mvalue3); \n" ;
                        }
                    }
                } // fin del if AME
                //echo "mkey1.....$mkey1";
            }
        } // Fin foreach ppal

        $queryProg.="UPDATE EVRI_EventoRiesgo SET EVRI_IdProceso=".$idproceso.", EVRI_IdCargo=".$idcargo.", EVRI_IdResponsable=".$idresponsable." WHERE EVRI_Id = ".$IdEvento."; \n";

        $queryProg.="UPDATE ETRA_Tratamientos SET ETRA_Grabado = 'S' WHERE ETRA_IdEventoRiesgo = ".$IdEvento.";" ;
	
       //echo "upd.....$queryProg";
        $query = sqlsrv_query($conn,$queryProg);
        if( $queryProg ){
            $grabado="S";    
        }
        else{
            $grabado="N";
        }

    //}
    /*else{
        $grabado="N";
        $queryProg  ="";
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
                $queryProg .= "INSERT INTO ETIR_TipoRiesgo (ETIR_IdEventoRiesgo, ETIR_IdTipoRiesgo) VALUES (".$IdEvento.",".$valor.");" ;
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
                $queryProg .= "INSERT INTO EFAR_FactorRiesgo (EFAR_IdEventoRiesgo, EFAR_IdFactorRiesgo) VALUES (".$IdEvento.",".$valor.");" ;
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
                $queryProg .= "INSERT INTO ERIA_RiesgoAsociado (ERIA_IdEventoRiesgo, ERIA_IdRiesgoAsociado) VALUES (".$IdEvento.",".$valor.");" ;
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
                $queryProg .= "INSERT INTO ECAU_Causas (ECAU_IdEventoRiesgo, ECAU_IdCausa) VALUES (".$IdEvento.",".$valor.");" ;
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
               $queryProg .= "INSERT INTO ECON_Consecuencias (ECON_IdEventoRiesgo, ECON_IdConsecuencia) VALUES (".$IdEvento.",".$valor.");" ;
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
                $queryProg .= "INSERT INTO EDEB_Debilidades (EDEB_IdEventoRiesgo, EDEB_IdDebilidad) VALUES (".$IdEvento.",".$valor.");" ;
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
                $queryProg .= "INSERT INTO EOPO_Oportunidades (EOPO_IdEventoRiesgo, EOPO_IdOportunidad) VALUES (".$IdEvento.",".$valor.");" ;
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
                $queryProg .= "INSERT INTO EFOR_Fortalezas (EFOR_IdEventoRiesgo, EFOR_IdFortaleza) VALUES (".$IdEvento.",".$valor.");" ;
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
                $queryProg .= "INSERT INTO EAME_Amenazas (EAME_IdEventoRiesgo, EAME_IdAmenaza) VALUES (".$IdEvento.",".$valor.");" ;
                echo $amenazas."\n";
                //$query = sqlsrv_query($conn,$amenazas);
            }    
        }
        //$query = sqlsrv_query($conn,$queryProg);
    } */   
}
echo $grabado;
?>