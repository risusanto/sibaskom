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
		$data['form_action'] 	= 'assessment/report';
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

		function tambah()
		{
			if ($this->POST('tambah')) {
				// validasi
				$this->form_validation->set_rules('nip','NIP', 'required');
		        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Peringatan</strong> ', '</div>');
		        $tanggal_awal_berlaku	= date("Y-m-d", strtotime($this->POST('tanggal_awal_berlaku')));
		        $tanggal_akhir_berlaku 	= date("Y-m-d", strtotime($this->POST('tanggal_akhir_berlaku')));

		        $nik 		= $this->session->userdata('nik');
		        $tanggal 	= date("Y-m-d");
						$jam 		= date("H:i:s");

		        if($this->form_validation->run() === TRUE) {

		        	if($_FILES['file_evidence']['name'] != ""){
				        //upload foto
				    	//Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)
				        $configUpload['upload_path'] 	= FCPATH.'uploads/assessment/';
				        $configUpload['allowed_types'] 	= '*';
				        $configUpload['max_size'] 		= '0';
				        $this->load->library('upload', $configUpload);
				        $this->upload->do_upload('file_evidence');

				        $upload_data 	= $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
								$nama_filenya = $upload_data['file_name'];

			        	$data = array('nip' => $this->POST('nip'),
			    						'nama'	=> $this->POST('nama'),
			    						'unit'	=> $this->POST('unit'),
			    						'tanggal_awal_berlaku'	=> $this->POST('tanggal_awal_berlaku'),
			    						'tanggal_akhir_berlaku'	=> $this->POST('tanggal_akhir_berlaku'),
			    						'hasil_assesment'	=> $this->POST('hasil_assesment'),
			    						'rekomendasi'	=> $this->POST('rekomendasi'),
			    						'waktu_alert'	=> $this->POST('waktu_alert'),
			    						'file_evidence'	=> $nama_filenya
			   						);
			        }
			        else{
			        	$data = array('nip' => $this->input->post('nip'),
								'nama'	=> $this->POST('nama'),
								'unit'	=> $this->POST('unit'),
								'tanggal_awal_berlaku'	=> $this->POST('tanggal_awal_berlaku'),
								'tanggal_akhir_berlaku'	=> $this->POST('tanggal_akhir_berlaku'),
								'hasil_assesment'	=> $this->POST('hasil_assesment'),
								'rekomendasi'	=> $this->POST('rekomendasi'),
								'waktu_alert'	=> $this->POST('waktu_alert'),
			   				);
			        }

					$this->assessment_m->insert($data);

		        	$this->session->set_flashdata('message', 'Data berhasil disimpan');
					redirect('assessment', 'refresh');
					exit;
		        }
		        else
		        {
					$this->tambah();
					exit;
		   		}
			}
			$data["main_content"] 	= "fields/form_v";
			$data['box_title'] 		= 'Form Data Assessment Pegawai';
			$data['form_action']	= site_url('assessment/insert');

			$this->load->view("includes/backend",$data);
		}

		function ubah($id){
			$data['assessment'] = $this->assessment_m->get_row(['id_assesment' => $id]);
			if(!isset($id) || !isset($data['assessment'])){
				redirect('assessment');
				exit;
			}
			if ($this->POST('edit')) {
				// validasi
				$this->form_validation->set_rules('nip','NIP', 'required');
		        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Peringatan</strong> ', '</div>');
		        $tanggal_awal_berlaku	= date("Y-m-d", strtotime($this->POST('tanggal_awal_berlaku')));
		        $tanggal_akhir_berlaku 	= date("Y-m-d", strtotime($this->POST('tanggal_akhir_berlaku')));

		        if($this->form_validation->run() === TRUE) {

		        	if($_FILES['file_evidence']['name'] != ""){
				        //upload foto
				    	//Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)
				        $configUpload['upload_path'] 	= FCPATH.'uploads/assessment/';
				        $configUpload['allowed_types'] 	= '*';
				        $configUpload['max_size'] 		= '0';
				        $this->load->library('upload', $configUpload);
				        $this->upload->do_upload('file_evidence');

				        $upload_data 	= $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
								$nama_filenya = $upload_data['file_name'];

			        	$data = array('nip' => $this->POST('nip'),
			    						'nama'	=> $this->POST('nama'),
			    						'unit'	=> $this->POST('unit'),
			    						'tanggal_awal_berlaku'	=> $this->POST('tanggal_awal_berlaku'),
			    						'tanggal_akhir_berlaku'	=> $this->POST('tanggal_akhir_berlaku'),
			    						'hasil_assesment'	=> $this->POST('hasil_assesment'),
			    						'rekomendasi'	=> $this->POST('rekomendasi'),
			    						'waktu_alert'	=> $this->POST('waktu_alert'),
			    						'file_evidence'	=> $nama_filenya
			   						);
			        }
			        else{
			        	$data = array('nip' => $this->input->post('nip'),
								'nama'	=> $this->POST('nama'),
								'unit'	=> $this->POST('unit'),
								'tanggal_awal_berlaku'	=> $this->POST('tanggal_awal_berlaku'),
								'tanggal_akhir_berlaku'	=> $this->POST('tanggal_akhir_berlaku'),
								'hasil_assesment'	=> $this->POST('hasil_assesment'),
								'rekomendasi'	=> $this->POST('rekomendasi'),
								'waktu_alert'	=> $this->POST('waktu_alert'),
			   				);
			        }

					$this->assessment_m->update($id,$data);

		        	$this->session->set_flashdata('message', 'Data berhasil diubah');
					redirect('assessment', 'refresh');
					exit;
		        }
		        else
		        {
						$this->session->set_flashdata('message', 'Error: Data gagal diupdate');
						redirect('assessment', 'refresh');
						exit;
		   			}
			}
			$data['main_content'] = 'fields/form-edit_v';
			$this->load->view('includes/backend', $data);
		}

		function hapus($id){
			$this->assessment_m->delete($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');

			redirect('assessment', 'refresh');
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
	        $totalRec = count($this->assessment_m->getRows($conditions));

	        //pagination configuration
	        $config['target']      = '#postList';
	        $config['base_url']    = base_url().'assessment/ajaxPaginationData';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'searchFilter';
	        $this->ajax_pagination->initialize($config);

	        $data['posts'] = $this->assessment_m->getRows($conditions);

	        $data['content'] = 'fields/excel_v';
	        $contents = $this->load->view($data['content'],$data);
		}
}
