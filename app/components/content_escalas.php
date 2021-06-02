<?php include("js/Escalas.php");?>
    <div class="container">
        <div class="table-wrapper">
            <?php include("components/color.php");?>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrar <b>Escalas</b></h2><a href="?db=escala"> Comenzar</a>
                    </div>
                 </div>
            </div>

           <table width="90%" style="font-family: verdana; size: 10px" align="center">
            <tr>
                <td align="left"> Escala de Control </td>
                <td align="left"> Escala de Probabilidad </td>
                <td align="left"> Escala de Riesgos </td>
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
                            <td class='text-center'><?php echo $EControlName;?></td>
                            <td class='text-center'><?php echo $EcontrolValue;?></td>
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
                        </tr>
                        <?php }?>

                </tbody>            
            </table>
        </div>  

                </td>
            </tr>
            <tr>
                <td align="left"> Nivel de Riesgo </td>
                <td align="left"> Efectividad </td>
                <td align="left"> Categoria </td>
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


