<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessment extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->library(array('form_validation', 'Ajax_pagination'));

		$this->load->model(array('assessment_m'));
		$this->perPage = 5;
	}

  function index()
	{
		$totalRec = count($this->assessment_m->getRows());

		//pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'assessment/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);

		$data['main_content'] 	= 'assessment_v';
		$data['form_action'] 	= 'field/report';
		$data['box_title'] 		= 'Data Assessment Pegawai';

		//get the posts data
        $data['posts'] = $this->assessment_m->getRows(array('limit'=>$this->perPage));


		$this->load->view('includes/backend', $data);
	}

  function ajaxPaginationData(){
        $conditions = array();

        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        //set conditions for search
        $nama_pegawai = $this->input->post('nama_pegawai');

        $nip = $this->input->post('nip');
        $sortBy 		= $this->input->post('sortBy');

        if(!empty($nama_pegawai)){
            $conditions['search']['nama'] = $nama_pegawai;
        }
        if(!empty($nip)){
            $conditions['search']['nip'] = $nip;
        }

        //total rows count
        $totalRec = count($this->assessment_m->getRows($conditions));

        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'assessment/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

        //get posts data
        $data['posts'] = $this->assessment_m->getRows($conditions);
        $data['box_title'] 		= 'Data Assessment Pegawai';
        //load the view
        $this->load->view('fields/ajax-pagination-data', $data, false);
    }
}
