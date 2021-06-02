<?php include("js/Escalas.php");?>
    <div class="container">
        <div class="table-wrapper">
            <?php include("components/color.php");?>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrar <b>Escalas</b></h2>
                    </div>
                 </div>
            </div>

           <table width="90%" style="font-family: verdana; size: 10px" align="center">
            <tr>
                <td align="left"><a href="#" data-toggle="modal" data-target="#exampleModal" class='btn btn-default'><i class="material-icons">&#xE147;</i> Escala de Control </a></td>
                <td align="left"><a href="#" data-toggle="modal" data-target="#exampleModal2" class='btn btn-default'><i class="material-icons">&#xE147;</i> Escala de Probabilidad </a></td>
                <td align="left"><a href="#" data-toggle="modal" data-target="#exampleModal3" class='btn btn-default'><i class="material-icons">&#xE147;</i> Escala de Riesgos </a></td>
            </tr>
            <tr>
                <td align="center" valign="top">
    <?php
    $query = sqlsrv_query($conn,"SELECT id, EscalaKey, EControlName, EcontrolValue FROM EControlSarlaft ");      
    ?>                   
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tbody style="font-size: 11px;">
                        <?php 
                        $finales=0;
                        $i=1;
                        while($row = sqlsrv_fetch_array($query)){   
                            $id=$row['id'];
                            $EControlName=$row['EControlName'];
                            $EcontrolValue=$row['EcontrolValue'];

                        ?>  
                        <tr class="<?php echo $text_class;?>">
                            <!--<td class='text-left'><?php echo $i++;?></td>-->
                            <td class='text-left'><?php echo $EControlName;?></td>
                            <td class='text-left'><?php echo $EcontrolValue;?></td>
                            <td class='text-left'>

                                <a href="?EControl=1&id=<?php echo $id;?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
                            </td>
                        </tr>
                        <?php }?>

                </tbody>            
            </table>
        </div>                      

                </td>
                <td align="center" valign="top">
 
    <?php
    $query = sqlsrv_query($conn,"SELECT id, EscalaKey, EProbabilidadName, EProbabilidadValue FROM EProbabilidadSarlaft ");      
    ?>                   
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tbody style="font-size: 11px;">
                        <?php 
                        $finales=0;
                        $i=1;
                        while($row = sqlsrv_fetch_array($query)){   
                            $id=$row['id'];
                            $EProbabilidadName=$row['EProbabilidadName'];
                            $EProbabilidadValue=$row['EProbabilidadValue'];

                        ?>  
                        <tr class="<?php echo $text_class;?>">
                            <!--<td class='text-left'><?php echo $i++;?></td>-->
                            <td class='text-left'><?php echo $EProbabilidadName;?></td>
                            <td class='text-left'><?php echo $EProbabilidadValue;?></td>
                            <td class='text-left'>
                                <a href="?EProbabilidad=1&id=<?php echo $id;?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
                            </td>
                        </tr>
                        <?php }?>

                </tbody>            
            </table>
        </div>                    

                </td>
                <td align="center" valign="top">
    <?php
    $query = sqlsrv_query($conn,"SELECT id, EscalaKey, ERiesgosName, ERiesgosValue FROM ERiesgosSarlaft ");      
    ?>                   
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tbody style="font-size: 11px;">
                        <?php 
                        $finales=0;
                        $i=1;
                        while($row = sqlsrv_fetch_array($query)){   
                            $id=$row['id'];
                            $ERiesgosName=$row['ERiesgosName'];
                            $ERiesgosValue=$row['ERiesgosValue'];

                        ?>  
                        <tr class="<?php echo $text_class;?>">
                            <!--<td class='text-left'><?php echo $i++;?></td>-->
                            <td class='text-left'><?php echo $ERiesgosName;?></td>
                            <td class='text-left'><?php echo $ERiesgosValue;?></td>
                            <td class='text-left'>
                                <a href="#"  data-target="#editERiesgosModal" class="edit" data-toggle="modal" data-name="<?php echo $ERiesgosName?>"  data-id="<?php echo $id; ?>"><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>                                
                                <a href="?ERiesgos=1&id=<?php echo $id;?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
                            </td>
                        </tr>
                        <?php }?>

                </tbody>            
            </table>
        </div>  

                </td>
            </tr>
            <tr>
                <td align="left"><a href="#" data-toggle="modal" data-target="#exampleModal4" class='btn btn-default'><i class="material-icons">&#xE147;</i> Nivel de Riesgo </a></td>
                <td align="left"><a href="#" data-toggle="modal" data-target="#exampleModal5" class='btn btn-default'><i class="material-icons">&#xE147;</i> Efectividad </a></td>
                <td align="left"><a href="#" data-toggle="modal" data-target="#exampleModal6" class='btn btn-default'><i class="material-icons">&#xE147;</i> Categoria </a></td>
            </tr>
            <tr>
                <td align="center" valign="top">
                    
    <?php
    $query = sqlsrv_query($conn,"SELECT id, EscalaKey, ENiveldeRiesgoName, ENiveldeRiesgoValue FROM ENiveldeRiesgoSarlaft ");      
    ?>                   
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tbody style="font-size: 11px;">
                        <?php 
                        $finales=0;
                        $i=1;
                        while($row = sqlsrv_fetch_array($query)){   
                            $id=$row['id'];
                            $ENiveldeRiesgoName=$row['ENiveldeRiesgoName'];
                            $ENiveldeRiesgoValue=$row['ENiveldeRiesgoValue'];

                        ?>  
                        <tr class="<?php echo $text_class;?>">
                            <!--<td class='text-left'><?php echo $i++;?></td>-->
                            <td class='text-left'><?php echo $ENiveldeRiesgoName;?></td>
                            <td class='text-left'><?php echo $ENiveldeRiesgoValue;?></td>
                            <td class='text-left'>
                                <a href="?ENiveldeRiesgo=1&id=<?php echo $id;?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
                            </td>
                        </tr>
                        <?php }?>

                </tbody>            
            </table>
        </div>  
                </td>
                <td align="center" valign="top">
     <?php
    $query = sqlsrv_query($conn,"SELECT id, EscalaKey, EEfectividadName, EEfectividadValue FROM EEfectividadSarlaft ");      
    ?>                   
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tbody style="font-size: 11px;">
                        <?php 
                        $finales=0;
                        $i=1;
                        while($row = sqlsrv_fetch_array($query)){   
                            $id=$row['id'];
                            $EEfectividadName=$row['EEfectividadName'];
                            $EEfectividadValue=$row['EEfectividadValue'];

                        ?>  
                        <tr class="<?php echo $text_class;?>">
                            <!--<td class='text-left'><?php echo $i++;?></td>-->
                            <td class='text-left'><?php echo $EEfectividadName;?></td>
                            <td class='text-left'><?php echo $EEfectividadValue;?></td>
                            <td class='text-left'>
                                <a href="?EEfectividad=1&id=<?php echo $id;?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
                            </td>
                        </tr>
                        <?php }?>

                </tbody>            
            </table>
        </div>        

                </td>
                <td align="center" valign="top">
     <?php
    $query = sqlsrv_query($conn,"SELECT id, EscalaKey, ECategoriaName, ECategoriaValue FROM ECategoriaSarlaft ");      
    ?>                   
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tbody style="font-size: 11px;">
                        <?php 
                        $finales=0;
                        $i=1;
                        while($row = sqlsrv_fetch_array($query)){   
                            $id=$row['id'];
                            $ECategoriaName=$row['ECategoriaName'];
                            $ECategoriaValue=$row['ECategoriaValue'];

                        ?>  
                        <tr class="<?php echo $text_class;?>">
                            <!--<td class='text-left'><?php echo $i++;?></td>-->
                            <td class='text-left'><?php echo $ECategoriaName;?></td>
                            <td class='text-left'><?php echo $ECategoriaValue;?></td>
                            <td class='text-left'>
                                <a href="?ECategoria=1&id=<?php echo $id;?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
                            </td>
                        </tr>
                        <?php }?>

                </tbody>            
            </table>
        </div> 
                </td>
            </tr>            
        </table> 
          

        </div>
    </div>
    <?php include("modal/modal_add_econtrol.php");?>
    <?php include("modal/modal_add_eprobabilidad.php");?>
    <?php include("modal/modal_add_eriesgos.php");?>
    <?php include("modal/modal_add_enivelderiesgo.php");?>
    <?php include("modal/modal_add_eefectividad.php");?>
    <?php include("modal/modal_add_ecategoria.php");?>   

