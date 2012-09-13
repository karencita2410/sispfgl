<script type="text/javascript">        
    $(document).ready(function(){  
        
        var tabla=$("#consultora");
        tabla.jqGrid({
            url:'<?php echo base_url('consultor/consultoraC/cargarConsultoras') ?>',
            datatype:'json',
            altRows:true,
            height: "100%",
            hidegrid: false,
            colNames:['id','Nombre Consultora','Teléfono'],
            colModel:[
                {name:'id',index:'id', editable:false,editoptions:{size:15} },
                {name:'cons_nombre',index:'cons_nombre',editable:true,
                    edittype:"textarea",editoptions:{rows:"4",cols:"50"},width:'450'
                },
                {name:'cons_telefono',index:'cons_telefono',editable:true,
                    edittype:"textarea",editoptions:{rows:"4",cols:"50"},width:'250'
                }
            ],
            multiselect: false,
            caption: "Proyectos PEP",
            rowNum:10,
            rowList:[10,20,30],
            loadonce:true,
            pager: jQuery('#pager'),
            viewrecords: true     
        }).jqGrid('navGrid','#pager',
        {edit:false,add:false,del:false,search:false,refresh:false,
            beforeRefresh: function() {
                tabla.jqGrid('setGridParam',{datatype:'json',loadonce:true}
            ).trigger('reloadGrid');}
        }
    ).hideCol(['id']);
        /* BOTON DE EDITAR*/
        $("#editar").click(function(){
            var gr = tabla.jqGrid('getGridParam','selrow');
            if( gr != null ){
               document.location.href = '<?php echo base_url()?>consultor/consultoraC/editarConsultora/'+gr;
            }
            else {
                $('#mensaje2').dialog('open');
                return false;
            }
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
    });
</script>
<center>
    <h1>Gestión de Consultoras</h1>

    <table align="center" >
        <tr>
        <td align="center" ><a href="<?php echo base_url('consultor/consultoraC/registrarConsultora') ?>"><img src="<?php echo base_url('resource/imagenes/add.png'); ?>"/></a></td>
        <td width="30"></td>
        <td align="center" ><a id="editar" ><img src="<?php echo base_url('resource/imagenes/edit.png'); ?>"/></a></td>
        </tr>
        <tr>
        <td class="letraazul" align="center">Registrar Consultora</td>
        <td width="30"></td>
        <td class="letraazul" align="center">Editar Consultora</td>
        </tr>
    </table>
    </br>

    <table id="consultora"></table>
    <div id="pager"></div>
</center>

<div id="mensaje2" class="mensaje" title="Aviso">
    <p>Debe Seleccionar una consultora para editar</p>
</div>
