<?php
class Familia extends CI_Controller {
	public $header_data;
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'generales'));
		$this->header_data = array(
			'title' => 'Administrar Familias',
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
		$familias = $this->get_data('familia','apellido_paterno');
		$data['familias'] = $familias;
		$this->load->view('header', $this->header_data);
		$this->load->view('familias-opcion',$data);
		$this->load->view('footer');
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
}