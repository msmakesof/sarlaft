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
                                <select class="form-control" id="TipoRiesgo" name="TipoRiesgo" required style="font-size: 9px">
                                <option value="">-</option>
                                <option value="LA">LA</option>
                                <option value="FT">FT</option>
                                <option value="PAM">PAM</option>
                                </select>
                            </td>
                            <td class='text-left'>
                                <select class="form-control" id="FuenteRiesgoA" name="FuenteRiesgoA" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>                                
                            </td>
                            <td class='text-left'>
                                <select class="form-control" id="FuenteRiesgoB" name="FuenteRiesgoB" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>                                
                            </td>
                            <td class='text-left'>
                                <select class="form-control" id="FuenteRiesgoC" name="FuenteRiesgoC" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>                               
                            </td>
                            <td class='text-left'>
                                <select class="form-control" id="FuenteRiesgoD" name="FuenteRiesgoD" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>                               
                            </td>
                            <td class='text-left'>
                                <select class="form-control" id="FuenteRiesgoE" name="FuenteRiesgoE" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>                               
                            </td>
                            <td class='text-left'>
                                <select class="form-control" id="FuenteRiesgoF" name="FuenteRiesgoF" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>                               
                            </td>
                            <td class='text-center'>
                                <select class="form-control" id="FuenteRiesgoG" name="FuenteRiesgoG" required style="font-size: 9px">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                                </select>                                
                            </td>
                        </tr>           
            </table>
        </div>