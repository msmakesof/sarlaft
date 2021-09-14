<?php
include('../../ajax/is_logged.php');
$CustomerKey=$_SESSION['Keyp'];
include_once '../../config/dbx.php';

$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);

$query = sqlsrv_query($conn,"SELECT MOV_IdMovimientoMRC, MOV_FilaMRC, MOV_ColumnaMRC FROM MOV_MatrizControl WHERE MOV_IdEventoMRC = 547 AND MOV_Estado <> 'D' ");
{
    if ( $query === false)
    {
        die(print_r(sqlsrv_errors(), true));
    }						
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
        $id=$row['MOV_IdMovimientoMRC'];
        $FilaMRC=trim($row['MOV_FilaMRC']);
        $ColumnaMRC=trim($row['MOV_ColumnaMRC']);
        
        echo "<br>0]   $id.... Fila: $FilaMRC     Columna:   $ColumnaMRC<br>";

        $sel= "SELECT MOV_IdMovimientoMRC, MOV_FilsMovidas, MOV_ColsMovidas, MOV_PosicionesAMover, replace(MOV_FilaMRC, MOV_FilaMRC, $FilaMRC) AS MOV_FilaMRC FROM MOV_MatrizControl WHERE MOV_IdEventoMRC = 547 AND MOV_Estado ='G' AND MOV_IdMovimientoMRC = $id ORDER BY MOV_IdMovimientoMRC ";
        //echo "<br>$sel<br>";

        ////  AND MOV_IdMovimientoMRC = $id 
        $queryint = sqlsrv_query($conn,"SELECT MOV_IdMovimientoMRC, MOV_FilsMovidas, MOV_ColsMovidas, MOV_PosicionesAMover, MOV_FilaMRC, MOV_ColumnaMRC FROM MOV_MatrizControl WHERE MOV_IdMovimientoMRC = $id AND MOV_Estado ='G' ORDER BY MOV_IdMovimientoMRC ");
        {
            if ( $queryint === false)
            {
                die(print_r(sqlsrv_errors(), true));
            }						
            while( $rowint = sqlsrv_fetch_array( $queryint, SQLSRV_FETCH_ASSOC) ) {
                $idint=$rowint['MOV_IdMovimientoMRC'];
                $FilsMovidas=$rowint['MOV_FilsMovidas'];
                $ColsMovidas=$rowint['MOV_ColsMovidas'];
                $PosicionesAMover=$rowint['MOV_PosicionesAMover'];
                $NewFilaMRC=trim($rowint['MOV_FilaMRC']);
                $NewColumnaMRC=trim($rowint['MOV_ColumnaMRC']);
                ////$NEWFILA = $rowint['MOV_FilaMRC']; //echo "<br>NEWFILA....$NEWFILA<br>";
                //if( $idint > $id ){
                    //$nuevaFils = $FilaMRC;  //$nuevaCols = $ColumnaMRC; //echo "<br>1]   nuevaFils....$nuevaFils      nuevaCols....$nuevaCols <br>";

                    $nuevaFils = $NewFilaMRC;
                    $nuevaCols = $NewColumnaMRC;

                    if( $FilsMovidas > 0 ){
                        $nuevaFils = $NewFilaMRC + $PosicionesAMover;
                    }

                    if( $ColsMovidas > 0 ){
                        $nuevaCols = $NewColumnaMRC + $PosicionesAMover;
                    }

                    echo "<br>2]   $id...NuevaFila:  $nuevaFils      NuevaColumna:   $nuevaCols<br>";
                    break ;
                //}
            }
        }
    }
}
?>