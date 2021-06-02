        <div class="table-responsive">
            <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;">          
                    <tr>
                        <td class='text-center' colspan="2" rowspan="2" style="vertical-align: top;">
                         <div class="form-group">
                            <div align="left"><label>Procesos</label></div>

                            <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="ProcesosName" name="ProcesosName" readonly="readonly" style="font-size: 11px" value=<?php echo $rows['ProcesosName'];?>>
                            <?php }else{?>    
                            <select class="form-control" id="ProcesosName" name="ProcesosName" style="font-size: 11px">
                                <option value="<?php echo $rows['ProcesosName'];?>"><?php echo $rows['ProcesosName'];?></option>                                    
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT ProcesosName FROM ProcesosSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['ProcesosName'];?>"><?php echo $row['ProcesosName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                        <?php } ?>


                            <div align="left"><label>Cargos</label></div>

                            <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="CargosName" name="CargosName" readonly="readonly" style="font-size: 11px" value=<?php echo $rows['CargosName'];?>>
                            <?php }else{?>    
                            <select class="form-control" id="CargosName" name="CargosName" style="font-size: 11px">
                                <option value="<?php echo $rows['CargosName'];?>"><?php echo $rows['CargosName'];?></option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT CargosName FROM CargosSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['CargosName'];?>"><?php echo $row['CargosName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                        <?php } ?>


                            <div align="left"><label>Responsables</label></div>

                            <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="ResponsablesName" name="ResponsablesName" readonly="readonly" style="font-size: 11px" value=<?php echo $rows['ResponsablesName'];?>>
                            <?php }else{?>    
                            <select class="form-control" id="ResponsablesName" name="ResponsablesName" style="font-size: 11px">
                                <option value="<?php echo $rows['ResponsablesName'];?>"><?php echo $rows['ResponsablesName'];?></option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT ResponsablesName FROM ResponsablesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['ResponsablesName'];?>"><?php echo $row['ResponsablesName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select> 
                        <?php } ?>

                                                       
                         </div>
                     </td>
                     <td colspan="6" style="vertical-align: top;">

                         <div class="form-group"> 
                            <!--Fuentes de Riesgo-->

                            <?php include 'components/DB-Fuentes_RiesgoF.php';?>                                                  

                            <!--Fin fuentes de Riesgo-->          
                         </div>
                     </td>
                     <td colspan="2" valign="top">

                         <div class="form-group">
                            <!--Riesgos Asociados-->

                            <?php include 'components/DB-Riesgos_AsociadosF.php';?> 

                            <!--Fin Riesgos Asociados-->   
                         </div>
                     </td>

                    </tr>
            </table>
        </div>