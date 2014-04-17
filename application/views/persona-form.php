<div class="row">
	<div class="large-12 columns">
		<h1><i class="fi-torsos-female-male"></i> <?php echo (!empty($accion)) ? ucfirst($accion) : '' ?> Persona </h1>
		<?php
			if (!empty($persona)) {
				echo '<h3>Editando <strong>'.$persona->nombre.' '.$persona->apellido_paterno.' '.$persona->apellido_materno.'</strong></h3>';
			}
		 ?>
	</div>
</div>

<?php echo form_open('persona/guardar'); ?>
	<div class="row">
		<div class="large-12 columns">
			<fieldset>
				<legend>Datos personales</legend>

				<div class="row">
					<div class="large-12 columns">
						<label>
							Nombres
							<input type="text" placeholder="Nombres" name="nombre" value="<?php if (!empty($persona)) echo $persona->nombre; ?>">
						</label>
					</div>
				</div>
				<div class="row">
					<div class="large-6 columns">
						<label>
							Apellido Paterno
							<input type="text" placeholder="Apellido Paterno" name="apellido_paterno" value="<?php if (!empty($persona))  echo $persona->apellido_paterno; ?>">
						</label>
					</div>
					<div class="large-6 columns">
						<label>
							Apellido Materno
							<input type="text" placeholder="Apellido Materno" name="apellido_materno" value="<?php if (!empty($persona)) echo $persona->apellido_materno ?>">
						</label>
					</div>
				</div>
				<div class="row">
					<div class="large-6 columns">
						<label>
							Rut
							<input type="text" placeholder="14887932-0" name="rut" value="<?php if (!empty($persona)) echo $persona->rut ?>">
						</label>
					</div>
					<div class="large-6 columns">
						<label>
							Fecha Nacimiento
							<input type="text" placeholder="28/03/1983" name="fecha_nacimiento" value="<?php if (!empty($persona)) echo $persona->fecha_nacimiento ?>">
						</label>
					</div>
				</div>
				<div class="row">
					<div class="large-6 columns">
						<label>
							Estado Civil
							<select name="estado_civil">
								<option value="">Seleccionar</option>
								<option value="1">Soltera/o</option>
								<option value="2">Casada/o</option>
								<option value="3">Viuda/o</option>
								<option value="4">Separado/o</option>
							</select>
						</label>
					</div>
					<div class="large-6 columns">
						<label>
							Estado
							<select name="estado">
								<option value="">Seleccionar</option>
								<?php
									if (!empty($estados)) {
										foreach ($estados as $estado){
											$class = ($persona->estado == $estado->id) ? ' selected=="selected"': '';
											echo '<option value="'.$estado->id.'"'.$class.'>'.$estado->nombre.'</option>';
										}
									}
								?>
							</select>
						</label>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<label>
							Dirección
							<select name="domicilio">
								<option value="">Seleccionar</option>
								<?php
									if (!empty($domicilios)) {
										foreach ($domicilios as $domicilio){
											$class = ($persona->domicilio == $domicilio->id) ? ' selected=="selected"': '';
											echo '<option value="'.$domicilio->id.'"'.$class.'>'.$domicilio->calle.' '.$domicilio->numero.'</option>';
										}
									}
								?>
							</select>
						</label>
					</div>
				</div>
			</div>
		</fieldset>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<fieldset>
				<legend>Datos Albergue</legend>
				<div class="row">
					<div class="large-12 columns">
						<label>
							Albergue
							<select name="albergue">
								<option value="">Seleccionar</option>
								<?php
									if (!empty($albergues)) {
										foreach ($albergues as $albergue){
											$class = ($persona->albergue == $albergue->id) ? ' selected=="selected"': '';
											echo '<option value="'.$albergue->id.'"'.$class.'>'.$albergue->nombre.'</option>';
										}
									}
								?>
							</select>
						</label>
					</div>
				</div>
				<div class="row">
					<div class="large-3 columns">
						<label>
							Activo
							<select name="activo">
								<option value="">Seleccione</option>
								<option value="1">Sí</option>
								<option value="0">No</option>
							</select>
						</label>
					</div>
					<div class="large-3 columns">
						<div class="row collapse">
							<label>Fecha Ingreso</label>
							<div class="small-9 columns">
								<input type="text" name="fecha_ingreso" value="<?php if (!empty($persona)) echo $persona->fecha_ingreso ?>">
							</div>
							<div class="small-3 columns">
								<span class="postfix"><h4><i class="fi-calendar"></i></h4></span>
							</div>
						</div>

					</div>
					<div class="large-6 columns">
						<label>
							Familia
							<select name="familia">
								<option value="">Seleccione</option>
								<?php
									if (!empty($familias)) {
										foreach ($familias as $familia){
											$class = ($persona->familia == $familia->id) ? ' selected=="selected"': '';
											echo '<option value="'.$familia->id.'"'.$class.'>'.$familia->apellido_paterno.'-'.$familia->apellido_materno.'</option>';
										}
									}
								?>
							</select>
						</label>
					</div>
				</div>

				<div class="row">
					<div class="large-6 columns">
						<label>
							Categoría familiar
							<select name="tipo_familia">
								<option value="">Seleccione</option>
								<option value="1">Madre</option>
								<option value="2">Hijo</option>
							</select>
						</label>
					</div>
					<div class="large-6 columns">
						<label>
							Parentesco
							<select name="pariente">
								<option value="">Seleccione</option>
							</select>
						</label>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<label>
							Observaciónes
							<textarea name="observacion" id="" cols="30" rows="10"><?php if (!empty($persona)) echo $persona->observacion ?></textarea>
						</label>
					</div>
				</div>
				</fieldset>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<input type="hidden" name="accion" value="<?php echo (!empty($persona)) ? 'editar' : 'agregar' ?>">
			<input type="submit" class="button right" value="Guardar">
			<a href="<?php echo site_url("persona"); ?>" class="button">Cancelar</a>
		</div>
	</div>
</form>