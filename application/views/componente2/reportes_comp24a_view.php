<script type="text/javascript">
    $(document).ready(function() {
        $("#reporte").button().click(function() {

            if ($('input[name="tipo"]:checked').val() == 1)
                $("#formulario").attr('action', '<?php echo base_url('componente2/componente24a/reporte_gral_comp24a_cap'); ?>');
            else
            if ($('input[name="tipo"]:checked').val() == 2)
                $("#formulario").attr('action', '<?php echo base_url('componente2/componente24a/reporte_gral_comp24a_atm'); ?>');
            else
            if ($('input[name="tipo"]:checked').val() == 3)
                $("#formulario").attr('action', '<?php echo base_url(''); ?>');
            else
            if ($('input[name="tipo"]:checked').val() == 4)
                $("#formulario").attr('action', '<?php echo base_url(''); ?>');

            $.ajax({
                type: "POST",
                cache: false,
                success: function(response)
                {
                    window.open(response);
                }
            });
        });
    });
</script>
<br/>
<br/>
<center>
    <h1>Reportes Componente 2.4 a</h1>
</center>
<b><label>Seleccione el reporte que desea generar:</label></b>
<form id="formulario" method="post" action="">
    
    <input type="radio" name="tipo" value="1"> Reporte General Componente 2.4 a - Capacitaciones </input>
    <br/>
    <input type="radio" name="tipo" value="2"> Reporte General Componente 2.4 a - Asistencia T&eacute;cnica Municipal </input>
    <br/>
    
    <br/>
    <input type="submit" id="reporte" value="Generar Reporte" />

</form>
<br/>
<br/>
