<script type="text/javascript">        
   $(document).ready(function(){
        
        $('.mensaje').dialog({
            autoOpen: false,
            width: 300,
            buttons: {
                "Ok": function() {
                    $(this).dialog("close");
                }
            }
        });

		$("#comparar").button().click(function(){
			var file = $("#comparar").attr( "name" );
			window.location = '<?php echo base_url('poa/poa/comparar_poa') ?>'+'/'+file;
        });
        
        $("#otro").button().click(function(){
			window.location = '<?php echo base_url('poa/poa/subir_archivo_poa') ?>';
        });
       
	});
</script>

<h3>Archivo Subido con Exito</h3>
<?php 
	echo '&nbsp;&nbsp;&nbsp;&nbsp;<b>&#8226; Nombre del Archivo:</b> '.$upload_data['file_name'].'<br/><br/>';

	if($upload_data['file_name']!='poa_base.xlsx')
		echo '<input type="button" id="comparar" name="'.$upload_data['file_name'].'" value="Realizar Comparativo"/>';
	else
		echo 'Se ha realizado la substituci&oacute;n del Archivo POA Base.';
?>		
<input type="button" id="otro" value="Subir Otro Archivo"/>
