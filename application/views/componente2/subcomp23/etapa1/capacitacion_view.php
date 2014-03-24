    
<center>
    <h1>Registrar Capacitaciones del Equipo Local de Apoyo</h1>
</center>
<table align="center" >
    <tr>
    <td align="center" ><a href="<?php echo base_url('componente2/comp23_E1/registrarCapacitacion'); ?>"><img src="<?php echo base_url('resource/imagenes/add.png'); ?>"/></a></td>
</tr>
<tr>
<td class="letraazul" align="center">Registrar Capacitaciòn</td>
</tr>
</table>
<p></p>
<table align="center" >
    <thead>
        <tr >
        <th class="thEstandar"> Fecha</th>
        <th class="thEstandar">Tema</th>
        <th class="thEstandar">Lugar</th>
        <th class="thEstandar" width="150px">Acciones</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($capacitaciones as $aux) { ?>
            <tr style="font-size: 14px" >
            <td><?php if (!is_null($aux->cap_fecha)) echo date_format(date_create($aux->cap_fecha), "d-m-Y"); ?></td>
            <td><?php echo $aux->cap_tema; ?></td>
            <td><?php echo $aux->cap_lugar ?></td>
            <td>
                <a href="<?php echo base_url('componente2/comp23_E1/editarCapacitacion'); ?>/<?php echo $aux->cap_id; ?>"><img src="<?php echo base_url('resource/imagenes/edit.png'); ?>"/></a>
                <a href="<?php echo base_url('componente2/comp23_E1/cancelaCapacitacion'); ?>/<?php echo $aux->cap_id; ?>"><img src="<?php echo base_url('resource/imagenes/cancel.png'); ?>" heigth="50px" width="50px"/></a>                
            </td>
            </tr>
        <?php } ?>

    </tbody>
</table>


