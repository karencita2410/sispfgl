<script type="text/javascript">        
    $(document).ready(function(){
        /*VARIABLES*/
        var myGrid = $('#gestionSolicitud');        
        myGrid.jqGrid({ 
            url: '<?php echo base_url('componente2/comp23_E0/cargarSolicitudes') . "/0" ?>',
            datatype:'json',
            altRows:true,
            colNames:['Id','Fecha Solicitud', 'Nombre del solicitante', 'Cargo', 'Teléfono',''],
            colModel:[
                { name:'id', index: 'id', width:20,editable:false,editoptions:{size:15}  },
                { name:'fecha_solicitud', index: 'fecha_solicitud', width:150,editable:true,editoptions:{size:25}  },
                { name:'nombre_solicitante', index: 'nombre_solicitante',width:300,editable:true,editoptions:{size:50}},
                { name:'cargo', index: 'cargo',width:150,editable:true,editoptions:{size:50}},
                { name:'telefono', index: 'telefono',width:60,editable:true,editoptions:{size:50}},
                {name:'act',index:'act', width:120,sortable:false}],            
            rowNum:10,
            rowList:[10,20,30],
            multiselect: false,
            loadonce:true,
            gridComplete: function(){
                var ids = jQuery("#gestionSolicitud").jqGrid('getDataIDs');
                for(var i=0;i < ids.length;i++){ 
                    var cl = ids[i];
                    if(cl!=0){
                        ce = "<input style='height:22px;width:120px;' type='submit' value='Editar' onclick=\" $('#idfila').attr('value', '"+cl+"'); this.form.action='<?php echo base_url('componente2/comp23_E0/solicitudAsistenciaTecnica') ?>' \" />";
                        jQuery("#gestionSolicitud").jqGrid('setRowData',ids[i],{act:ce}); 
                    }} 
            },
            pager: jQuery('#pagergestionSolicitud'),
            viewrecords: true,          
            caption: 'Unidades Organizativas',
            height: "100%",
            editurl: 'manttUnidadEdicion'
        });
        
        myGrid.jqGrid('navGrid','#pagergestionSolicitud',
        {edit:false,add:false,del:false,
            beforeRefresh: function() {gestionSolicitud.jqGrid('setGridParam',{datatype:'json',loadonce:true}).trigger('reloadGrid');}},
        {width:550,height:200},{width:550,height:200},{width:550,height:100},{multipleSearch:true, multipleGroup:true}
    ).hideCol('id');
 
        /*CARGAR MUNICIPIOS*/
        $('#selDepto').change(function(){   
            $('#selMun').children().remove();
            $.getJSON('<?php echo base_url('componente2/proyectoPep/cargarMunicipios') ?>?dep_id='+$('#selDepto').val(), 
            function(data) {
                var i=0;
                $.each(data, function(key, val) {
                    if(key=='rows'){
                        $('#selMun').append('<option value="0">--Seleccione Municipio--</option>');
                        $.each(val, function(id, registro){
                            $('#selMun').append('<option value="'+registro['cell'][0]+'">'+registro['cell'][1]+'</option>');
                        });                    
                    }
                });
            });
        }); 
        /*CARGAR PROYECTOS PEP*/
        $('#selMun').change(function(){
            $('#gestionSolicitud').setGridParam({
                url:'<?php echo base_url('componente2/comp23_E0/cargarSolicitudes')."/" ?>'+$('#selMun').val(),
                datatype:'json'
            }).trigger("reloadGrid"); 
        });
        
        
           $("#agregarS").button().click(function() {
            this.form.action='<?php echo base_url('componente2/comp23_E0/agregarsolicitudAsistencia'); ?>';
        });
    });               
</script>     
<form id="gestionSolicitudForm" method="post">

    <table>
        <tr><td style="width: 150px"> 
        <td class="textD"><strong>Departamento:</strong></td>
        <td>
            <select id='selDepto' name="selDepto">
                <option value='0'>--Seleccione Departamento--</option>
                <?php foreach ($departamentos as $depar) { ?>
                    <option value='<?php echo $depar->dep_id; ?>'><?php echo $depar->dep_nombre; ?></option>
                <?php } ?>
            </select>
        </td>
        </tr>
        <tr><td style="width: 150px"> 
        <td class="textD"><strong>Municipio:</strong></td>
        <td >
            <select id='selMun' name="selMun">
                <option value='0'>--Seleccione Municipio--</option>
            </select>
        </td>    
        </tr>
    </table>

   <center style="position: relative;top: 20px">
        <div>
            <p>
                <input type="submit" id="agregarS" name="agregarS" value="Agregar Solicitud  de Asistencia"  />
            </p>
        </div>
    </center>
<br/>
    <table>
        <tr>
        <td style="width: 100px"></td>
        <td>
            <table id="gestionSolicitud"></table>  
            <div id="pagergestionSolicitud"></div> 
        </td>
        </tr>
    </table>
    <input id="idfila" type="text" name="idfila" value="" style="visibility: hidden"/>
</form>