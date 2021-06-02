        <div class="table-responsive">
            <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;"> 
                    <tr>
                        <td class='text-center' colspan="8">
                         <div class="form-group">
                            <select class="form-control" required>
                                <option value="">Evento de Riesgo</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT EventosdeRiesgoName FROM EventosdeRiesgoSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['EventosdeRiesgoName'];?>"><?php echo $row['EventosdeRiesgoName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                         </div>
                        </td>
                    </tr>                     
                    <tr>
                        <td class='text-center' colspan="2" valign="top">
                         <div class="form-group">
                            <select class="form-control" required style="font-size: 11px">
                                <option value="">Procesos</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT ProcesosName FROM ProcesosSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['ProcesosName'];?>"><?php echo $row['ProcesosName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                            <select class="form-control" required style="font-size: 11px">
                                <option value="">Cargos</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT CargosName FROM CargosSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['CargosName'];?>"><?php echo $row['CargosName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                            <select class="form-control" required style="font-size: 11px">
                                <option value="">Responsable</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT ResponsablesName FROM ResponsablesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['ResponsablesName'];?>"><?php echo $row['ResponsablesName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>                                                        
                         </div>
                     </td>
                     <td colspan="4" valign="top">

                         <div class="form-group"> 
                            <!--Fuentes de Riesgo-->

                            <?php include 'components/DB-Fuentes_Riesgo.php';?>                                                  

                            <!--Fin fuentes de Riesgo-->          
                         </div>
                     </td>
                     <td colspan="2" valign="top">

                         <div class="form-group">
                            <!--Riesgos Asociados-->

                            <?php include 'components/DB-Riesgos_Asociados.php';?> 

                            <!--Fin Riesgos Asociados-->   
                         </div>
                        </td>

                    </tr>
            </table>
        </div>