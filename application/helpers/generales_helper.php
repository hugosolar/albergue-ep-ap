<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('calc_age'))
{
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
if (! function_exists('get_data')) {
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