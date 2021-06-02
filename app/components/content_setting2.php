                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h5 class="h3 mb-0 text-gray-800"><?php echo $reg['CustomerName'];?></h5>
                            <div class="col-sm">
                                <p class="mb-4" align="right"><img src='img/<?php echo $reg['CustomerLogo'];?>' class="img-responsive"  border='0'/></p>
                            </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                    
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Eventos 
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                        $CustomerKey=$_SESSION['Keyp']; 

                        $sql = "SELECT CustomerKey FROM ProcesosSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $na = sqlsrv_num_rows( $stmt );
                        if($na=='0'){$nas='0';}else{$nas='1';}

                        $sql = "SELECT CustomerKey FROM CargosSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $nb = sqlsrv_num_rows( $stmt );
                        if($nb=='0'){$nbs='0';}else{$nbs='1';}                       


                        $sql = "SELECT CustomerKey FROM ResponsablesSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $nc = sqlsrv_num_rows( $stmt );
                        if($nc=='0'){$ncs='0';}else{$ncs='1';}


                        $sql = "SELECT CustomerKey FROM CausasSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $nd = sqlsrv_num_rows( $stmt );
                        if($nd=='0'){$nds='0';}else{$nds='1';}


                        $sql = "SELECT CustomerKey FROM EventosdeRiesgoSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $ne = sqlsrv_num_rows( $stmt );
                        if($ne=='0'){$nes='0';}else{$nes='1';}


                        $sql = "SELECT CustomerKey FROM ConsecuenciasSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $nf = sqlsrv_num_rows( $stmt );
                        if($nf=='0'){$nfs='0';}else{$nfs='1';}


                        $sql = "SELECT CustomerKey FROM ControlesSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $ng = sqlsrv_num_rows( $stmt );
                        if($ng=='0'){$ngs='0';}else{$ngs='1';}


                        $sql = "SELECT CustomerKey FROM TratamientosSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $nh = sqlsrv_num_rows( $stmt );
                        if($nh=='0'){$nhs='0';}else{$nhs='1';}

                        $total=$nas+$nbs+$ncs+$nds+$nes+$nfs+$ngs+$nhs;
                        $u='8';
                        $por=($total*100)/$u;

                        echo $por;// obtenemos el n�mero de filas.
                        ?>%
                                            </div>
                                        </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width:<?php echo $por;?>%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                          <div class="col-auto">
                                            <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                                        </div>                                                 
                                    </div>                                    
                                </div> 
                             
                            </div>
                        </div>


                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Segmentación
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                           <?php

                        $CustomerKey=$_SESSION['Keyp']; 

                        $sql = "SELECT CustomerKey FROM SegClientesSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $sc = sqlsrv_num_rows( $stmt );
                        if($sc=='0'){$scs='0';}else{$scs='1';}

                        $sql = "SELECT CustomerKey FROM SegProductosSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $sp = sqlsrv_num_rows( $stmt );
                        if($sp=='0'){$sps='0';}else{$sps='1';}                      


                        $sql = "SELECT CustomerKey FROM SegCanalesSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $sl = sqlsrv_num_rows( $stmt );
                        if($sl=='0'){$sls='0';}else{$sls='1';}


                        $sql = "SELECT CustomerKey FROM SegJurisdiccionSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $sj = sqlsrv_num_rows( $stmt );
                        if($sj=='0'){$sjs='0';}else{$sjs='1';}

                        $segm=$scs+$sps+$sls+$sjs;
                        $g='4';
                        $segm2=($segm*100)/$g;

                        echo $segm2;// obtenemos el n�mero de filas.
                        ?>%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: <?php echo $segm2;?>%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-border-style fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">DOFA
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <?php
                        $CustomerKey=$_SESSION['Keyp']; 

                        $sql = "SELECT CustomerKey FROM DebilidadesSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $nad = sqlsrv_num_rows( $stmt );
                        if($nad=='0'){$nad='0';}else{$nad='1';}

                        $sql = "SELECT CustomerKey FROM OportunidadesSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $nbo = sqlsrv_num_rows( $stmt );
                        if($nbo=='0'){$nbd='0';}else{$nbd='1';}                       


                        $sql = "SELECT CustomerKey FROM FortalezasSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $ncf = sqlsrv_num_rows( $stmt );
                        if($ncf=='0'){$ncd='0';}else{$ncd='1';}


                        $sql = "SELECT CustomerKey FROM AmenazasSarlaft WHERE CustomerKey='$CustomerKey'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $nda = sqlsrv_num_rows( $stmt );
                        if($nda=='0'){$ndd='0';}else{$ndd='1';}


                        $totald=$nad+$nbd+$ncd+$ndd;
                        $v='4';
                        $por2=($totald*100)/$v;

                        echo $por2;// obtenemos el n�mero de filas.
                        ?>%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: <?php echo $por2;?>%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-wrench fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        
                        <div class="col-xl-3 col-md-6 mb-4"><a href="./Planes">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Planes
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                    <?php 
                        $sql = "SELECT DISTINCT PlanesKey AS PlanesKey FROM PlanesSarlaft ";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        $ncp = sqlsrv_num_rows( $stmt );
                        echo $ncp;
                    ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div> </a>
                        </div>

                    </div>

 

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Planes</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Configuración</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Eventos
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Dofa
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Segmentación
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <!-- /.container-fluid -->