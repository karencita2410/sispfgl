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
            $('#frm').submit();
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
                
        /*PARA EL DATEPICKER*/
        $( "#ind_des_fecha" ).datepicker({
            showOn:         'both',
            maxDate:        '+1D',
            buttonImage:    '<?php echo site_url('resource/imagenes/calendario.png'); ?>',
            buttonImageOnly: true, 
            dateFormat: 'dd/mm/yy'
        });
        /*FIN DEL DATEPICKER*/
               
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
        
        /* Calculos */
        $('.txtInput').change(function(){
            cambios();
        });
        
        function formularioHide(){
            $('#listaContainer').show();
            $('#formulario').hide()
        }
        
        function formularioShow(){
            $('#listaContainer').hide();
            $('#formulario').show()
        }
        
        function cambios(){
            var t;
            $('#ind_des_grupo1_total').val(function(){if(isFinite(t=parseFloat($('#ind_des_grupo1_ingtotpre').val())-parseFloat($('#ind_des_grupo1_gastotdev').val()))){return t;}else{return'';}});
            $('#ind_des_grupo2_total').val(function(){if(isFinite(t=parseFloat($('#ind_des_grupo2_ingprodev').val())/parseFloat($('#ind_des_grupo2_totingdev').val()))){return t;}else{return'';}});
            $('#ind_des_grupo3_total').val(function(){if(isFinite(t=parseFloat($('#ind_des_grupo3_moningpro').val())/parseFloat($('#ind_des_grupo3_totingdev').val()))){return t;}else{return'';}});
            $('#ind_des_grupo4_total').val(function(){if(isFinite(t=parseFloat($('#ind_des_grupo4_moningpro').val())/parseFloat($('#ind_des_grupo4_moningpre').val()))){return t;}else{return'';}});
            $('#ind_des_grupo5_total').val(function(){if(isFinite(t=parseFloat($('#ind_des_grupo5_totingtas').val())/parseFloat($('#ind_des_grupo5_totingpro').val()))){return t;}else{return'';}});
            $('#ind_des_grupo6_total').val(function(){if(isFinite(t=parseFloat($('#ind_des_grupo6_totingimp').val())/parseFloat($('#ind_des_grupo6_totingpro').val()))){return t;}else{return'';}});
        }
 
        
        <?php
        //echo '//'.$this->session->keep_flashdata('message');
        if($this->session->flashdata('message')=='Ok'){
            echo "$('#efectivo').dialog('open');";
        }
        if(isset($ind_des_id) && $ind_des_id > 0){
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
    <h2 class="h2Titulos">Indicadores de Desempeno Administrativo y Financiero Municipal</h2>
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
                <label>Fecha:</label>
                <input id="ind_des_fecha" name="ind_des_fecha" type="text" readonly="readonly" value="<?php echo set_value('ind_des_fecha') ?>"/>
                <?php echo form_error('ind_des_fecha'); ?>
            </div>
            <div class="campo">
                <label>Periodo</label>
                <span>Del </span>
                <input id="ind_des_periodo_inicio" name="ind_des_periodo_inicio" type="text" value="<?php echo set_value('ind_des_periodo_inicio') ?>" style="width: 100px;"/>
                <?php echo form_error('ind_des_periodo_inicio'); ?>
                <span>Al</span>
                <input id="ind_des_periodo_fin" name="ind_des_periodo_fin" type="text" value="<?php echo set_value('ind_des_periodo_fin') ?>" style="width: 100px;"/>
                <?php echo form_error('ind_des_periodo_fin'); ?>
            </div>
            <hr />
            <div id="rpt-border"></div>
        
            <div class="bigCampo">
                <label>Resultado Presupuestario</label>
                <div class="comment">Determina el comportamiento de la ejecucion</div>
                 <div class="bdy">
                    <div class="frm">
                        <div class="hdr">Resultado Presupuestario</div>
                        <div class="igual">=</div>
                        <div class="col">
                            <div class="row">
                                <span>Ingresos Totales Precibidos</span>
                                <input class="txtInput" id="ind_des_grupo1_ingtotpre" name="ind_des_grupo1_ingtotpre" value="<?php echo set_value('ind_des_grupo1_ingtotpre'); ?>" />
                                <?php echo form_error('ind_des_grupo1_ingtotpre'); ?>
                                <span>- Gastos Totales Devengados</span>
                                <input class="txtInput" id="ind_des_grupo1_gastotdev" name="ind_des_grupo1_gastotdev" value="<?php echo set_value('ind_des_grupo1_gastotdev'); ?>" />
                                <?php echo form_error('ind_des_grupo1_gastotdev'); ?>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="result centrar">
                    <div class="hdr">Resultado Presupuestario</div>
                    <input id="ind_des_grupo1_total" name="ind_des_grupo1_total" type="text" size="100" value="<?php echo set_value('ind_des_grupo1_total'); ?>" />
                                <?php echo form_error('ind_des_grupo1_total'); ?>
                 </div>
            </div>
            
            <div class="bigCampo">
                <label>Autonomia Financiera</label>
                <div class="comment">Mide el valor de dinero comprometido con relacion a cada dolar disponible,
                el resultado no debera ser mayor que 1.70, (Art. 5 de la Ley de Endeudamiento Publico Municipal)
                y se concidera aceptable, si cada vez que se determine el indicador, este resulta ser un valor
                decreciente y menor que 1.70.</div>
                 <div class="bdy">
                    <div class="frm">
                        <div class="hdr">Autonomia Financiera</div>
                        <div class="igual">=</div>
                        <div class="col">
                            <div class="row">
                                <span>Ingresos Propios Devengados</span>
                                <input class="txtInput" id="ind_des_grupo2_ingprodev" name="ind_des_grupo2_ingprodev" value="<?php echo set_value('ind_des_grupo2_ingprodev'); ?>" />
                                <?php echo form_error('ind_des_grupo2_ingprodev'); ?>
                            </div>
                            <hr />
                            <div class="row">
                                <span>Total de Ingresos Devengados</span>
                                <input class="txtInput" id="ind_des_grupo2_totingdev" name="ind_des_grupo2_totingdev" value="<?php echo set_value('ind_des_grupo2_totingdev'); ?>" />
                                <?php echo form_error('ind_des_grupo2_totingdev'); ?>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="result centrar">
                    <div class="hdr">Autonomia Financiera</div>
                    <input id="ind_des_grupo2_total" name="ind_des_grupo2_total" type="text" size="100" value="<?php echo set_value('ind_des_grupo2_total'); ?>" />
                                <?php echo form_error('ind_des_grupo2_total'); ?>
                 </div>
            </div>
            
            <div class="bigCampo">
                <label>Eficacia en la Recaudacion</label>
                <div class="comment">Mide el valor de dinero comprometido con relacion a cada dolar disponible,
                el resultado no debera ser mayor que 1.70, (Art. 5 de la Ley de Endeudamiento Publico Municipal)
                y se concidera aceptable, si cada vez que se determine el indicador, este resulta ser un valor
                decreciente y menor que 1.70.</div>
                 <div class="bdy">
                    <div class="frm">
                        <div class="hdr">Eficacia en la Recaudacion</div>
                        <div class="igual">=</div>
                        <div class="col">
                            <div class="row">
                                <span>Monto de Ingresos Propios Percibidos en el Ano de Impuestos y Tasas de Credito</span>
                                <input class="txtInput" id="ind_des_grupo3_moningpro" name="ind_des_grupo3_moningpro" value="<?php echo set_value('ind_des_grupo3_moningpro'); ?>" />
                                <?php echo form_error('ind_des_grupo3_moningpro'); ?>
                            </div>
                            <hr />
                            <div class="row">
                                <span>Total de Ingresos Devengados</span>
                                <input class="txtInput" id="ind_des_grupo3_totingdev" name="ind_des_grupo3_totingdev" value="<?php echo set_value('ind_des_grupo3_totingdev'); ?>" />
                                <?php echo form_error('ind_des_grupo3_totingdev'); ?>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="result centrar">
                    <div class="hdr">Eficacia en la Recaudacion</div>
                    <input id="ind_des_grupo3_total" name="ind_des_grupo3_total" type="text" size="100" value="<?php echo set_value('ind_des_grupo3_total'); ?>" />
                                <?php echo form_error('ind_des_grupo3_total'); ?>
                 </div>
            </div>
            
            <div class="bigCampo">
                <label>Eficacia en la Ejecucion Presupuestaria de Ingresos Propiedades Percibidos (Eficacia en la Ejecucion)</label>
                <div class="comment">Mide el grado de alcance de la meta propuesta. Este indicador permite establecer la brecha
                existente entre el monto fijado (presupuestado) y lo realmente ejecutado o recaudado. 
                <span style="color: red;">Entre mas se acerque a 100, mejor el indicador de eficiacia en la presupuestacion de ingresos.</span></div>
                 <div class="bdy">
                    <div class="frm">
                        <div class="hdr">Eficacia en la Ejecucion</div>
                        <div class="igual">=</div>
                        <div class="col">
                            <div class="row">
                                <span>Monto de Ingresos Propios Percibidos en el Ano</span>
                                <input class="txtInput" id="ind_des_grupo4_moningpro" name="ind_des_grupo4_moningpro" value="<?php echo set_value('ind_des_grupo4_moningpro'); ?>" />
                                <?php echo form_error('ind_des_grupo4_moningpro'); ?>
                            </div>
                            <hr />
                            <div class="row">
                                <span>Monto de ingresos Propios Presupuestado</span>
                                <input class="txtInput" id="ind_des_grupo4_moningpre" name="ind_des_grupo4_moningpre" value="<?php echo set_value('ind_des_grupo4_moningpre'); ?>" />
                                <?php echo form_error('ind_des_grupo4_moningpre'); ?>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="result centrar">
                    <div class="hdr">Eficacia en la Ejecucion</div>
                    <input id="ind_des_grupo4_total" name="ind_des_grupo4_total" type="text" size="100" value="<?php echo set_value('ind_des_grupo4_total'); ?>" />
                                <?php echo form_error('ind_des_grupo4_total'); ?>
                 </div>
            </div>
            
            <div class="bigCampo">
                <label>Participacion de Ingresos por Tasas</label>
                <div class="comment">Determinar la participacion relativa de las tasas dentro de la estructura
                de los ingresos propios percibidos.</div>
                 <div class="bdy">
                    <div class="frm">
                        <div class="hdr">Participacion de Ingresos por Tasas</div>
                        <div class="igual">=</div>
                        <div class="col">
                            <div class="row">
                                <span>Total de Ingresos por Tasas Percibidos</span>
                                <input class="txtInput" id="ind_des_grupo5_totingtas" name="ind_des_grupo5_totingtas" value="<?php echo set_value('ind_des_grupo5_totingtas'); ?>" />
                                <?php echo form_error('ind_des_grupo5_totingtas'); ?>
                            </div>
                            <hr />
                            <div class="row">
                                <span>Total de Ingresos Propios Percibidos</span>
                                <input class="txtInput" id="ind_des_grupo5_totingpro" name="ind_des_grupo5_totingpro" value="<?php echo set_value('ind_des_grupo5_totingpro'); ?>" />
                                <?php echo form_error('ind_des_grupo5_totingpro'); ?>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="result centrar">
                    <div class="hdr">Participacion de Ingresos por Tasas</div>
                    <input id="ind_des_grupo5_total" name="ind_des_grupo5_total" type="text" size="100" value="<?php echo set_value('ind_des_grupo5_total'); ?>" />
                                <?php echo form_error('ind_des_grupo5_total'); ?>
                 </div>
            </div>
            
            <div class="bigCampo">
                <label>Participacion de Ingresos por Impuestos</label>
                <div class="comment">Determinar la participacion relativa de las Impuestos dentro de la estructura
                de los ingresos propios percibidos.</div>
                 <div class="bdy">
                    <div class="frm">
                        <div class="hdr">Participacion de Ingresos por Impuestos</div>
                        <div class="igual">=</div>
                        <div class="col">
                            <div class="row">
                                <span>Total de Ingresos por Impuestos Percibidos</span>
                                <input class="txtInput" id="ind_des_grupo6_totingimp" name="ind_des_grupo6_totingimp" value="<?php echo set_value('ind_des_grupo6_totingimp'); ?>" />
                                <?php echo form_error('ind_des_grupo6_totingimp'); ?>
                            </div>
                            <hr />
                            <div class="row">
                                <span>Total de Ingresos Propios Percibidos</span>
                                <input class="txtInput" id="ind_des_grupo6_totingpro" name="ind_des_grupo6_totingpro" value="<?php echo set_value('ind_des_grupo6_totingpro'); ?>" />
                                <?php echo form_error('ind_des_grupo6_totingpro'); ?>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="result centrar">
                    <div class="hdr">Participacion de Ingresos por Impuestos</div>
                    <input id="ind_des_grupo6_total" name="ind_des_grupo6_total" type="text" size="100" value="<?php echo set_value('ind_des_grupo6_total'); ?>" />
                                <?php echo form_error('ind_des_grupo6_total'); ?>
                 </div>
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