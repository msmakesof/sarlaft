<?php ?>
            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <!-- <a class="nav-link collapsed" href="../UGR.php" data-toggle="collapse" data-target="#collapseTwo" -->
                <a class="nav-link collapsed" href="../UGR.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>UGR</span>
                </a>
                <!-- <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>  -->
            </li>

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

            <!-- Divider -->
            <hr class="sidebar-divider">
            
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
                        <a class="collapse-item" href="../SegClientes.php" style="color: <?php echo $scs;?>">Clientes</a>
                        <a class="collapse-item" href="../SegProductos.php" style="color: <?php echo $sps;?>">Producto</a>
                        <a class="collapse-item" href="../SegCanales.php" style="color: <?php echo $sls;?>">Canales</a>
                        <a class="collapse-item" href="../SegJurisdiccion.php" style="color: <?php echo $sjs;?>">Jurisdicción</a>
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
				<div id="collapseUtilities7" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Factores Fuentes de Riesgo:</h6>
						<a class="collapse-item" href="../Categoria.php" style="color: <?php echo $ndas;?>">Escala de Categoría</a>						
						<a class="collapse-item" href="../Control.php" style="color: <?php echo $ndas;?>">Escala de Control</a>
						<a class="collapse-item" href="../Consecuencia.php" style="color: <?php echo $ndas;?>">Escala de Consecuencia</a>
						<a class="collapse-item" href="../Efectividad.php" style="color: <?php echo $ndas;?>">Escala Efectividad</a>
						<a class="collapse-item" href="../Nivelriesgo.php" style="color: <?php echo $ndas;?>">Escala de Nivel de Riesgo</a>
						<a class="collapse-item" href="../Probabilidad.php" style="color: <?php echo $ndas;?>">Escala de Probabilidad</a>
                        <a class="collapse-item" href="../Tiposriesgo.php" style="color: <?php echo $nads;?>">Tipos de Riesgo</a>
                        <a class="collapse-item" href="../Factoresriesgo.php" style="color: <?php echo $nbos;?>">Factores de Riesgo</a>
                        <a class="collapse-item" href="../RiesgoAsociado.php" style="color: <?php echo $ncfs;?>">Riesgo Asociado</a>						
						<a class="collapse-item" href="../Escalacalificacion.php" style="color: <?php echo $ndas;?>">Escala Calificación</a>
                    </div>
                </div>
            </li>			
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
						<a class="collapse-item" href="./listainter.php" style="color: <?php echo $ndas;?>">Intersección</a>
						<a class="collapse-item" href="./tables.php" style="color: <?php echo $ndas;?>">Planes</a>
						<a class="collapse-item" href="./metodologia.php" style="color: <?php echo $ndas;?>">Metodología</a>
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
						<a class="collapse-item" href="./er.php" style="color: <?php echo $ndas;?>">Riesgo</a>
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
						<a class="collapse-item" href="#" style="color: <?php echo $ndas;?>">Mapa de Calor</a>
						<a class="collapse-item" href="#" style="color: <?php echo $ndas;?>">Informe General</a>
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
