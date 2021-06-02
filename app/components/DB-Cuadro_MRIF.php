       <div class="table-responsive">
            <table class="table table-striped table-hover" style="font-size: 11px; color: #333;">
                <tr>
                        <td class='text-center' colspan="4">MATRIZ DE RIESGO INHERENTE</td>                        
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
                            <select class="form-control" id="EProbabilidadName" name="EProbabilidadName" required style="font-size: 11px">
                                <option value="">Responsable</option>                                     
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
                         <img src="img/mapacalor1.jpg" width="100%">
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
                            <select class="form-control" id="ERiesgosName" name="ERiesgosName" style="font-size: 11px; color: #333;" required >
                                <option value="">Escala de Riesgos</option>                                     
                                    <?php
                                    $query = sqlsrv_query($conn,"SELECT ERiesgosName FROM ERiesgosSarlaft");
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
 <style type="text/css">
/* Círculos de colores numerados */
span.red {
  background: #dc3545;
   border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em; 
}

span.yellow {
  background: #ffc107;
  border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #fff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em; 
}

span.green {
  background: #28a745;
  border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em; 
}

span.blue {
  background: #007bff;
  border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em; 
}

span.orange {
  background: orange;
  border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em; 
}   
span.grey {
  background: #cccccc;
  border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #fff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em; 
}   
</style> 

