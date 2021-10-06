    <?php
        require_once 'config/dbx.php';
        $getConnectionSL = new Database();
        $con = $getConnectionSL->getConnectionSL($_SESSION['Keyp']);

        if (empty($_SESSION['Keyp'])) { $CustomerKey="";} else { $CustomerKey = strtolower($_SESSION["Keyp"]);}
        
        if($CustomerKey!=NULL){ 
            $query = "SELECT CustomerColor FROM CustomerSarlaft WHERE CustomerKey = '".$CustomerKey."'";
            $result = sqlsrv_query($con,$query);
            $row = sqlsrv_fetch_array($result);

            $getConnectionCli2 = new Database();
		    $conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

            // Información Básica
            $infbas=""; $metodo=""; $coinex="";
            $query_ib=sqlsrv_query($conn,"SELECT count(CLI_IdInfoBasica) AS TRInb FROM CLI_InfoBasica WHERE CLI_CustomerKey='$CustomerKey'");
            $reg_ib=sqlsrv_fetch_array($query_ib);
            $TRInb= $reg_ib['TRInb'];
            if( $TRInb == 0){ $infbas="red"; }

            $query_me=sqlsrv_query($conn,"SELECT count(MET_IdMetodologia) AS TRMet FROM MET_Metodologia WHERE MET_CustomerKey='$CustomerKey'");
            $reg_me=sqlsrv_fetch_array($query_me);
            $TRMet= $reg_me['TRMet'];
            if( $TRMet == 0){ $metodo="red"; }

            $query_ie=sqlsrv_query($conn,"SELECT count(CTX_IdContexto) AS TRIex FROM CTX_Contexto WHERE CTX_CustomerKey='$CustomerKey'");
            $reg_ie=sqlsrv_fetch_array($query_ie);
            $TRIex= $reg_ie['TRIex'];
            if( $TRIex == 0){ $coinex="red"; }

            // Parametrización
            $esccal=""; $ecate=""; $ccon=""; $ccsc=""; $efec=""; $niver=""; $pprob=""; $tiprie=""; $facrie=""; $riaso=""; $frecu=""; $escali="";$xndas="";
            $query_ec=sqlsrv_query($conn,"SELECT count(ESC_IdEscalaCalificacion) AS TREsc FROM ESC_EscalaCalificacion WHERE ESC_CustomerKey='$CustomerKey'");
            $reg_ec=sqlsrv_fetch_array($query_ec);
            $TREsc= $reg_ec['TREsc'];
            if( $TREsc == 0){ $esccal="red"; }

            $query_ex=sqlsrv_query($conn,"SELECT count(CAT_IdCategoria) AS TRCat FROM CAT_Categoria WHERE CAT_CustomerKey='$CustomerKey'");
            $reg_ex=sqlsrv_fetch_array($query_ex);
            $TRCat= $reg_ex['TRCat'];
            if( $TRCat == 0){ $ecate="red"; }

            $query_cc=sqlsrv_query($conn,"SELECT count(CON_IdControl) AS TRCco FROM CON_Control WHERE CON_CustomerKey='$CustomerKey'");
            $reg_cc=sqlsrv_fetch_array($query_cc);
            $TRCco= $reg_cc['TRCco'];
            if( $TRCco == 0){ $ccon="red"; }

            $query_cs=sqlsrv_query($conn,"SELECT count(CSC_IdConsecuencia) AS TRCsc FROM CSC_Consecuencia WHERE CSC_CustomerKey='$CustomerKey'");
            $reg_cs=sqlsrv_fetch_array($query_cs);
            $TRCsc= $reg_cs['TRCsc'];
            if( $TRCsc == 0){ $ccsc="red"; }

            $query_ef=sqlsrv_query($conn,"SELECT count(EFE_IdEfectividad) AS TREfe FROM EFE_Efectividad WHERE EFE_CustomerKey='$CustomerKey'");
            $reg_ef=sqlsrv_fetch_array($query_ef);
            $TREfe= $reg_ef['TREfe'];
            if( $TREfe == 0){ $efec="red"; }

            $query_ni=sqlsrv_query($conn,"SELECT count(NIR_IdNivelRiesgo) AS TRNir FROM NIR_NivelRiesgo WHERE NIR_CustomerKey='$CustomerKey'");
            $reg_ni=sqlsrv_fetch_array($query_ni);
            $TRNir= $reg_ni['TRNir'];
            if( $TRNir == 0){ $niver="red"; }

            $query_pr=sqlsrv_query($conn,"SELECT count(PRO_IdProbabilidad) AS TRPro FROM PRO_Probabilidad WHERE PRO_CustomerKey='$CustomerKey'");
            $reg_pr=sqlsrv_fetch_array($query_pr);
            $TRPro= $reg_pr['TRPro'];
            if( $TRPro == 0){ $pprob="red"; }

            $query_tr=sqlsrv_query($conn,"SELECT count(TIR_IdTipoRiesgo) AS TRTri FROM TIR_TipoRiesgo WHERE TIR_CustomerKey='$CustomerKey'");
            $reg_tr=sqlsrv_fetch_array($query_tr);
            $TRTri= $reg_tr['TRTri'];
            if( $TRTri == 0){ $tiprie="red"; }

            $query_fr=sqlsrv_query($conn,"SELECT count(FAR_IdFactorRiesgo) AS TRFar FROM FAR_FactorRiesgo WHERE FAR_CustomerKey='$CustomerKey'");
            $reg_fr=sqlsrv_fetch_array($query_fr);
            $TRFar= $reg_fr['TRFar'];
            if( $TRFar == 0){ $facrie="red"; }

            $query_ra=sqlsrv_query($conn,"SELECT count(RIA_IdRiesgoAsociado) AS TRRia FROM RIA_RiesgoAsociado WHERE RIA_CustomerKey='$CustomerKey'");
            $reg_ra=sqlsrv_fetch_array($query_ra);
            $TRRia= $reg_ra['TRRia'];
            if( $TRRia == 0){ $riaso="red"; }

            $query_fc=sqlsrv_query($conn,"SELECT count(FRE_IdFrecuencia) AS TRFre FROM FRE_Frecuencia WHERE FRE_CustomerKey='$CustomerKey'");
            $reg_fc=sqlsrv_fetch_array($query_fc);
            $TRFre= $reg_fc['TRFre'];
            if( $TRFre == 0){ $frecu="red"; }

            $query_ec=sqlsrv_query($conn,"SELECT count(ESC_IdEscalaCalificacion) AS TREca FROM ESC_EscalaCalificacion WHERE ESC_CustomerKey='$CustomerKey'");
            $reg_ec=sqlsrv_fetch_array($query_ec);
            $TREca= $reg_ec['TREca'];
            if( $TREca == 0){ $escali="red"; }

            // Planes
            $inter=""; $plans="";
            $query_it=sqlsrv_query($conn,"SELECT count(INT_IdInterseccion) AS TRInt FROM INT_Interseccion WHERE INT_CustomerKey='$CustomerKey'");
            $reg_it=sqlsrv_fetch_array($query_it);
            $TRInt= $reg_it['TRInt'];
            if( $TRInt == 0){ $inter="red"; }

            $query_pl=sqlsrv_query($conn,"SELECT count(id) AS TRPla FROM PlanesSarlaft WHERE CustomerKey='$CustomerKey'");
            $reg_pl=sqlsrv_fetch_array($query_pl);
            $TRPla= $reg_pl['TRPla'];
            if( $TRPla == 0){ $plans="red"; }

            // Evento de Riesgo
            $everie="";
            $query_ev=sqlsrv_query($conn,"SELECT count(EVRI_Id) AS TREvri FROM EVRI_EventoRiesgo WHERE EVRI_CustomerKey='$CustomerKey'");
            $reg_ev=sqlsrv_fetch_array($query_ev);
            $TREvri= $reg_ev['TREvri'];
            if( $TREvri == 0){ $everie="red"; }
                 
    ?>
        <!-- <ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #4e73df !important <?php //echo 
$row['CustomerColor'];?>" > -->

		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">		

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div ><img src="../img/as riesgos.png" width="100%"></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->

            <li class="nav-item active">
                <a class="nav-link" href="./setting.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="./UGR.php">
                    <i class="far fa-calendar-check"></i>
                    <span>UGR...</span></a>
            </li> -->                         

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Configuración
            </div>

            <!-- Nav Item - Pages Collapse Menu -->

             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-calendar-week"></i>
                    <span>Eventos</span>
                </a>
                <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Eventos:</h6>
                           <?php

                        $CustomerKey=$_SESSION['Keyp']; 

                        $sql = "SELECT CustomerKey FROM ProcesosSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        if ( $stmt == ''){ $na = 0; }
                        else { $na = sqlsrv_num_rows( $stmt ); }
                        //$na = sqlsrv_num_rows( $stmt );
                        if($na=='0'){$nas='red';}else{$nas='';}

                        $sql = "SELECT CustomerKey FROM CargosSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        if ( $stmt == ''){ $nb = 0; }
                        else { $nb = sqlsrv_num_rows( $stmt ); }
                        //$nb = sqlsrv_num_rows( $stmt );
                        if($nb=='0'){$nbs='red';}else{$nbs='';}                       


                        $sql = "SELECT CustomerKey FROM ResponsablesSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        if ( $stmt == ''){ $nc = 0; }
                        else { $nc = sqlsrv_num_rows( $stmt ); }
                        //$nc = sqlsrv_num_rows( $stmt );
                        if($nc=='0'){$ncs='red';}else{$ncs='';}


                        $sql = "SELECT CustomerKey FROM CausasSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        if ( $stmt == ''){ $nd = 0; }
                        else { $nd = sqlsrv_num_rows( $stmt ); }
                        //$nd = sqlsrv_num_rows( $stmt );
                        if($nd=='0'){$nds='red';}else{$nds='';}


                        $sql = "SELECT CustomerKey FROM EventosdeRiesgoSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        if ( $stmt == ''){ $ne = 0; }
                        else { $ne = sqlsrv_num_rows( $stmt ); }
                        //$ne = sqlsrv_num_rows( $stmt );
                        if($ne=='0'){$nes='red';}else{$nes='';}


                        $sql = "SELECT CustomerKey FROM ConsecuenciasSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        if ( $stmt == ''){ $nf = 0; }
                        else { $nf = sqlsrv_num_rows( $stmt ); }
                        //$nf = sqlsrv_num_rows( $stmt );
                        if($nf=='0'){$nfs='red';}else{$nfs='';}


                        $sql = "SELECT CustomerKey FROM ControlesSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        if ( $stmt == ''){ $ng = 0; }
                        else { $ng = sqlsrv_num_rows( $stmt ); }
                        //$ng = sqlsrv_num_rows( $stmt );
                        if($ng=='0'){$ngs='red';}else{$ngs='';}


                        $sql = "SELECT CustomerKey FROM TratamientosSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        if ( $stmt == ''){ $nh = 0; }
                        else { $nh = sqlsrv_num_rows( $stmt ); }
                        //$nh = sqlsrv_num_rows( $stmt );
                        if($nh=='0'){$nhs='red';}else{$nhs='';}

                        ?>                     
                        <a class="collapse-item" href="Procesos.php" style="color: <?php echo $nas;?>">Procesos</a>
                        <a class="collapse-item" href="Cargos.php" style="color: <?php echo $nbs;?>">Cargos</a>
                        <a class="collapse-item" href="Responsables.php" style="color: <?php echo $ncs;?>">Responsables</a>
                        <a class="collapse-item" href="Causas.php" style="color: <?php echo $nds;?>">Causas</a>
                        <a class="collapse-item" href="EventosdeRiesgo.php" style="color: <?php echo $nes;?>">Eventos de Riesgo</a>
                        <a class="collapse-item" href="Consecuencias.php" style="color: <?php echo $nfs;?>">Consecuencias</a>
                        <a class="collapse-item" href="Controles.php" style="color: <?php echo $ngs;?>">Controles</a>
                        <a class="collapse-item" href="Tratamientos.php" style="color: <?php echo $nhs;?>">Tratamientos</a>                        
                    </div>
                </div>
            </li>           
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-border-style"></i>
                    <span>Segmentación</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Segmentación:</h6>
                           <?php

                        $CustomerKey=$_SESSION['Keyp']; 

                        $sql = "SELECT CustomerKey FROM SegClientesSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        if ( $stmt == ''){ $sc = 0; }
                        else { $sc = sqlsrv_num_rows( $stmt ); }
                        //$sc = sqlsrv_num_rows( $stmt );
                        if($sc=='0'){$scs='red';}else{$scs='';}

                        $sql = "SELECT CustomerKey FROM SegProductosSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        if ( $stmt == ''){ $sp = 0; }
                        else { $sp = sqlsrv_num_rows( $stmt ); }
                        //$sp = sqlsrv_num_rows( $stmt );
                        if($sp=='0'){$sps='red';}else{$sps='';}                      


                        $sql = "SELECT CustomerKey FROM SegCanalesSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        if ( $stmt == ''){ $sl = 0; }
                        else { $sl = sqlsrv_num_rows( $stmt ); }
                        //$sl = sqlsrv_num_rows( $stmt );
                        if($sl=='0'){$sls='red';}else{$sls='';}


                        $sql = "SELECT CustomerKey FROM SegJurisdiccionSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        if ( $stmt == ''){ $sj = 0; }
                        else { $sj = sqlsrv_num_rows( $stmt ); }
                        //$sj = sqlsrv_num_rows( $stmt );
                        if($sj=='0'){$sjs='red';}else{$sjs='';}


                        ?>                         
                        <a class="collapse-item" href="SegClientes.php" style="color: <?php echo $scs;?>">Clientes</a>
                        <a class="collapse-item" href="SegProductos.php" style="color: <?php echo $sps;?>">Producto</a>
                        <a class="collapse-item" href="SegCanales.php" style="color: <?php echo $sls;?>">Canales</a>
                        <a class="collapse-item" href="SegJurisdiccion.php" style="color: <?php echo $sjs;?>">Jurisdicción</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities17"
                    aria-expanded="true" aria-controls="collapseUtilities4">
                    <i class="fas fa-cubes"></i>
                    <span>Contexto</span>
                </a>
				<div id="collapseUtilities17" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Información Básica:</h6>
						<a class="collapse-item" href="Infobasica.php" style="color: <?php echo $infbas;?>">Información Básica</a>
						<a class="collapse-item" href="Cliente/metodologia.php" style="color: <?php echo $metodo;?>">Metodología</a>
						<a class="collapse-item" href="Contexto.php" style="color: <?php echo $coinex;?>">Contexto Interno y Externo</a>
                    </div>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>DOFA</span>
                </a>
                <?php
                        $CustomerKey=$_SESSION['Keyp']; 
                        //echo "CK....$CustomerKey<br>";

                        $sql = "SELECT CustomerKey FROM DebilidadesSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        //echo "stmt.....$stmt<br>";
                        if ( $stmt == ''){ $nad = 0; }
                        else { $nad = sqlsrv_num_rows( $stmt ); }
                        //echo "nad.....$nad<br>";
                        if($nad=='0' ){$nads='red';}else{$nads='';}

                        $sql = "SELECT CustomerKey FROM OportunidadesSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        if ( $stmt == ''){ $nbo = 0; }
                        else { $nbo = sqlsrv_num_rows( $stmt ); }
                        //$nbo = sqlsrv_num_rows( $stmt );
                        if($nbo=='0'){$nbos='red';}else{$nbos='';}                    


                        $sql = "SELECT CustomerKey FROM FortalezasSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        //$ncf = sqlsrv_num_rows( $stmt );
                        if ( $stmt == ''){ $ncf = 0; }
                        else { $ncf = sqlsrv_num_rows( $stmt ); }
                        if($ncf=='0'){$ncfs='red';}else{$ncfs='';}


                        $sql = "SELECT CustomerKey FROM AmenazasSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        //$nda = sqlsrv_num_rows( $stmt );
                        if ( $stmt == ''){ $nda = 0; }
                        else { $nda = sqlsrv_num_rows( $stmt ); }
                        if($nda=='0'){$ndas='red';}else{$ndas='';}

                        ?>                
                <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Dofa:</h6>
                        <a class="collapse-item" href="Debilidades.php" style="color: <?php echo $nads;?>">Debilidades</a>
                        <a class="collapse-item" href="Oportunidades.php" style="color: <?php echo $nbos;?>">Oportunidades</a>
                        <a class="collapse-item" href="Fortalezas.php" style="color: <?php echo $ncfs;?>">Fortalezas</a>
                        <a class="collapse-item" href="Amenazas.php" style="color: <?php echo $ndas;?>">Amenazas</a>
                    </div>
                </div>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link" href="Escalas.php">
                    <i class="fas fa-balance-scale"></i>
                    <span>Escalas</span></a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities7"
                    aria-expanded="true" aria-controls="collapseUtilities4">
                    <i class="fas fa-cubes"></i>
                    <span>Parametrización</span>
                </a>
				<?php
				$query_titulo=sqlsrv_query($conn,"SELECT TIT_IdTitulo, TIT_Nombre FROM TIT_Titulo WHERE TIT_CustomerKey=".$_SESSION['Keyp']."");
				$regtit=sqlsrv_fetch_array($query_titulo);
				//$IdTitulo = trim($regtit['TIT_IdTitulo']);
				$NombreTitulo = trim($regtit['TIT_Nombre']);
                if( $NombreTitulo == ""){ $NombreTitulo = "Consecuencia"; }
				?>
				<div id="collapseUtilities7" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Factores Fuentes de Riesgo:</h6>
						<a class="collapse-item" href="Calificacion.php" style="color: <?php echo $esccal;?>">Escala de Calificación</a>
						<a class="collapse-item" href="Categoria.php" style="color: <?php echo $ecate;?>">Escala de Categoría</a>
						<a class="collapse-item" href="Control.php" style="color: <?php echo $ccon;?>">Escala de Control</a>
						<a class="collapse-item" href="Consecuencia.php" style="color: <?php echo $ccsc;?>">Escala de <?php echo $NombreTitulo; ?></a>
						<a class="collapse-item" href="Efectividad.php" style="color: <?php echo $efec;?>">Escala de Efectividad</a>
						<a class="collapse-item" href="Nivelriesgo.php" style="color: <?php echo $niver;?>">Escala de Nivel de Riesgo</a>
						<a class="collapse-item" href="Probabilidad.php" style="color: <?php echo $pprob;?>">Escala de Probabilidad</a>
                        <a class="collapse-item" href="Tiposriesgo.php" style="color: <?php echo $tiprie;?>">Tipos de Riesgo</a>
                        <a class="collapse-item" href="Factoresriesgo.php" style="color: <?php echo $facrie;?>">Factores de Riesgo</a>
                        <a class="collapse-item" href="RiesgoAsociado.php" style="color: <?php echo $riaso;?>">Riesgo Asociado</a>
						<a class="collapse-item" href="Frecuencia.php" style="color: <?php echo $frecu;?>">Frecuencia</a>
						<a class="collapse-item" href="Escalacalificacion.php" style="color: <?php echo $escali;?>">Escala Calificación Control</a>
                    </div>
                </div>
            </li>
			<!-- Divider -->
            <hr class="sidebar-divider">
			
			<!-- Heading -->
			<div class="sidebar-heading">
                Interface
            </div> 
			<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities9"
                    aria-expanded="true" aria-controls="collapseUtilities4">
                    <i class="fas fa-chart-line"></i>
                    <span>Planes</span>
                </a>
				<div id="collapseUtilities9" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Generación del Plan:</h6>
                        <a class="collapse-item" href="cliente/listainter.php" style="color: <?php echo $inter;?>">Intersección</a>
						<a class="collapse-item" href="cliente/tables.php" style="color: <?php echo $plans;?>">Planes</a>
                        <!-- <a class="collapse-item" href="cliente/metodologia.php" style="color: <?php echo $ndas;?>">Metodología</a> -->
                    </div>
                </div>
            </li>
			
			<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities10"
                    aria-expanded="true" aria-controls="collapseUtilities4">
                    <i class="fas fa-bolt"></i>
                    <span>Riesgo</span>
                </a>
				<div id="collapseUtilities10" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Unidad de Riesgo:</h6>
						<!-- <a class="collapse-item" href="cliente/er.php" style="color: <?php echo $ndas;?>">Riesgo</a> -->
						<a class="collapse-item" href="cliente/eventosriesgo.php" style="color: <?php echo $everie;?>">Eventos de Riesgo</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities19"
                    aria-expanded="true" aria-controls="collapseUtilities4">
                    <i class="fas fa-tools"></i>
                    <span>Herramientas</span>
                </a>
				<div id="collapseUtilities19" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Herramientas:</h6>  
                        <a class="collapse-item" href="cliente/dashboard.php" style="color: <?php echo $ndas;?>">DashBoard</a>
						<a class="collapse-item" href="#" style="color: <?php echo $ndas;?>">Matriz Riesgos</a>
						<a class="collapse-item" href="cliente/infogeneralmatriz.php" style="color: <?php echo $ndas;?>">Matriz Sarlaft</a>
						<a class="collapse-item" href="cliente/infogeneral.php" style="color: <?php echo $ndas;?>">Informe General</a>
						<a class="collapse-item" href="cliente/reporteeventos.php" style="color: <?php echo $ndas;?>">Reporte Eventos</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Gráficas</span></a>
            </li>

            <!--
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities4"
                    aria-expanded="true" aria-controls="collapseUtilities4">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapseUtilities4" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Configuración:</h6>
                
                        <a class="collapse-item" href="#Usuarios.php">Usuarios</a>
                        <a class="collapse-item" href="#UserSetup.php">Privilegios</a>                        
                    </div>
                </div>
            </li> -->
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading
            <div class="sidebar-heading">
                Addons
            </div> -->
            <li class="nav-item ">
                <a class="nav-link" href="./Clientes.php">
                    <i class="fas fa-home"></i>
                    <span>Volver a Home</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card">
                <img class="sidebar-card-illustration mb-2" src="../img/logo.ico" alt="">
                <p class="text-center mb-2"><strong>Precision Tools</strong></p>
                
            </div>

        </ul>
        <?php
            }
        ?>