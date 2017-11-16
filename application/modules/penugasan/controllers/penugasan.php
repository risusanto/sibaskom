<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penugasan extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('penugasan_m');
		is_logged_in();
	}

	function index()
	{
		$data['main_content'] = 'penugasan_v';
		$data['penugasan'] = $this->penugasan_m->get();
		$this->load->view('includes/backend', $data);
	}

}

/* End of file dashboard.php */
/* Location: ./application/modules/penugasan/controllers/penugasan.php */
