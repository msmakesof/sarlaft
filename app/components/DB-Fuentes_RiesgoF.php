        <div class="table-responsive">
            <table class="table table-striped table-hover" style="font-size: 9px; color: #333;">
                    <tr>
                        <td class='text-center' colspan="8">FACTORES / FUENTES DE RIESGO</td>                                                
                    </tr>                        
                    <tr id="miTablaAnswer_UGR" colspan="2">
                        <td class='text-center'>Tipo de Riesgo</td>
                        <td class='text-center'>Asociado</td>
                        <td class='text-center'>Empleado</td>
                        <td class='text-center'>Proveedor</td>
                        <td class='text-center'>Accionista</td>
                        <td class='text-center'>Producto</td>
                        <td class='text-center'>Canal</td>
                        <td class='text-center'>Jurisdicción</td>                                                
                    </tr>
                    <tr class="<?php echo $text_class;?>">
                            <td class='text-center'>
                        <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="TipoRiesgo" name="TipoRiesgo" readonly="readonly" style="font-size: 9px" value=<?php echo $rows['TipoRiesgo'];?>>
                            <?php }else{?>    
                                <select class="form-control" id="TipoRiesgo" name="TipoRiesgo" required style="font-size: 9px">
                                <option value="">-</option>
                                <option value="LA">LA</option>
                                <option value="FT">FT</option>
                                <option value="PAM">PAM</option>
                                </select>
                        <?php } ?>
                            </td>
                            <td class='text-left'>
                        <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="FuenteRiesgoA" name="FuenteRiesgoA" readonly="readonly" style="font-size: 9px" value=<?php echo $rows['FuenteRiesgoA'];?>>
                            <?php }else{?>    
                                <select class="form-control" id="FuenteRiesgoA" name="FuenteRiesgoA" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>  
                        <?php } ?>  
                              
                            </td>
                            <td class='text-left'>
                        <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="FuenteRiesgoB" name="FuenteRiesgoB" readonly="readonly" style="font-size: 9px" value=<?php echo $rows['FuenteRiesgoB'];?>>
                            <?php }else{?>    
                                <select class="form-control" id="FuenteRiesgoB" name="FuenteRiesgoB" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>  
                        <?php } ?>                                
                            </td>
                            <td class='text-left'>
                        <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="FuenteRiesgoC" name="FuenteRiesgoC" readonly="readonly" style="font-size: 9px" value=<?php echo $rows['FuenteRiesgoC'];?>>
                            <?php }else{?>    
                                <select class="form-control" id="FuenteRiesgoC" name="FuenteRiesgoC" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>  
                        <?php } ?>                               
                            </td>
                            <td class='text-left'>
                        <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="FuenteRiesgoD" name="FuenteRiesgoD" readonly="readonly" style="font-size: 9px" value=<?php echo $rows['FuenteRiesgoD'];?>>
                            <?php }else{?>    
                                <select class="form-control" id="FuenteRiesgoD" name="FuenteRiesgoD" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>  
                        <?php } ?>                               
                            </td>
                            <td class='text-left'>
                        <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="FuenteRiesgoE" name="FuenteRiesgoE" readonly="readonly" style="font-size: 9px" value=<?php echo $rows['FuenteRiesgoE'];?>>
                            <?php }else{?>    
                                <select class="form-control" id="FuenteRiesgoE" name="FuenteRiesgoE" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>  
                        <?php } ?>                              
                            </td>
                            <td class='text-left'>
                        <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="FuenteRiesgoF" name="FuenteRiesgoF" readonly="readonly" style="font-size: 9px" value=<?php echo $rows['FuenteRiesgoF'];?>>
                            <?php }else{?>    
                                <select class="form-control" id="FuenteRiesgoF" name="FuenteRiesgoF" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>  
                        <?php } ?>                                
                            </td>
                            <td class='text-center'>
                        <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="FuenteRiesgoG" name="FuenteRiesgoG" readonly="readonly" style="font-size: 9px" value=<?php echo $rows['FuenteRiesgoG'];?>>
                            <?php }else{?>    
                                <select class="form-control" id="FuenteRiesgoG" name="FuenteRiesgoG" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>  
                        <?php } ?>                                
                            </td>
                        </tr>           
            </table>
        </div>