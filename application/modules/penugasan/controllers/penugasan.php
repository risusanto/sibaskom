<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penugasan extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->library(array('form_validation', 'Ajax_pagination'));
		$this->load->model('penugasan_m');
		$this->perPage = 5;
	}

	function index()
	{
		$totalRec = count($this->penugasan_m->getRows());

		//pagination configuration
				$config['target']      = '#postList';
				$config['base_url']    = base_url().'penugasan/ajaxPaginationData';
				$config['total_rows']  = $totalRec;
				$config['per_page']    = $this->perPage;
				$config['link_func']   = 'searchFilter';
				$this->ajax_pagination->initialize($config);

		$data['main_content'] 	= 'fields/penugasan_v';
		$data['form_action'] 	= 'penugasan/report';
		$data['box_title'] 		= 'Data Penugasan Pegawai';

		//get the posts data
				$data['posts'] = $this->penugasan_m->getRows(array('limit'=>$this->perPage));

		// $data['query'] = $this->field_m->getAll();

		$this->load->view('includes/backend', $data);
	}

	function ajaxPaginationData(){
				$conditions = array();

				//calc offset number
				$page = $this->POST('page');
				if(!$page){
						$offset = 0;
				}else{
						$offset = $page;
				}

				//set conditions for search
				$lokasi_penugasan = $this->POST('lokasi_penugasan');
				$nama = $this->POST('nama');
				$nip = $this->input->post('nip');
				$sortBy 		= $this->input->post('sortBy');

				if(!empty($lokasi_penugasan)){
						$conditions['search']['lokasi_penugasan'] = $lokasi_penugasan;
				}
				if(!empty($nama)){
						$conditions['search']['nama'] = $nama;
				}
				if(!empty($nip)){
						$conditions['search']['nip'] = $nip;
				}

				//total rows count
				$totalRec = count($this->penugasan_m->getRows($conditions));

				//pagination configuration
				$config['target']      = '#postList';
				$config['base_url']    = base_url().'penugasan/ajaxPaginationData';
				$config['total_rows']  = $totalRec;
				$config['per_page']    = $this->perPage;
				$config['link_func']   = 'searchFilter';
				$this->ajax_pagination->initialize($config);

				//set start and limit
				$conditions['start'] = $offset;
				$conditions['limit'] = $this->perPage;

				//get posts data
				$data['posts'] = $this->penugasan_m->getRows($conditions);
				$data['box_title'] 		= 'Data Penugasan Pegawai';
				//load the view
				$this->load->view('fields/ajax-pagination-data', $data, false);
		}

}

/* End of file dashboard.php */
/* Location: ./application/modules/penugasan/controllers/penugasan.php */
