<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fit_and_proper extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->library(array('form_validation', 'Ajax_pagination'));

		$this->load->model(array('fit_and_proper_m'));
		$this->perPage = 5;
	}

  function index()
	{
		$totalRec = count($this->fit_and_proper_m->getRows());

		//pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'fit_and_proper/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);

		$data['main_content'] 	= 'fit_and_proper_v';
		$data['form_action'] 	= 'fit_and_proper/report';
		$data['box_title'] 		= 'Data Fit and Proper Test Pegawai';

		//get the posts data
        $data['posts'] = $this->fit_and_proper_m->getRows(array('limit'=>$this->perPage));


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
        $totalRec = count($this->fit_and_proper_m->getRows($conditions));

        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'fit_and_proper/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

        //get posts data
        $data['posts'] = $this->fit_and_proper_m->getRows($conditions);
        $data['box_title'] 		= 'Data Fit and Proper Test Pegawai';
        //load the view
        $this->load->view('fields/ajax-pagination-data', $data, false);
    }

		function tambah()
		{
			if ($this->POST('tambah')) {
				// validasi
				$this->form_validation->set_rules('nip','NIP', 'required');
		        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Peringatan</strong> ', '</div>');

		        if($this->form_validation->run() === TRUE) {

		        	if($_FILES['file_evidence']['name'] != ""){
				        //upload foto
				    	//Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)
				        $configUpload['upload_path'] 	= FCPATH.'uploads/fit_and_proper/';
				        $configUpload['allowed_types'] 	= '*';
				        $configUpload['max_size'] 		= '0';
				        $this->load->library('upload', $configUpload);
				        $this->upload->do_upload('file_evidence');

				        $upload_data 	= $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
						$nama_filenya = $upload_data['file_name'];

			        	$data = array('nip' => $this->POST('nip'),
			    						'nama'	=> $this->POST('nama'),
			    						'unit'	=> $this->POST('unit'),
			    						'job_suksesi'	=> $this->POST('job_suksesi'),
			    						'penguji'	=> $this->POST('penguji'),
			    						'hasil_fit_and_proper'	=> $this->POST('hasil_fit_and_proper'),
			    						'file_evidence'	=> $nama_filenya
			   						);
			        }
			        else{
			        	$data = array('nip' => $this->input->post('nip'),
								'nama'	=> $this->POST('nama'),
								'unit'	=> $this->POST('unit'),
								'job_suksesi'	=> $this->POST('job_suksesi'),
								'penguji'	=> $this->POST('penguji'),
								'hasil_fit_and_proper'	=> $this->POST('hasil_fit_and_proper'),
			   				);
			        }

					$this->fit_and_proper_m->insert($data);

		        	$this->session->set_flashdata('message', 'Data berhasil disimpan');
					redirect('fit_and_proper', 'refresh');
					exit;
		        }
		        else
		        {
					$this->tambah();
					exit;
		   		}
			}
			$data["main_content"] 	= "fields/form_v";
			$data['box_title'] 		= 'Form Data fit_and_proper Pegawai';

			$this->load->view("includes/backend",$data);
		}

		function ubah($id){
			$data['fit_and_proper'] = $this->fit_and_proper_m->get_row(['id_fit_and_proper' => $id]);
			if(!isset($id) || !isset($data['fit_and_proper'])){
				redirect('fit_and_proper');
				exit;
			}
			if ($this->POST('edit')) {
				// validasi
				$this->form_validation->set_rules('nip','NIP', 'required');
		        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Peringatan</strong> ', '</div>');

		        if($this->form_validation->run() === TRUE) {

		        	if($_FILES['file_evidence']['name'] != ""){
				        //upload foto
				    	//Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)
				        $configUpload['upload_path'] 	= FCPATH.'uploads/fit_and_proper/';
				        $configUpload['allowed_types'] 	= '*';
				        $configUpload['max_size'] 		= '0';
				        $this->load->library('upload', $configUpload);
				        $this->upload->do_upload('file_evidence');

				        $upload_data 	= $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
								$nama_filenya = $upload_data['file_name'];

			        	$data = array('nip' => $this->POST('nip'),
			    						'nama'	=> $this->POST('nama'),
			    						'unit'	=> $this->POST('unit'),
			    						'job_suksesi'	=> $this->POST('job_suksesi'),
			    						'penguji'	=> $this->POST('penguji'),
			    						'hasil_fit_and_proper'	=> $this->POST('hasil_fit_and_proper'),
			    						'file_evidence'	=> $nama_filenya
			   						);
			        }
			        else{
			        	$data = array('nip' => $this->input->post('nip'),
								'nama'	=> $this->POST('nama'),
								'unit'	=> $this->POST('unit'),
								'job_suksesi'	=> $this->POST('job_suksesi'),
								'penguji'	=> $this->POST('penguji'),
								'hasil_fit_and_proper'	=> $this->POST('hasil_fit_and_proper'),
			   				);
			        }

					$this->fit_and_proper_m->update($id,$data);

		        	$this->session->set_flashdata('message', 'Data berhasil diubah');
					redirect('fit_and_proper', 'refresh');
					exit;
		        }
		        else
		        {
						$this->session->set_flashdata('message', 'Error: Data gagal diupdate');
						redirect('fit_and_proper', 'refresh');
						exit;
		   			}
			}
			$data['main_content'] = 'fields/form-edit_v';
			$this->load->view('includes/backend', $data);
		}

		function hapus($id){
			$this->fit_and_proper_m->delete($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');

			redirect('fit_and_proper', 'refresh');
		}

		function report()
		{
			$conditions = array();

	        //calc offset number
	        $page = $this->POST('page');
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
	        $totalRec = count($this->fit_and_proper_m->getRows($conditions));

	        //pagination configuration
	        $config['target']      = '#postList';
	        $config['base_url']    = base_url().'fit_and_proper/ajaxPaginationData';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'searchFilter';
	        $this->ajax_pagination->initialize($config);

	        $data['posts'] = $this->fit_and_proper_m->getRows($conditions);

	        $data['content'] = 'fields/excel_v';
	        $contents = $this->load->view($data['content'],$data);
		}

		function download($id){
			$this->load->helper('download');
			$detail = $this->fit_and_proper_m->get_row(['id_fit_and_proper' => $id]);
			if (!isset($id) || !isset($detail)) {
				redirect('assesment');
				exit;
			}
			$file = $detail->file_evidence;
			$data = file_get_contents(FCPATH.'uploads/fit_and_proper/'.$file.''); // Read the file's contents
			$name = $file;

			if (force_download($name, $data)) {
				# code...
			} else {
				# code...
				$this->session->set_flashdata('message', 'File tidak ditemukan');
				redirect('fit_and_proper','refresh');
				exit;
			}
		}
}
