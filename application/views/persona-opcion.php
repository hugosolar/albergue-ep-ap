<?php

 ?>
<div class="row">
	<div class="large-12 columns">
		<h1>Administración de Personas</h1>
		<ul class="button-group">
			<li> <a href="<?php echo site_url("persona/accion/agregar"); ?>" class="button success"><i class="fi-plus"></i> Agregar</a></li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="large-12 columns">
		<?php
			if (!empty($personas)):
				echo '<table>';
					echo '<thead>';
						echo '<tr>';
							echo '<th>Nombre</th>';
							echo '<th>Edad</th>';
							echo '<th>Sexo</th>';
							echo '<th>Estado</th>';
							echo '<th>Ingreso</th>';
							echo '<th>Familia</th>';
							echo '<th>Domicilio</th>';
							echo '<th>Albergue</th>';
							echo '<th>Acciones</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
						foreach ($personas as $persona) {
							echo '<tr>';
								echo '<td>'.$persona->apellido_paterno.' '.$persona->apellido_materno.', '.$persona->nombre.'</td>';
								echo '<td>'.$persona->age.'</td>';
								echo '<td>'.$persona->sexo.'</td>';
								echo '<td>'.$persona->estado.'</td>';
								echo '<td>'.$persona->fecha_ingreso.'</td>';
								echo '<td>'.$persona->familia.'</td>';
								echo '<td>'.$persona->domicilio.'</td>';
								echo '<td>'.$persona->albergue.'</td>';
								echo '<td> <a data-tooltip class="has-tip" title="Borrar persona" href="'.site_url("persona/accion/borrar/".$persona->id).'"><i class="fi-x"></i></a> <a data-tooltip class="has-tip" title="Editar persona" href="'.site_url("persona/accion/editar/".$persona->id).'"><i class="fi-page-edit"></i></a></td>';
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