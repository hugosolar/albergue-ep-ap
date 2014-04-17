<?php
class Albergues extends CI_Controller {
	public $header_data;
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->header_data = array(
			'title' => 'Administrar albergue',
			'css' => array(
				'normalize' => base_url('assets/css/normalize.css'),
				'style' => base_url('assets/css/foundation.min.css'),
				'icons' => base_url('assets/foundation-icons/foundation-icons.css')
				),
			'js' => array(
				'modernizr' => base_url('assets/js/vendor/modernizr.js'),
				'foundation' => base_url('assets/js/foundation.min.js')
				)
			);
	}

	function index()
	{
		$this->load->view('header', $this->header_data);
		$this->load->view('main', array('error' => ' ' ));
		$this->load->view('footer');
	}

}