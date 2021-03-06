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
    $(document).ready(function() {
        /*BASICO*/
        function formularioHide() {
            $('#listaContainer').show();
            $('#formulario').hide()
        }
        function formularioShow() {
            $('#listaContainer').hide();
            $('#formulario').show()
        }
        $("#guardar").button();
        $("#btn_acuerdo_nuevo").button().click(function() {
            $('#frm').submit();
        });
        $("#btn_seleccionar").button().click(function() {
            var gr = jqLista.jqGrid('getGridParam', 'selrow');
            if (gr != null)
                document.location.href = '<?php echo current_url(); ?>/' + jQuery("#lista").jqGrid('getGridParam', 'selrow');
            else
                $('#mensaje2').dialog('open');

        });
        $("#cancelar").button().click(function() {
            document.location.href = '<?php echo base_url(); ?>';
        });
        $('.mensaje').dialog({autoOpen: false, width: 300,
            buttons: {"Ok": function() {
                    $(this).dialog("close");
                }}
        });
        $('#selDepto').change(function() {
            $.ajax({url: '<?php echo base_url('componente2/comp24_E0/getMunicipios') ?>/' + $('#selDepto').val()
            }).done(function(data) {
                $('#mun_id').children().remove();
                $('#mun_id').html(data);
            });
        });
        /**/
        $('#mun_id').change(function() {
            window.location.href = '<?php echo current_url(); ?>/' + $('#mun_id').val();
        });

        /*PARA EL DATEPICKER*/
        $("#cap_fecha_ini").datepicker({
            showOn: 'both',
            //maxDate:    '+1D',
            buttonImage: '<?php echo site_url('resource/imagenes/calendario.png'); ?>',
            buttonImageOnly: true,
            dateFormat: 'dd/mm/yy'
        });
        /*FIN DEL DATEPICKER*/

        /*GRID*/
        $("#miembros").jqGrid({
            url: '<?php echo base_url('componente2/comp22/loadResultados') . '/' . $tabla_id; ?>',
            editurl: '<?php echo base_url('componente2/comp22/gestionResultados'); ?>',
            datatype: 'json',
            altRows: true,
            height: "100%",
            hidegrid: false,
            colNames: ['id', 'Nombres', 'Apellidos', 'Municipalidad', 'Estado', 'Promedio Final', 'Constancia de Finalización', 'Observaciones', 'Acciones'],
            colModel: [
                {name: 'cxp_id', index: 'cxp_id', width: 30, editable: false, editoptions: {size: 15}, hidden: true},
                {name: 'par_nombre', index: 'par_nombre', width: 123, editable: false},
                {name: 'par_apellidos', index: 'par_apellidos', width: 123, editable: false},
                {name: 'par_ins_municipio', index: 'par_ins_municipio', width: 90, editable: false},
                {name: 'cxp_estado', index: 'cxp_estado', width: 100, editable: true, editoptions: {size: 30},
                    edittype: 'text', editoptions:{size: 20, maxlength: 10},
                    editrules: {}},
                {name: 'cxp_promedio', index: 'cxp_promedio', width: 100, editable: true, editoptions: {size: 30},
                    edittype: 'text', editoptions:{size: 20, maxlength: 50},
                    editrules: {}},
                {name: 'cxp_constancia', index: 'cxp_constancia', width: 150, editable: true, editoptions: {size: 30},
                    edittype: 'text', editoptions:{size: 20, maxlength: 200},
                    editrules: {required: true}},
                {name: 'cxp_observaciones', index: 'cxp_observaciones', width: 150, editable: true, editoptions: {size: 30},
                    edittype: 'text', editoptions:{size: 20, maxlength: 200}
                },
                {name: 'actions', formatter: "actions", editable: false, fixed: true, width: 60,
                    formatoptions: {"keys": true, delbutton: false}
                }
            ],
            multiselect: false,
            caption: "Participantes",
            rowNum: 20,
            rowList: [20, 50],
            loadonce: true,
            pager: $('#pagerMiembros'),
            viewrecords: true
        }).hideCol(['id']);
        $("#miembros").jqGrid('navGrid', '#pagerMiembros',
                {edit: false, add: false, del: false, refresh: true, search: true,
                    beforeRefresh: function() {
                        jqLista.jqGrid('setGridParam', {datatype: 'json', loadonce: true}).trigger('reloadGrid');
                    }
                }
        );
        /*desabilitado para activas completar comentario de esta linea y retirar display:none; del elemento */
        var jqLista = $('#lista');
        jqLista.jqGrid({
            url: '<?php echo base_url('componente2/comp22/loadCapacitaciones/'); ?>/', // + $('#mun_id').val(),
            datatype: "json",
            height: "100%",
            colNames: ['Id', 'Proceso', 'Nombre/Tema', 'Fecha'],
            colModel: [
                {name: 'id', index: 'id', width: 55},
                {name: 'cap_proceso', index: 'cap_proceso', width: 150},
                {name: 'cap_nombre', index: 'cap_nombre', width: 200},
                {name: 'cap_fecha', index: 'cap_fecha', width: 100}
            ],
            rowNum: 10,
            rowList: [10, 20, 30],
            pager: '#pagerLista',
            sortname: 'id',
            viewrecords: true,
            sortorder: "desc",
            caption: "Capacitaciones",
            ondblClickRow: function(rowid, iRow, iCol, e) {
                window.location.href = '<?php echo current_url(); ?>/' + rowid;
            }
        }).hideCol(['id']);
        /**/
<?php
//Muestra los dialogos.
if ($this->session->flashdata('message') == 'Ok') {
    echo "$('#efectivo').dialog('open');";
}
if (isset($tabla_id) && $tabla_id > 0) {
    echo "formularioShow();";
} else {
    echo "formularioHide();";
}
?>
    });
</script>

<div id="efectivo" class="mensaje" title="Almacenado" style="display: none;">
    <center>
        <p><img src="<?php echo base_url('resource/imagenes/correct.png'); ?>" class="imagenError" />Almacenado Correctamente</p>
    </center>
</div>

<?php echo form_open('', array('id' => 'frm_acuerdo_municipal2')) ?>

<h2 class="h2Titulos">Capacitaciones</h2>
<h2 class="h2Titulos">Resultados de Procesos de Formación</h2>
<br/>
<div id="rpt_frm_bdy">
    <div id="listaContainer">
        <div id="rpt-border"></div>
        <div style="margin-left: 200px;">
            <table id="lista"></table>
            <div id="pagerLista"></div>
            <br/>
            <div id="btn_seleccionar">Seleccionar</div>
        </div>
    </div>
    <div id="formulario" style="display: none;">
        <div class="campo">
            <label>Capacitación Id:</label>
            <input id="cap_id" name="cap_id" type="text" readonly="readonly" value="<?php echo set_value('cap_id') ?>"/>
            <?php echo form_error('cap_id'); ?>
        </div>
        <div class="campo">
            <label>No. Proceso de Formación:</label>
            <input id="cap_proceso" name="cap_proceso" type="text" readonly="readonly" value="<?php echo set_value('cap_proceso') ?>"/>
            <?php echo form_error('cap_proceso'); ?>
        </div>
        <div class="campo">
            <label>Area de Capacitación o Tema:</label>
            <input id="cap_area" name="cap_area" type="text" readonly="readonly" value="<?php echo set_value('cap_area') ?>"/>
            <?php echo form_error('cap_area'); ?>
        </div>
        <div class="campo">
            <label>Nombre de la Sede:</label>
            <?php
            echo form_dropdown('sed_id', $cap_sede, set_value('sed_id', '0'), ' readonly="readonly"');
            echo form_error('sed_id');
            ?>
        </div>
        <div class="campo">
            <label>Modalidad del proceso:</label>
            <?php
            echo form_dropdown('mod_id', $cap_modalidad, set_value('mod_id', '0'), ' readonly="readonly"');
            echo form_error('mod_id');
            ?>
        </div>
        <div class="campo">
            <label>Nombre del Capacitación:</label>
            <input id="cap_nombre" name="cap_nombre" type="text" readonly="readonly" value="<?php echo set_value('cap_nombre') ?>"/>
            <?php echo form_error('cap_nombre'); ?>
        </div>
        <div class="campo">
            <label>Entidad Capacitadora:</label>
            <input id="cap_entidad" name="cap_entidad" type="text" readonly="readonly" value="<?php echo set_value('cap_entidad') ?>"/>
            <?php echo form_error('cap_entidad'); ?>
        </div>
        <div class="campo">
            <label>Nivel al que va dirigido:</label>
            <?php
            $cap_nivel = array(
                '0' => 'Seleccione',
                'Dirección' => 'Dirección',
                'Administrativo' => 'Administrativo',
                'Técnico' => 'Técnico',
                'Operativo' => 'Operativo',
            );
            echo form_dropdown('cap_nivel', $cap_nivel, set_value('cap_nivel', '0'), ' readonly="readonly"');
            echo form_error('cap_nivel');
            ?>
        </div>
        <div class="campo">
            <label>Nombre del Facilitador:</label>
            <input id="cap_facilitador" name="cap_facilitador" type="text" readonly="readonly" value="<?php echo set_value('cap_facilitador') ?>"/>
            <?php echo form_error('cap_facilitador'); ?>
        </div>
        <div class="campo">
            <label>Fecha de Inicio:</label>
            <input id="cap_fecha_ini" name="cap_fecha_ini" type="text" readonly="readonly" value="<?php echo set_value('cap_fecha_ini') ?>"/>
        </div>
        <div class="campo">
            <label>Duración:</label>
            <input id="cap_duracion" name="cap_duracion" type="text" readonly="readonly" value="<?php echo set_value('cap_duracion') ?>" style="width: 145px;"/>
            <?php
            $cap_duracion = array(
                '0' => 'Seleccione',
                'Años' => 'Años',
                'Meses' => 'Meses',
                'Semanas' => 'Semanas',
                'Días' => 'Días',
                'Horas' => 'Horas'
            );
            echo form_dropdown('cap_duracion_tipo', $cap_duracion, set_value('cap_duracion_tipo', '0'), ' readonly="readonly" style="width: 100px;"');
            echo form_error('cap_duracion');
            ?>
        </div>
        <div class="campo">
            <label>Descripción:</label>
            <textarea id="cap_descripcion" name="cap_descripcion" cols="30" rows="5" wrap="virtual" readonly="readonly" maxlength="100"><?php echo set_value('cap_descripcion') ?></textarea>
            <?php echo form_error('cap_descripcion'); ?>
        </div>
        <div id="actions" style="position: relative;top: 20px">
            <input type="button" id="cancelar" value="Regresar" />
        </div>
        <input type="hidden" value="modificado" name="mod" id="mod" />
        <div style="position: relative;right: 20px;top: 30px;">
            <label></label>
            <table id="miembros"></table>
            <div id="pagerMiembros"></div>
        </div>
    </div>
</div>
<div id="mensaje2" class="mensaje" title="Aviso">
    <p>Debe Seleccionar una fila para continuar</p>
</div>
<?php
echo form_close();
$this->load->view('plantilla/footer');
?>