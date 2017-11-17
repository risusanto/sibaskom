<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessment extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('assessment_m');
		$data['assessment']		= $this->assessment_m->get_by_order('id_assesment', 'DESC');
		$data['main_content'] 	= 'assessment_v';
		$this->load->view('includes/backend', $data);
	}

	public function tambah()
	{
		$this->load->model('assessment_m');
		
		if ($this->POST('submit'))
		{
			// logic tambah assessment disini

			exit;
		}

		$data['main_content']	= 'fields/form_v';
		$this->load->view('includes/backend', $data);
	}

}