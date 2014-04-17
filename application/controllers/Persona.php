<?php
class Persona extends CI_Controller {
	public $header_data;
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
	}
	function index() {
		$data = array();
		$personas = $this->get_data('personas','apellido_paterno');
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
			'albergues' => $this->get_data('albergue','id')
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