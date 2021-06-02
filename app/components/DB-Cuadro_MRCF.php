       <div class="table-responsive">
            <table class="table table-striped table-hover" style="font-size: 11px; color: #333;">
                    <tr>
                        <td class='text-center' colspan="4">MATRIZ DE RIESGO CON CONTROL</td>                        
                    </tr>                                                                                 
                    <tr id="miTablaAnswer_UGR">
                        <td class='text-center'>
                         <div class="form-group">
                            Probabilidad
                         </div>
                        </td>
                        <td class='text-center'>
                         <div class="form-group">
                            <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="EProbabilidadName" name="EProbabilidadName" readonly="readonly" style="font-size: 11px" value=<?php echo $rows['EProbabilidadName'];?>>
                            <?php }else{?>    
                            <select class="form-control" style="font-size: 11px; color: #333;" required >
                                <option value="">Probabilidad</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT EProbabilidadName FROM EProbabilidadSarlaft ");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                        <option value="<?php echo $row['EProbabilidadName'];?>"><?php echo $row['EProbabilidadName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                        <?php } ?>                            

                         </div>
                        </td>                                                                      
                        <td class='text-center' colspan="2" rowspan="2">
                         <div class="form-group">
                         <img src="img/mapacalor2.jpg" width="100%">
                         </div>
                        </td>
                    </tr>
                    <tr id="miTablaAnswer_UGR">
                        <td class='text-center'>
                         <div class="form-group">
                            Consecuencia
                         </div>
                        </td>
                        <td class='text-center'>
                         <div class="form-group">
                            <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="ERiesgosName" name="ERiesgosName" readonly="readonly" style="font-size: 11px" value=<?php echo $rows['ERiesgosName'];?>>
                            <?php }else{?>    
                            <select class="form-control" style="font-size: 11px; color: #333;" required >
                                <option value="">Escala de Riesgos</option>                                     
                                    <?php
                                    $query = sqlsrv_query($conn,"SELECT ERiesgosName FROM ERiesgosSarlaft ");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>
                                    <option value="<?php echo $row['ERiesgosName'];?>"><?php echo $row['ERiesgosName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                        <?php } ?>                                

                         </div>
                        </td>
                    </tr>    
            </table>
        </div> 