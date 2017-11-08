<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('field/field_m'));
		is_logged_in();
	}

	function index()
	{
		$data['main_content'] = 'dashboard_v';
		$data['jml3Bulan'] = $this->field_m->countExpired(3);
		$data['jml6Bulan'] = $this->field_m->countExpired(6);
		$data['jml12Bulan'] = $this->field_m->countExpired(12);
		$data['countSertifikat'] = $this->field_m->countSertifikat();
		$data['countUser'] = $this->field_m->countUser();
		$this->load->view('includes/backend', $data);	
	}

	function members_area()
	{
		$data['main_content'] = 'dashboard_v';
		$this->load->view('includes/backend', $data);	
	}
	
	function another_page() // just for sample
	{
		echo 'good. you\'re logged in.';
	}

}

/* End of file dashboard.php */
/* Location: ./application/modules/dashboard/controllers/dashboard.php */