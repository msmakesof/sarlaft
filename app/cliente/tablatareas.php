<?php
$pid = "";
if (isset($_POST['pid']) && $_POST['pid'] != "" ){
    $pid = $_POST['pid'];
}
else{
    $pid = $IdPlan;
}
if (isset($_POST['pck']) && $_POST['pck'] != "" ){
    $pck = $_POST['pck'];
}
else{
    $pck = $CustomerKey;
}
if ($pid == ""){
    header('Location tables.php');
    die();
}
?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th class='text-center'>Tarea</th>
            <th class='text-left'>Acciones</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th class='text-center'>Tarea</th>
            <th class='text-left'>Acciones</th>
        </tr>
    </tfoot>
    <tbody>
    <?php
        //echo "<br>".$pid. ' --  '. $pck ;
        include '../curl/plan/listatareasplan.php';
        foreach($data as $key => $row) {}
        if( $key == "message"){	// No existen registros
            echo '<tr>
                    <td colspan="2">'. $data["message"] .'</td>
                </tr>';
        }
        else
        {							
            $j=1;
            for($i=0; $i<count($data['body']); $i++)
            {
                $TareaId=trim($data['body'][$i]['TPP_IdTareaxPlan']);
                $IdPlan=trim($data['body'][$i]['TPP_IdPlan']);
                $TareaName=trim($data['body'][$i]['TPP_NombreTarea']);
                $CustomerKey=trim($data['body'][$i]['TPP_CustomerKey']);
    ?>	
    <tr>
        <td class='text-left'><?php echo $TareaName;?></td>
        <td class='text-rigth'>
            <a href="#" data-target="#editModal" data-toggle="modal" data-name="<?php echo $TareaName; ?>"  dadata-idplan="<?php echo $IdPlan; ?>" data-ck="<?php echo $CustomerKey; ?>"ta-id="<?php echo $TareaId; ?>">
                <i class="fas fa-pen" data-toggle="tooltip" title="Editar Tarea" style="color:orange"></i>
            </a>
            
            <a href="#" data-target="#deletePlanModal" class="delete" data-toggle="modal" data-id="<?php echo $TareaId;?>" data-idplan="<?php echo $IdPlan; ?>" data-ck="<?php echo $CustomerKey; ?>">
                <i class="fas fa-trash" data-toggle="tooltip" title="Eliminar Tarea" style="color:red"></i>
            </a>
        </td>
    </tr>
<?php }	
}
?>                                        
    </tbody>
</table>