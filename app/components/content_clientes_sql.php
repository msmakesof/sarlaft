
                  <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <h1 class="h3 mb-2 text-gray-800">Clientes</h1>
                            </div>
                            <div class="col-sm">
                                <p class="mb-4" align="right"><button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Nuevo cliente</button></p>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table " id="dataTable" width="100%" cellspacing="0" style="font-family: verdana; color: purple; font-size: 10px">
<?php 
$i=1;
$query="SELECT id, CustomerKey, CustomerLogo, CustomerCity, CustomerName, CustomerNit, CustomerColor FROM CustomerSarlaft";
$resultado=sqlsrv_query($conn, $query);
        //se desplegaran los resultados en la tabla
        echo "<thead>";
        echo "<tr class='info'>";
        echo "<th>#</th>";
        echo "<th>Logo</th>";
        echo "<th>Ciudad</th>";
        echo "<th>Nombre Entidad</th>";
        echo "<th>Nit</th>";
        echo "<th>Color</th>";
        echo "<th><span class='pull-right'>Acciones</span></th>";
        echo "</tr>";
        echo "</thead>";


        while($row=sqlsrv_fetch_array($resultado)){
        echo "<tbody>";
            echo '<tr>';
            echo '<td>'.$i++.'</td>';
            echo '<td>'.$row['CustomerLogo'].'</td>';
            echo '<td>'.$row['CustomerCity'].'</td>';
            echo '<td>'.$row['CustomerName'].'</td>';
            echo '<td>'.$row['CustomerNit'].'</td>';
            echo '<td>'.$row['CustomerColor'].'</td>';
            echo '<td>-</td>';
            echo '</tr>';          
        echo "</tbody>";
                }
                ?>
                        </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->              