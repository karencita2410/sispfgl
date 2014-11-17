<script type="text/javascript">        
   $(document).ready(function(){
       
        $("#guardar").button().click(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url('componente2/componente21/guardar_cc') ?>',
                data: $("#generalesEtm").serialize(), // serializes the form's elements.
                success: function(data)
                {
                    $('#efectivo').dialog('open');
                }
            });
            return false;
        });
       
       
       
       
	   $( "#fecha_convocatoria" ).datepicker({
           showOn: 'both',
           buttonImage: '<?php echo site_url('resource/imagenes/calendario.png'); ?>',
           buttonImageOnly: true, 
           dateFormat: 'yy/mm/dd',
           minDate: (new Date(2013, 0, 1))
       });
       
       $( "#fecha_con" ).datepicker({
           showOn: 'both',
           buttonImage: '<?php echo site_url('resource/imagenes/calendario.png'); ?>',
           buttonImageOnly: true, 
           dateFormat: 'yy/mm/dd',
           minDate: (new Date(2013, 0, 1))
       });
       
       $( "#fecha_equi" ).datepicker({
           showOn: 'both',
           buttonImage: '<?php echo site_url('resource/imagenes/calendario.png'); ?>',
           buttonImageOnly: true, 
           dateFormat: 'yy/mm/dd',
           minDate: (new Date(2013, 0, 1))
       });
       
       $('.mensaje').dialog({
            autoOpen: false,
            width: 300,
            buttons: {
                "Ok": function() {
                    $(this).dialog("close");
                }
            }
        });
		
	
        
        /*CARGAR MUNICIPIOS*/
        $('#selDepto').change(function(){   
            $('#mun_id').children().remove();
            $.getJSON('<?php echo base_url('componente3/componente3/cargarMunicipios');?>'+'?dep_id='+$('#selDepto').val(), 
            function(data) {
                var i=0;
                $.each(data, function(key, val) {
                    if(key=='rows'){
                        $('#mun_id').append('<option value="0">--Seleccione Municipio--</option>');
                        $.each(val, function(id, registro){
                            $('#mun_id').append('<option value="'+registro['cell'][0]+'">'+registro['cell'][1]+'</option>');
                        });                    
                    }
                });
            });              
        });
        
        $('#mun_id').change(function() {
        $("#cc_lugar").val('');
        $("#total_mujeres").val('');
        $("#total_hombres").val('');
        $("#listado_asistencia").val('');
        $("#acta_final").val('');
        $("#cc_fecha").val('');
        $('input:checkbox').removeAttr('checked');
        $("#cc_id").val('');
        var id_mun=$('#mun_id').val();
//        $('input[type="submit"]').attr('disabled','disabled')
        if(id_mun !=0){
        $.getJSON('<?php echo base_url('componente2/componente21/cargar_cc') . "/" ?>' + id_mun,
        function(data) {
              $("#cc_lugar").val(data.cc_lugar);
              $("#total_mujeres").val(data.total_mujeres);
              $("#total_hombres").val(data.total_hombres);
              $("#cc_id").val(data.cc_id);
              $("#cc_fecha").val(data.cc_fecha);
              $("#acta_final").val(data.acta_final);
              $("#listado_asistencia").val(data.listado_asistencia);
             
              if (data.anexo8 )
                $('input:checkbox[name=anexo8]').attr("checked", "checked");
              else
                $('input:checkbox[name=anexo8]').attr("checked", false);
                                
              
              $("#Proyectos").setGridParam({
                  url:'<?php echo base_url('componente2/componente21/cargar_etm_asis')."/" ?>'+$('#cc_id').val(),
                  editurl:'<?php echo base_url('componente2/componente21/modificar_etm_asis')."/" ?>'+$('#cc_id').val(),
                  datatype:'json'
                  }).trigger('reloadGrid');
               
             })               
          }
          
 });
        
        /*suma de totales*/
        $('#total_mujeres').change(function(){   
            var m = $('#total_mujeres').val();
            var h = $('#total_hombres').val();
            var total = 0;
            if(!isNumber(m) || m % 1 != 0 || m<0){
					$('#mensaje5').dialog('open');
					$('#total_mujeres').val("0");
					return false;
			}
			else{
				if(h=="")
					total=parseFloat(m);
				else
					total=parseFloat(m)+parseFloat(h);
				$('#total').val(""+total);
			}
			             
        });
        
        $('#total_hombres').change(function(){   
            var m = $('#total_mujeres').val();
            var h = $('#total_hombres').val();
            var total = 0;
            if(!isNumber(h) || h % 1 != 0 || h<0){
					$('#mensaje6').dialog('open');
					$('#total_hombres').val("0");
					return false;
			}
			else{
				if(m=="")
					total=parseFloat(h);
				else
					total=parseFloat(m)+parseFloat(h);
				$('#total').val(""+total);
			}
			             
        });
        /*botones*/
        
       
       /*Grid Capacitaciones*/
       
       var tabla1=$("#Proyectos");
        tabla1.jqGrid({
            //url:'<?php echo base_url('componente2/componente24a/cargar_capacitaciones') ?>',
            //editurl: '<?php echo base_url('componente3/componente3/guardar_divu') ?>',
            datatype:'clientSide',
            altRows:true,
            height: "100%",
            hidegrid: false,
            colNames:['id','Nombre del Proyecto','Comunidades Beneficiadas','Ubicación','Tipo Proyecto'],
            colModel:[
                {name:'id',index:'id', width:40,editable:false,editoptions:{size:15} },
                {name:'nombre_proy',index:'nombre_proy',width:200,editable:true,
                    editoptions:{size:50,maxlength:250}, 
                    formoptions:{label: "Nombre del Proyecto",elmprefix:"(*)"},
                    editrules:{required:true} 
                },
                {name:'com_beneficiadas',index:'com_beneficiadas',editable:true,width:230,
                    editoptions:{ size:50,maxlength:250 }, 
                    formoptions:{ label: "Comunidades Beneficiadas",elmprefix:"(*)"},
                    editrules:{required:true}
                },
                {name:'ubicacion',index:'ubicacion',width:140,editable:true,
                    editoptions:{size:50,maxlength:250}, 
                    formoptions:{ label: "Poblacion Beneficiada",elmprefix:"(*)"},
                    editrules:{required:true} 
                },
                {name:'tipo_proy',index:'tipo_proy',editable:true,width:90,
                    editoptions:{ size:25,maxlength:20 }, 
                    formoptions:{ label: "Tipo Proyecto",elmprefix:"(*)"},
                    editrules:{required:true}
                }
            ],
            multiselect: false,
            caption: "Proyectos",
            rowNum:10,
            rowList:[10,20,30],
            loadonce:true,
            pager: jQuery('#pagerProyectos'),
            viewrecords: true
        }).jqGrid('navGrid','#pagerProyectos',
        {edit:true,add:true,del:true,search:false,refresh:false, beforeRefresh: function() {
                tabla1.jqGrid('setGridParam', {datatype: 'json', loadonce: true}).trigger('reloadGrid');
            }
        }, //OPCIONES
        {closeAfterEdit: true, editCaption: "Editando las personas del ETM", width: 700,
            align: 'center', reloadAfterSubmit: true,
            processData: "Cargando...", afterSubmit: despuesAgregarEditar,
            bottominfo: "Campos marcados con (*) son obligatorios",
            onclickSubmit: function(rp_ge, postdata) {
                $('#mensaje').dialog('open');
            }
        }, //EDITAR
        {closeAfterAdd: true, addCaption: "Agregar personas al ETM", width: 700,
            align: 'center', reloadAfterSubmit: true,
            processData: "Cargando...", afterSubmit: despuesAgregarEditar,
            bottominfo: "Campos marcados con (*) son obligatorios",
            onclickSubmit: function(rp_ge, postdata) {
                $('#mensaje').dialog('open');
            }
        }, //AGREGAR
        {msg: "¿Desea Eliminar a esta persona?", caption: "Eliminando....",
            align: 'center', reloadAfterSubmit: true, processData: "Cargando...", width: 300,
            onclickSubmit: function(rp_ge, postdata) {
                $('#mensaje').dialog('open');
            }
        }//ELIMINAR
    ).hideCol('id').hideCol('id');
    
        function despuesAgregarEditar() {
            tabla1.jqGrid('setGridParam',{datatype:'json',loadonce:true}).trigger('reloadGrid');
            return[true,'']; //no error
        }
        
         function isNumber(n) {
			return !isNaN(parseFloat(n)) && isFinite(n);
		}
		
		
});
   
</script>
<?php 
	$this->load->helper('form');
	include("select_generator.php");  
?>
<?php if(isset($aviso))
	echo $aviso;?>
<h1>Consulta Ciudadana</h1>
<br/>
<?php $attributes = array('id' => 'myform');
echo form_open_multipart('componente2/componente21/guardar_cc',$attributes);?>
	
	<label>Departamento: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
	<?php echo form_dropdown_from_db('dep_id','selDepto' ,"SELECT dep_id,dep_nombre FROM departamento");?>
	<br/><br/>
		
	<label>Nombre del Municipio: </label>&nbsp;
	<select id='mun_id' name='mun_id'>
                <option value='0'>--Seleccione--</option>
    </select>
    <br/><br/>
    
    
	
		
	<label>Lugar: </label>
	<input type="text" name="cc_lugar" id="cc_lugar"  size="85">
	<br/><br/>
	
	<label>Fecha de Realización: </label>
	<input readonly="readonly"  type="text" name="cc_fecha" id="cc_fecha"  size="8">
	<input type="checkbox" name="anexo8" id="anexo8"/>Posee el anexo 8
	
	<br/><br/>
	
	<table id="Proyectos"></table>
	<div id="pagerProyectos"></div>
	<br/><br/>
	
	<div style="float:left;height:200px;width:330px;">
		&nbsp;&nbsp;&nbsp;&nbsp;<label>Registro de Asistencia a la CC: </label>
		<br/><br/>
		
		<label>Total de Mujeres: &nbsp;</label>
		<input type="text" name="total_mujeres" id="total_mujeres"  size="3" ><br/><br/>
		
		<label>Total de Hombres: </label>
		<input type="text" name="total_hombres" id="total_hombres"  size="3" ><br/><br/>
		
		<label>Total: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input readonly="readonly" type="text" name="total" id="total"  size="1"><br/><br/>
	</div>
	
	<div style="float:left;height:200px;">
		&nbsp;&nbsp;&nbsp;&nbsp;<label>Archivos: </label>
		
        <table>
        <tr>
        <td><div id="btn_per_subir"></div></td>
        <td><input class="letraazul" type="text" id="per_pro_per" readonly="readonly" value="Subir Acta de CC" size="30" readonly="readonly" style="border: none"/></td>
        <td class="tdEspacio"></td>
        <td><div id="btn_tdr_subir"></div></td>
        <td><input class="letraazul" type="text" id="per_pro_tdr" readonly="readonly" value="Subir Listado Asistencia" size="30" readonly="readonly" style="border: none"/></td>
        </tr>
        <tr>
                     
        <td><a id="btn_per_descargar" name="btn_per_descargar" target="_blank" value="<?php echo set_value ('per_pro_per_ruta_archivo')?>" > <img src='<?php echo base_url('resource/imagenes/download.png'); ?>'/></a></td>
        <td><input class="letraazul" type="text" id="per_pro_perD" readonly="readonly" value="No hay acta CC para descargar" size="30" style="border: none"/></td>
        <td class="tdEspacio"></td>
        <td><a id="btn_tdr_descargar" value="<?php echo set_value ('per_pro_tdr_ruta_archivo')?>"><img src='<?php echo base_url('resource/imagenes/download.png'); ?>'/></a></td>
        <td><input class="letraazul" type="text" id="per_pro_tdrD" readonly="readonly" value="No hay Listado Asistencia para descargar" size="30" style="border: none"/></td>
        </tr>
                
                </table>        
                
		<label>Acta de CC: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="file" id="acta_final" name="acta_final" size="20" /><br/><br/>
		
		<label>Listado de Asistencia: </label>
		<input type="file" id="listado_asisistencia" name="listado_asisistencia" size="20" /><br/><br/>
		
		<input type="submit" id="guarda" name="guarda" value="Guardar" align="right">
                <input type="hidden" name="cc_id" id="cc_id" value="0" size="5" maxlength="5" >
	</div>
	
	<div id="divpost" ></div>
<?php echo form_close();?>
<div id="mensaje" class="mensaje" title="Aviso">
    <p>Ok.</p>
</div>
<div id="mensaje1" class="mensaje" title="Aviso">
    <p>Debe Seleccionar una fila para realizar esta acci&oacute;n.</p>
</div>
<div id="mensaje2" class="mensaje" title="Aviso">
    <p>Debe completar los datos de la actividad para continuar.</p>
</div>
<div id="mensaje3" class="mensaje" title="Aviso">
    <p>No ha ingresado ninguna actividad.</p>
</div>
<div id="mensaje4" class="mensaje" title="Aviso">
    <p>Debe completar los datos de la persona para continuar.</p>
</div>
<div id="mensaje5" class="mensaje" title="Aviso">
    <p>La cantidad de mujeres no es valida.</p>
</div>
<div id="mensaje6" class="mensaje" title="Aviso">
    <p>La cantidad de hombres no es valida.-</p>
</div>
<div id="mensaje7" class="mensaje" title="Aviso">
    <p>La hora instroducida no es valida. Por favor utilice el formato [hh:mm], donde hh=horas y mm=minutos (dentro del rango valido).-</p>
</div>
<div id="mensaje8" class="mensaje" title="Aviso">
    <p>El monto ingresado no es valido.-</p>
</div>
<div id="mensaje9" class="mensaje" title="Aviso">
    <p>Se requiere un numero.-</p>
</div>
