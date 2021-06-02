<div class="table-responsive">
            <table class="table table-striped table-hover" style="font-size: 9px; color: #333;">
                    <tr>
                        <td class='text-center' colspan="4">RIESGOS ASOCIADOS</td>                                                
                    </tr>                             
                    <tr id="miTablaAnswer_UGR">
                        <td class='text-center' colspan="2" style="vertical-align: top;">
                            <div align="left"><label>Legal</label></div>
                        <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="RiesgoAsociadoA" name="RiesgoAsociadoA" readonly="readonly" style="font-size: 9px" value=<?php echo $rows['RiesgoAsociadoA'];?>>
                            <?php }else{?>    
                                <select class="form-control" id="RiesgoAsociadoA" name="RiesgoAsociadoA" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>  
                        <?php } ?>                              

                            <div align="left"><label>Reputacional</label></div>
                        <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="RiesgoAsociadoB" name="RiesgoAsociadoB" readonly="readonly" style="font-size: 9px" value=<?php echo $rows['RiesgoAsociadoB'];?>>
                            <?php }else{?>    
                                <select class="form-control" id="RiesgoAsociadoB" name="RiesgoAsociadoB" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>  
                        <?php } ?>  
                        </td>
                        <td class='text-center' colspan="2" style="vertical-align: top;">
                            <div align="left"><label>Operativo</label></div>
                        <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="RiesgoAsociadoC" name="RiesgoAsociadoC" readonly="readonly" style="font-size: 9px" value=<?php echo $rows['RiesgoAsociadoC'];?>>
                            <?php }else{?>    
                                <select class="form-control" id="RiesgoAsociadoC" name="RiesgoAsociadoC" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>  
                        <?php } ?>  
                            <div align="left"><label>Contagio</label></div>
                        <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="RiesgoAsociadoD" name="RiesgoAsociadoD" readonly="readonly" style="font-size: 9px" value=<?php echo $rows['RiesgoAsociadoD'];?>>
                            <?php }else{?>    
                                <select class="form-control" id="RiesgoAsociadoD" name="RiesgoAsociadoD" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>  
                        <?php } ?>  
                        </td>                                                
                    </tr>
                </table>
        </div>