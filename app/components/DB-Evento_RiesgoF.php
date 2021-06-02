        <div class="table-responsive">
            <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;">
                    <tr>
                        <td>
                         <div class="form-group">
                            <div align="left"><label>Consecutivo</label></div>
                            <input class="form-control" type="text" id="ConsecutivoEventoRiesgoValue" name="ConsecutivoEventoRiesgoValue" readonly="readonly" value=<?php echo $rows['ConsecutivoEventoRiesgoValue'] ;?>>
                        </div>                            
                        </td>
                        <td colspan="2"></td>
                        <td class='text-center' colspan="10">
                         <div class="form-group">
                            <div align="left"><label>Evento</label></div>
                            <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                            <input class="form-control" type="text" id="ConsecutivoEventoRiesgoValue" name="ConsecutivoEventoRiesgoValue" readonly="readonly" value=<?php echo $rows['EventosdeRiesgoName'];?>>
                            <?php }else{?>    
                            <select class="form-control" id="EventosdeRiesgoName" name="EventosdeRiesgoName" required="required">
                                <option value="<?php echo $rows['EventosdeRiesgoName'];?>"><?php echo $rows['EventosdeRiesgoName'];?></option>
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT EventosdeRiesgoName FROM EventosdeRiesgoSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['EventosdeRiesgoName'];?>"><?php echo $row['EventosdeRiesgoName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                        <?php } ?>
                         </div>
                        </td>
                         <td colspan="2" align="right" style="vertical-align: top;"><?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                        <a href="UGR?Acc=New" class="btn btn-primary"><div style="font-size:12px;color: #fff">Nuevo</div></a>
                            <?php }else{?>
                        <a href="?ERK=<?php echo $_GET['ERK'];?>" class="btn btn-primary"><div style="font-size:12px;color: #fff">Volver</div></a>
      
                                    <?php
                                        }
                                    ?></td>
                        <td colspan="2" align="right" style="vertical-align: top;">
                            <?php
                            if (empty($_GET['Edit'])) { $Edit="";} else { $Edit = strtolower($_GET["Edit"]);}
                            if($Edit==NULL){ ?>
                        <a href="?ERK=<?php echo $_GET['ERK'];?>&Edit=1" class="btn btn-primary"><div style="font-size:12px;color: #fff">Editar</div></a>
                            <?php }else{?>
                        <button type="button" id="btn-ingresarF" class="btn btn-primary">Guardar</button>        
                                    <?php
                                        }
                                    ?>
                    </td>
                    </tr>
            </table>
        </div>