<?php

/**
 * 
 * 
 * @author Alexis Beltran
 */

$this->load->view('plantilla/header', $titulo);
$this->load->view('plantilla/menu', $menu);

?>
<script type="text/javascript">        
    $(document).ready(function(){
        
        /*VARIABLES*/
 
       
        $("#guardar").button();
        
        $("#btn_acuerdo_nuevo").button().click(function(){
            $('#frm_acuerdo_municipal2').submit();
        });
        
        $("#cancelar").button().click(function() {
            document.location.href='<?php echo base_url(); ?>';
        });
        
        	/*CARGAR MUNICIPIOS*/
        $('#selDepto').change(function(){   
            //$("#guardar").hide();
            $('#mun_id').children().remove();
            $.getJSON('<?php echo base_url('componente2/proyectoPep/cargarMunicipios') ?>?dep_id='+$('#selDepto').val(), 
            function(data) {
                var i=0;
                $.each(data, function(key, val) {
                    if(key=='rows'){
                        $('#mun_id').append('<option value="0">--Seleccione Municipio--</option>');
                        $.each(val, function(id, registro){
                            var text = '<option ';
                            if(registro['cell'][0]=='<?php echo set_value('mun_id'); ?>'){
                                text = text + 'selected="" ';
                            }
                            text = text + 'value="'+registro['cell'][0]+'">'+registro['cell'][1]+'</option>'
                            $('#mun_id').append(text);
                        });                    
                    }
                });
            });              
        });
        $('#mun_id').change(function(){
            window.location.href = '<?php echo current_url(); ?>/' + $('#mun_id').val();
            $('#Mensajito').hide();
            $("#guardar").show();              
        });
        $('.txtInput').change(function(){
            cambios();
        });
               
        /*DIALOGOS DE VALIDACION*/
        $('.mensaje').dialog({
            autoOpen: false,
            width: 300,
            buttons: {
                "Ok": function() {
                    $(this).dialog("close");
                }
            }
        });
 
        /*FIN DIALOGOS VALIDACION*/
        
        function formularioHide(){
            $('#listaContainer').show();
            $('#formulario').hide()
        }
        
        function formularioShow(){
            $('#listaContainer').hide();
            $('#formulario').show()
        }
        
        function cambios(){
            $('#per_mun_poblacion').val(function(){
                var t;
                if(isFinite(t=parseInt($('#per_mun_urbana_hombres').val())+parseInt($('#per_mun_urbana_mujeres').val())+parseInt($('#per_mun_rural_hombres').val())+parseInt($('#per_mun_rural_mujeres').val()))){
                    return t;
                }else{
                    return '';
                }
            });
        }
 
        
        <?php
        //echo '//'.$this->session->keep_flashdata('message');
        if($this->session->flashdata('message')=='Ok'){
            echo "$('#efectivo').dialog('open');";
        }
        if(isset($mun_id) && $mun_id > 0){
            echo "formularioShow();cambios();";
        }else{
            echo "formularioHide();";
        }
        ?>
  
    });
</script>

<div id="efectivo" class="mensaje" title="Almacenado">
    <center>
        <p><img src="<?php echo base_url('resource/imagenes/correct.png'); ?>" class="imagenError" />Almacenado Correctamente</p>
    </center>
</div>
<?php echo form_open() ?>

    <h2 class="h2Titulos">Etapa 0: Condiciones Previas</h2>
    <h2 class="h2Titulos">Perfil del Municipio</h2>
    <br/>
    <div id="rpt_frm_bdy">
        <div id="listaContainer">
            <div class="campo">
                <label>Departamento</label>
                <select id='selDepto'>
                    <option value='0'>--Seleccione--</option>
                    <?php foreach ($departamentos as $depto) { ?>
                    <option value='<?php echo $depto->dep_id; ?>'><?php echo $depto->dep_nombre; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="campo">
                <label>Municipio</label>
                <select id='mun_id' name='mun_id'>
                    <option value='0'>--Seleccione--</option>
                </select>
                <?php echo form_error('mun_id'); ?>
            </div>
            <div id="rpt-border"></div>
        </div>
        <div id="formulario" style="display: none;">
            <div class="campo">
                <label>Departamento:</label>
                <input id="depto" name="depto" type="text" readonly="readonly" value="<?php echo set_value('depto') ?>" />
            </div>
            <div class="campo">
                <label>Municipio:</label>
                <input id="muni" name="muni" type="text" readonly="readonly" value="<?php echo set_value('muni') ?>" />
            </div>
            <div class="campo">
                <label>Partido Politico Gobernante</label>
                <input id="per_mun_partido" name="per_mun_partido" type="text" value="<?php echo set_value('per_mun_partido') ?>" />
                <?php echo form_error('per_mun_partido'); ?>
            </div>
            
            <div class="campo">
                <label>Extencion territorial en  KMS<sup>2</sup></label>
                <input id="per_mun_territorio" name="per_mun_territorio" type="text" style="width: 241px; text-align: right; padding-right: 10px;" value="<?php echo set_value('per_mun_territorio') ?>" />
                <?php echo form_error('per_mun_territorio'); ?>
            </div>
            
            <div class="campo">
                <label>Tipologia</label>
                <select id='per_mun_tipologia'>
                    <option value='0'>--Seleccione--</option>
                </select>
                <?php echo form_error('per_mun_tipologia'); ?>
            </div>
            
            <div class="campo">
                <label>Poblacion</label>
                <table>
                <tr>
                	<td></td>
                	<td style="text-align: center;">Hombres</td>
                	<td style="text-align: center;">Mujeres</td>
                </tr>
                <tr>
                	<td>Urbana</td>
                	<td><input class="txtInput" id="per_mun_urbana_hombres" name="per_mun_urbana_hombres" type="text" style="width: 90px; text-align: right; padding-right: 10px;" value="<?php echo set_value('per_mun_urbana_hombres') ?>" />
                        <?php echo form_error('per_mun_urbana_hombres'); ?></td>
                	<td><input class="txtInput" id="per_mun_urbana_mujeres" name="per_mun_urbana_mujeres" type="text" style="width: 90px; text-align: right; padding-right: 10px;" value="<?php echo set_value('per_mun_urbana_mujeres') ?>" />
                        <?php echo form_error('per_mun_urbana_mujeres'); ?></td>
                </tr>
                <tr>
                	<td>Rural</td>
                	<td><input class="txtInput" id="per_mun_rural_hombres" name="per_mun_rural_hombres" type="text" style="width: 90px; text-align: right; padding-right: 10px;" value="<?php echo set_value('per_mun_rural_hombres') ?>" />
                        <?php echo form_error('per_mun_rural_hombres'); ?></td>
                	<td><input class="txtInput" id="per_mun_rural_mujeres" name="per_mun_rural_mujeres" type="text" style="width: 90px; text-align: right; padding-right: 10px;" value="<?php echo set_value('per_mun_rural_mujeres') ?>" />
                        <?php echo form_error('per_mun_rural_mujeres'); ?></td>
                </tr>
                <tr>
                	<td>Total de Poblacion</td>
                	<td colspan="2"><input class="txtInput" id="per_mun_poblacion" name="per_mun_poblacion" type="text" style="width: 150px; text-align: center;" readonly="readonly" value="<?php echo set_value('per_mun_poblacion') ?>" /></td>
                </tr>
                </table>
            </div>
                   
            <div style="width: 100%;">
                <div style="width: 50%;">
                    <div class="campo">
                        <label>Observaciones</label>
                        <textarea cols="30" rows="5" wrap="virtual" maxlength="100"></textarea>
                    </div>
                </div>
                <div style="width: 50%;">
                    
                </div>
            </div>
            
            <div id="actions" style="position: relative;top: 20px">
                <input type="submit" id="guardar" value="Guardar" />
                <input type="button" id="cancelar" value="Cancelar" />
            </div>
            <input type="hidden" value="modificado" name="mod" id="mod" />
        </div>
    </div>
<?php echo form_close();
$this->load->view('plantilla/footer'); ?>