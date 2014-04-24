<?php
class Persona extends CI_Controller {
	public $header_data;
	public $db_fields;

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'generales'));
		$this->header_data = array(
			'title' => 'Administrar Personas',
			'css' => array(
				'normalize' => base_url('assets/css/normalize.css'),
				'style' => base_url('assets/css/foundation.min.css'),
				'icons' => base_url('assets/foundation-icons/foundation-icons.css')
				),
			'js' => array(
				'modernizr' => base_url('assets/js/vendor/modernizr.js'),
				'foundation' => base_url('assets/js/foundation.min.js'),
				'tooltip' => base_url('assets/js/foundation/foundation.tooltip.js')
				)
			);
		$this->db_fields = array(
				'nombre',
				'apellido_paterno',
				'apellido_materno',
				'fecha_nacimiento',
				'estado_civil',
				'rut',
				'estado',
				'activo',
				'fecha_ingreso',
				'familia',
				'tipo_familia',
				'observacion',
				'pariente',
				'pariente',
				'domicilio',
				'sexo',
				'albergue'
			);
	}
	function index() {
		$data = array();
		$personas = $this->get_people_data();
		//$personas = $this->get_data('personas','apellido_paterno');
		$proc_personas = array();
		foreach ($personas as $persona) {
			$age = $this->calc_age($persona->fecha_nacimiento);
			$persona->age = $age;
			$persona->sexo = ($persona->sexo == 1) ? 'Femenino' : 'Masculino';
			$proc_personas[] = $persona;
		}
		$data['personas'] = $proc_personas;
		$this->load->view('header', $this->header_data);
		$this->load->view('persona-opcion',$data);
		$this->load->view('footer');
	}
	function guardar() {
		//guardar form
	}

	function accion($action) {
		$error = array();
		$data = array(
			'accion' => $action,
			'domicilios' => $this->get_data('domicilio','id'),
			'familias' => $this->get_data('familia','apellido_paterno'),
			'estados' => $this->get_data('estados','id'),
			'albergues' => $this->get_data('albergue','id'),
			'personas' => $this->get_data('personas','apellido_paterno')
			);
		if ($action == 'editar') {
			$segment = $this->uri->segment(4);
			$id = (!empty($segment)) ? $segment : 0;

			if ($id) {
				$data['id'] = $id;
			} else {
				$error[] = 'no se ha especificado una persona';
				$data['errores'] = $error;
			}
			$persona = $this->get_data('personas','apellido_paterno',$id);
			$data['persona'] = current($persona);
			$this->load->view('header', $this->header_data);
			$this->load->view('persona-form',$data);
			$this->load->view('footer');
		} else if ($action == 'agregar') {
			$this->load->view('header', $this->header_data);
			$this->load->view('persona-form',$data);
			$this->load->view('footer');
		} else if ($action == 'guardar') {
			//mandatory fields
			$mandatory = array(
				'nombre',
				'apellido_paterno',
				'apellido_materno',
				'fecha_nacimiento',
				'rut',
				'sexo',
				'estado',
				'domicilio'
				);

			$qproc_personas = array();
			foreach ($data['personas'] as $qpersona) {
				$age = $this->calc_age($qpersona->fecha_nacimiento);
				$qpersona->age = $age;
				$qpersona->sexo = ($qpersona->sexo == 1) ? 'Femenino' : 'Masculino';
				$qproc_personas[] = $qpersona;
			}
			$data['personas'] = $qproc_personas;

			$get_form = $this->input->post(NULL, TRUE);
			$id = $get_form['id'];
			$values = $get_form; unset($values['accion']); unset($values['id']);

			//check errors
			$errors = array();
			foreach ($get_form as $key => $item) {
				if (in_array($key, $mandatory) && (empty($item)))
					$errors[] = $key;
			}
			if (empty($errors)) {
				$field_value = array();
				foreach ($this->db_fields as $field) {
					$field_value[$field] = $values[$field];
				}
				if ($get_form['accion'] == 'agregar') {

					$query = $this->db->insert_string('personas', $field_value);
					$this->db->query($query);

					if ($this->db->affected_rows() > 0) {
						$messages[] = __CLASS__.' Insertada correctamente';
					} else {
						$errors[] = __CLASS__.' No ha podido ser ingresada. inténtalo denuevo';
					}
				} else {

					$query = $this->db->update_string('personas', $field_value, "id = $id");

					$this->db->query($query);

					if ($this->db->affected_rows() > 0) {
						$messages[] = __CLASS__.' Editada correctamente';
					} else {
						$errors[] = __CLASS__.' No ha podido ser editada. inténtalo denuevo';
					}
				}
			} else {
				$errors[] = 'Los siguientes campos son obligatorios: '.implode(', ', $mandatory);
			}
			if (!empty($errors))
				$data['errors'] = $errors;
			if (!empty($messages))
				$data['messages'] = $messages;

			$this->load->view('header', $this->header_data);
			$this->load->view('persona-opcion',$data);
			$this->load->view('footer');

			//echo '<pre>'; print_r($get_form); echo '</pre>';
		}
	}
	/**
	* get_data
	* extrae data de las tablas sin id extrae todas
	* con id extrae solo ese row
	* @param char $table tabla de donde se extrae la data
	* @param char $row campo para ordenar los resultados
	* @param int $id (optativo) numero de la celda seleccionada
	*/
	function get_data($table, $row, $id='') {
		$DB = $this->load->database('default');
		$byIdQuery ='';
		if (!empty($id))
			$byIdQuery = " WHERE id='$id'";

		$query = "SELECT * FROM $table $byIdQuery order by $row";
		$exec = $this->db->query($query);
		return $exec->result();
	}
	function get_people_data() {
		$DB = $this->load->database('default');
		$query = "SELECT * FROM personas as p INNER JOIN familia as f ON p.familia=f.id INNER JOIN domicilio as d ON p.domicilio=d.id INNER JOIN albergue as a ON p.albergue=a.id INNER JOIN estados as e ON p.estado=e.id GROUP BY p.id order by p.apellido_paterno";
		$exec = $this->db->query($query);
		return $exec->result();
	}
	function calc_age($date = '')
    {
    	if (!empty($date)) {
    		date_default_timezone_set("Chile/Continental");
			$DateOfBirth  = strtotime($date);
			$DateDifference   = time() - $DateOfBirth;
			$AgeInYears = $DateDifference /(60*60*24*365);
			return floor($AgeInYears);
		} else {
			return null;
		}
    }
}