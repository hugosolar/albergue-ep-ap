<?php

 ?>
<div class="row">
	<div class="large-12 columns">
		<h1>Administración de grupos familiares</h1>
		<ul class="button-group">
			<li> <a href="<?php echo site_url("familia/accion/agregar"); ?>" class="button success"><i class="fi-plus"></i> Agregar</a></li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="large-12 columns">
		<?php
			if (!empty($familias)):
				echo '<table>';
					echo '<thead>';
						echo '<tr>';
							echo '<th>Apellido Paterno</th>';
							echo '<th>Apellido Materno</th>';
							echo '<th>Domicilio</th>';
							echo '<th>Acciones</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
						foreach ($familias as $familia) {
							echo '<tr>';
								echo '<td>'.$familia->apellido_paterno.'</td>';
								echo '<td>'.$familia->apellido_materno.'</td>';
								echo '<td>'.$familia->id_domicilio.'</td>';
								echo '<td> <a data-tooltip class="has-tip" title="Borrar Familia" href="'.site_url("familia/accion/borrar/".$familia->id).'"><i class="fi-x"></i></a> <a data-tooltip class="has-tip" title="Editar Familia" href="'.site_url("familia/accion/editar/".$familia->id).'"><i class="fi-page-edit"></i></a></td>';
							echo '<tr>';
						}
					echo '</tbody>';
				echo '</table>';
			else :

			endif;
		 ?>
	</div>
</div>
<div class="row">
	<div class="large-12 columns">
		<a href="<?php echo site_url('') ?>" class="button tiny">Volver</a>
	</div>
</div>