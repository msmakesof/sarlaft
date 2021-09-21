<?php 
$CustomerKey=$_SESSION['Keyp']; 
$nas=""; $nbs="";$ncs=""; $nds="";$nes="";$nfs="";$ngs="";$nhs="";
$query_pr=sqlsrv_query($conn,"SELECT count(id) AS TRPro FROM ProcesosSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_pr=sqlsrv_fetch_array($query_pr);
$TRPro= $reg_pr['TRPro'];
if( $TRPro == 0){ $nas="red"; }

$query_ca=sqlsrv_query($conn,"SELECT count(CargosId) AS TRCar FROM CargosSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_ca=sqlsrv_fetch_array($query_ca);
$TRCar= $reg_ca['TRCar'];
if( $TRCar == 0){ $nbs="red"; }

$query_re=sqlsrv_query($conn,"SELECT count(ResponsablesId) AS TRRes FROM ResponsablesSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_re=sqlsrv_fetch_array($query_re);
$TRRes= $reg_re['TRRes'];
if( $TRRes == 0){ $ncs="red"; }

$query_cs=sqlsrv_query($conn,"SELECT count(id) AS TRCau FROM CausasSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_cs=sqlsrv_fetch_array($query_cs);
$TRCau= $reg_cs['TRCau'];
if( $TRCau == 0){ $nds="red"; }

$query_er=sqlsrv_query($conn,"SELECT count(id) AS TREdr FROM EventosdeRiesgoSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_er=sqlsrv_fetch_array($query_er);
$TREdr= $reg_er['TREdr'];
if( $TREdr == 0){ $nes="red"; }

$query_co=sqlsrv_query($conn,"SELECT count(id) AS TRCon FROM ConsecuenciasSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_co=sqlsrv_fetch_array($query_co);
$TRCon= $reg_co['TRCon'];
if( $TRCon == 0){ $nfs="red"; }

$query_ct=sqlsrv_query($conn,"SELECT count(id) AS TRCtr FROM ControlesSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_ct=sqlsrv_fetch_array($query_ct);
$TRCtr= $reg_ct['TRCtr'];
if( $TRCtr == 0){ $ngs="red"; }

$query_tr=sqlsrv_query($conn,"SELECT count(id) AS TRTra FROM TratamientosSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_tr=sqlsrv_fetch_array($query_tr);
$TRTra= $reg_tr['TRTra'];
if( $TRTra == 0){ $nhs="red"; }

//Segmentación
$scs=""; $sps=""; $sls=""; $sjs="";

$query_sc=sqlsrv_query($conn,"SELECT count(id) AS TRSec FROM SegClientesSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_sc=sqlsrv_fetch_array($query_sc);
$TRSec= $reg_sc['TRSec'];
if( $TRSec == 0){ $scs="red"; }

$query_sp=sqlsrv_query($conn,"SELECT count(id) AS TRSep FROM SegProductosSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_sp=sqlsrv_fetch_array($query_sp);
$TRSep= $reg_sp['TRSep'];
if( $TRSep == 0){ $sps="red"; }

$query_sx=sqlsrv_query($conn,"SELECT count(id) AS TRSex FROM SegCanalesSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_sx=sqlsrv_fetch_array($query_sx);
$TRSex= $reg_sx['TRSex'];
if( $TRSex == 0){ $sls="red"; }

$query_sj=sqlsrv_query($conn,"SELECT count(id) AS TRSej FROM SegJurisdiccionSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_sj=sqlsrv_fetch_array($query_sj);
$TRSej= $reg_sj['TRSej'];
if( $TRSej == 0){ $sjs="red"; }

// Dofa
$nads = ""; $nbos="";$ncfs="";$ndas="";

$query_de=sqlsrv_query($conn,"SELECT count(id) AS TRDeb FROM DebilidadesSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_de=sqlsrv_fetch_array($query_de);
$TRDeb= $reg_de['TRDeb'];
if( $TRDeb == 0){ $nads="red"; }

$query_op=sqlsrv_query($conn,"SELECT count(id) AS TROpo FROM OportunidadesSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_op=sqlsrv_fetch_array($query_op);
$TROpo= $reg_op['TROpo'];
if( $TROpo == 0){ $nbos="red"; }

$query_fo=sqlsrv_query($conn,"SELECT count(id) AS TRFor FROM FortalezasSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_fo=sqlsrv_fetch_array($query_fo);
$TRFor= $reg_fo['TRFor'];
if( $TRFor == 0){ $ncfs="red"; }

$query_am=sqlsrv_query($conn,"SELECT count(id) AS TRAme FROM AmenazasSarlaft WHERE CustomerKey='$CustomerKey'");
$reg_am=sqlsrv_fetch_array($query_am);
$TRAme= $reg_am['TRAme'];
if( $TRAme == 0){ $ndas="red"; }
		
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
            <!-- Heading
            <div class="sidebar-heading">
                Interface
            </div>  -->
            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item"> -->
                <!-- <a class="nav-link collapsed" href="../UGR.php" data-toggle="collapse" data-target="#collapseTwo"
                <a class="nav-link collapsed" href="../UGR.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>UGR</span>
                </a> -->
                <!-- <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>  -->
            <!-- </li> -->

            <!-- Nav Item - Utilities Collapse Menu
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>   -->

            <!-- Divider
            <hr class="sidebar-divider">  -->
            
			<!-- Heading -->
            <div class="sidebar-heading">
                Configuración
            </div>

            <!-- Nav Item - Pages Collapse Menu
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->
			<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-calendar-week"></i>
                    <span>Eventos</span>
                </a>
                <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Eventos:</h6>                   
                        <a class="collapse-item" href="../Procesos.php" style="color: <?php echo $nas;?>">Procesos</a>
                        <a class="collapse-item" href="../Cargos.php" style="color: <?php echo $nbs;?>">Cargos</a>
                        <a class="collapse-item" href="../Responsables.php" style="color: <?php echo $ncs;?>">Responsables</a>
                        <a class="collapse-item" href="../Causas.php" style="color: <?php echo $nds;?>">Causas</a>
                        <a class="collapse-item" href="../EventosdeRiesgo.php" style="color: <?php echo $nes;?>">Eventos de Riesgo</a>
                        <a class="collapse-item" href="../Consecuencias.php" style="color: <?php echo $nfs;?>">Consecuencias</a>
                        <a class="collapse-item" href="../Controles.php" style="color: <?php echo $ngs;?>">Controles</a>
                        <a class="collapse-item" href="../Tratamientos.php" style="color: <?php echo $nhs;?>">Tratamientos</a>                        
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
                        <a class="collapse-item" href="../SegClientes.php" style="color: <?php echo $scs;?>">Clientes</a>
                        <a class="collapse-item" href="../SegProductos.php" style="color: <?php echo $sps;?>">Producto</a>
                        <a class="collapse-item" href="../SegCanales.php" style="color: <?php echo $sls;?>">Canales</a>
                        <a class="collapse-item" href="../SegJurisdiccion.php" style="color: <?php echo $sjs;?>">Jurisdicción</a>
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
						<a class="collapse-item" href="./metodologia.php" style="color: <?php echo $metodo;?>">Metodología</a>
						<a class="collapse-item" href="../Contexto.php" style="color: <?php echo $coinex;?>">Contexto Interno y Externo</a>
                    </div>
                </div>
            </li>
			<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>DOFA</span>
                </a>              
                <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Dofa:</h6>
                        <a class="collapse-item" href="../Debilidades.php" style="color: <?php echo $nads;?>">Debilidades</a>
                        <a class="collapse-item" href="../Oportunidades.php" style="color: <?php echo $nbos;?>">Oportunidades</a>
                        <a class="collapse-item" href="../Fortalezas.php" style="color: <?php echo $ncfs;?>">Fortalezas</a>
                        <a class="collapse-item" href="../Amenazas.php" style="color: <?php echo $ndas;?>">Amenazas</a>
                    </div>
                </div>
            </li>
			<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities7"
                    aria-expanded="true" aria-controls="collapseUtilities4">
                    <i class="fas fa-cubes"></i>
                    <span>Parametrización</span>
                </a>
				<?php				
				require_once '../config/dbx.php';
				$getConnectionCli2 = new Database();
				$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);
				$query_titulo=sqlsrv_query($conn,"SELECT TIT_IdTitulo, TIT_Nombre FROM TIT_Titulo WHERE TIT_CustomerKey='$CustomerKey'");
				$regtit=sqlsrv_fetch_array($query_titulo);
				//$IdTitulo = trim($regtit['TIT_IdTitulo']);
				$NombreTitulo = trim($regtit['TIT_Nombre']);
				if( $NombreTitulo == ""){ $NombreTitulo = "Consecuencia"; }
				?>
				<div id="collapseUtilities7" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Factores Fuentes de Riesgo:</h6>
						<a class="collapse-item" href="../Calificacion.php" style="color: <?php echo $esccal;?>">Escala de Calificación</a>
                        <a class="collapse-item" href="../Categoria.php" style="color: <?php echo $ecate;?>">Escala de Categoría</a>
						<a class="collapse-item" href="../Control.php" style="color: <?php echo $ccon;?>">Escala de Control</a>
						<a class="collapse-item" href="../Consecuencia.php" style="color: <?php echo $ccsc;?>">Escala de <?php echo $NombreTitulo; ?></a>
						<a class="collapse-item" href="../Efectividad.php" style="color: <?php echo $efec;?>">Escala Efectividad</a>
						<a class="collapse-item" href="../Nivelriesgo.php" style="color: <?php echo $niver;?>">Escala de Nivel de Riesgo</a>
						<a class="collapse-item" href="../Probabilidad.php" style="color: <?php echo $pprob;?>">Escala de Probabilidad</a>
                        <a class="collapse-item" href="../Tiposriesgo.php" style="color: <?php echo $tiprie;?>">Tipos de Riesgo</a>
                        <a class="collapse-item" href="../Factoresriesgo.php" style="color: <?php echo $facrie;?>">Factores de Riesgo</a>
                        <a class="collapse-item" href="../RiesgoAsociado.php" style="color: <?php echo $riaso;?>">Riesgo Asociado</a>
						<a class="collapse-item" href="../Frecuencia.php" style="color: <?php echo $frecu;?>">Frecuencia</a>
						<a class="collapse-item" href="../Escalacalificacion.php" style="color: <?php echo $escali;?>">Escala Calificación Control</a>
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
                        <!-- <a class="collapse-item" href="interseccion.php" style="color: <?php echo $ndas;?>">Intersección</a>-->
						<a class="collapse-item" href="./listainter.php" style="color: <?php echo $inter;?>">Intersección</a>
						<a class="collapse-item" href="./tables.php" style="color: <?php echo $plans;?>">Planes</a>
                        <!-- <a class="collapse-item" href="./metodologia.php" style="color: <?php echo $ndas;?>">Metodología</a>-->
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
						<!-- <a class="collapse-item" href="./er.php" style="color: <?php echo $ndas;?>">Riesgo</a> -->
						<a class="collapse-item" href="./eventosriesgo.php" style="color: <?php echo $everie;?>">Eventos de Riesgo</a>
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
                        <a class="collapse-item" href="#" style="color: <?php echo $ndas;?>">DashBoard</a>
						<a class="collapse-item" href="#" style="color: <?php echo $ndas;?>">Matriz Riesgos</a>
						<a class="collapse-item" href="./infogeneralmatriz.php" style="color: <?php echo $ndas;?>">Matriz Sarlaft</a>
						<a class="collapse-item" href="./infogeneral.php" style="color: <?php echo $ndas;?>">Informe General</a>
						<a class="collapse-item" href="#" style="color: <?php echo $ndas;?>">Reporte Eventos</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Gráficas</span></a>
            </li>

            <!-- Nav Item - Tables
            <li class="nav-item active">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> -->

            <!-- Nav Item - Pages Collapse Menu
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Planes</span>
                </a>
                <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">                        
                        <a class="collapse-item" href="Factoresriesgo.php">Factores Riesgo</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>                        
                    </div>
                </div>
            </li> -->
			<!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link collapsed" href="../Clientes.php">
                    <i class="fas fa-home"></i>
                    <span>Volver a Home</span>
                </a>
            </li>
