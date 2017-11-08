<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Field extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->library(array('form_validation', 'Ajax_pagination'));

		$this->load->model(array('field_m'));
		$this->perPage = 5;
	}

	function index()
	{
		$totalRec = count($this->field_m->getRows());

		//pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'field/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);

		$data['main_content'] 	= 'fields/field_v';
		$data['form_action'] 	= 'field/report';
		$data['box_title'] 		= 'Data Sertifikat Pegawai';

		//get the posts data
        $data['posts'] = $this->field_m->getRows(array('limit'=>$this->perPage));

		// $data['query'] = $this->field_m->getAll();
		
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
        $judul_diklat = $this->input->post('judul_diklat');
        $nama_pegawai = $this->input->post('nama_pegawai');
        $masa_expired = $this->input->post('masa_expired');
        $nip = $this->input->post('nip');
        $sortBy 		= $this->input->post('sortBy');

        if(!empty($judul_diklat)){
            $conditions['search']['judul_diklat'] = $judul_diklat;
        }
        if(!empty($nama_pegawai)){
            $conditions['search']['nama'] = $nama_pegawai;
        }
        if(!empty($masa_expired)){
            $conditions['search']['masa_alert'] = $masa_expired;
        }
        if(!empty($nip)){
            $conditions['search']['nip'] = $nip;
        }
        
        //total rows count
        $totalRec = count($this->field_m->getRows($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'field/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['posts'] = $this->field_m->getRows($conditions);
        $data['box_title'] 		= 'Data Sertifikat Pegawai';
        //load the view
        $this->load->view('fields/ajax-pagination-data', $data, false);
    }

	function tambah()
	{
		$data["main_content"] 	= "fields/form_v";
		$data['box_title'] 		= 'Form Data Sertifikat Pegawai';
		$data['form_action']	= site_url('field/insert');

		$this->load->view("includes/backend",$data);
	}

	function insert()
	{
		// validasi
		$this->form_validation->set_rules('nip','NIP', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Peringatan</strong> ', '</div>');
        $tanggal_mulai_pelatihan	= date("Y-m-d", strtotime($this->input->post('tanggal_mulai_pelatihan')));
        $masa_belaku_sertifikat 	= date("Y-m-d", strtotime($this->input->post('masa_belaku_sertifikat')));

        $nik 		= $this->session->userdata('nik');
        $tanggal 	= date("Y-m-d");
		$jam 		= date("H:i:s");

        if($this->form_validation->run() === TRUE) {

        	if($_FILES['file_sertifikat']['name'] != ""){
		        //upload foto
		    	//Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)	 
		        $configUpload['upload_path'] 	= FCPATH.'uploads/sertifikat/';
		        $configUpload['allowed_types'] 	= '*';
		        $configUpload['max_size'] 		= '0';
		        $this->load->library('upload', $configUpload);
		        $this->upload->do_upload('file_sertifikat');
		        
		        $upload_data 	= $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		        $file_name 		= $_FILES['file_sertifikat']['name']; //uploded file name
				// $extension		= $_FILES['file_sertifikat']['file_ext'];    // uploded file extension
				$nama_filenya = $upload_data['file_name'];

	        	$data = array('nip' => $this->input->post('nip'),
	    						'nama'	=> $this->input->post('nama'),
	    						'unit'	=> $this->input->post('unit'),
	    						'kode_diklat'	=> $this->input->post('kode_diklat'),
	    						'judul_diklat'	=> $this->input->post('judul_diklat'),
	    						'kode_sertifikat'	=> $this->input->post('kode_sertifikat'),
	    						'penyelenggara'	=> $this->input->post('penyelenggara'),
	    						'tanggal_mulai_pelatihan'	=> $tanggal_mulai_pelatihan,
	    						'masa_belaku_sertifikat'	=> $masa_belaku_sertifikat,
	    						'masa_alert'	=> $this->input->post('masa_alert'),
	    						'user_update'	=> $nik,
	    						'jam_update'	=> $jam,
	    						'tanggal_update'	=> $tanggal,
	    						'file_sertifikat'	=> $nama_filenya
	   						);
	        }
	        else{
	        	$data = array('nip' => $this->input->post('nip'),
	    						'nama'	=> $this->input->post('nama'),
	    						'unit'	=> $this->input->post('unit'),
	    						'kode_diklat'	=> $this->input->post('kode_diklat'),
	    						'judul_diklat'	=> $this->input->post('judul_diklat'),
	    						'kode_sertifikat'	=> $this->input->post('kode_sertifikat'),
	    						'penyelenggara'	=> $this->input->post('penyelenggara'),
	    						'tanggal_mulai_pelatihan'	=> $tanggal_mulai_pelatihan,
	    						'masa_belaku_sertifikat'	=> $masa_belaku_sertifikat,
	    						'masa_alert'	=> $this->input->post('masa_alert'),
	    						'user_update'	=> $nik,
	    						'jam_update'	=> $jam,
	    						'tanggal_update'	=> $tanggal
	   						);
	        }

			$this->field_m->add($data);

        	$this->session->set_flashdata('message', 'Data berhasil disimpan');
			redirect('field', 'refresh');
        }
        else
        {
			$this->tambah();	
   		}
	}

	function ubah($id)
	{
		$data['box_title'] 		= 'Form Data Field';
		$data['form_action']	= site_url('field/update');
		
		$detail = $this->field_m->get_by_id($id);
		
		$this->session->set_userdata('id_sertifikat', $detail->id_sertifikat);

		$data['default']['id_sertifikat'] 			= $detail->id_sertifikat;
		$data['default']['nip'] 					= $detail->nip;
		$data['default']['nama'] 					= $detail->nama;
		$data['default']['unit'] 					= $detail->unit;
		$data['default']['kode_diklat'] 			= $detail->kode_diklat;
		$data['default']['judul_diklat'] 			= $detail->judul_diklat;
		$data['default']['kode_sertifikat'] 		= $detail->kode_sertifikat;
		$data['default']['penyelenggara'] 			= $detail->penyelenggara;
		$data['default']['tanggal_mulai_pelatihan'] = $detail->tanggal_mulai_pelatihan;
		$data['default']['masa_belaku_sertifikat'] 	= $detail->masa_belaku_sertifikat;
		$data['default']['masa_alert'] 				= $detail->masa_alert;
		$data['default']['file_sertifikat'] 	= $detail->file_sertifikat;

		$data['main_content'] = 'fields/form_v';
		$this->load->view('includes/backend', $data);
	}

	// proses edit data
	function update()
	{

		$data['main_content'] 	= 'fields/form_v';
		$data['box_title'] 		= 'Form Data Field';
		$data['form_action']	= site_url('field/update');

		$nik 		= $this->session->userdata('nik');

		$this->form_validation->set_rules('nip','NIP', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Peringatan</strong> ', '</div>');
        
        $tanggal_mulai_pelatihan	= date("Y-m-d", strtotime($this->input->post('tanggal_mulai_pelatihan')));
        $masa_belaku_sertifikat 	= date("Y-m-d", strtotime($this->input->post('masa_belaku_sertifikat')));

        if($this->form_validation->run() === TRUE) {
    		if($_FILES['file_sertifikat']['name'] != ""){
		        //upload foto
		    	//Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)	 
		        $configUpload['upload_path'] 	= FCPATH.'uploads/sertifikat/';
		        $configUpload['allowed_types'] 	= '*';
		        $configUpload['max_size'] 		= '0';
		        $this->load->library('upload', $configUpload);
		        $this->upload->do_upload('file_sertifikat');
		        
		        $upload_data 	= $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		        $file_name 		= $_FILES['file_sertifikat']['name']; //uploded file name
				// $extension		= $_FILES['file_sertifikat']['file_ext'];    // uploded file extension

				$nama_filenya = $upload_data['file_name'];

	        	$data = array('nip' => $this->input->post('nip'),
	    						'nama'	=> $this->input->post('nama'),
	    						'unit'	=> $this->input->post('unit'),
	    						'kode_diklat'	=> $this->input->post('kode_diklat'),
	    						'judul_diklat'	=> $this->input->post('judul_diklat'),
	    						'kode_sertifikat'	=> $this->input->post('kode_sertifikat'),
	    						'penyelenggara'	=> $this->input->post('penyelenggara'),
	    						'tanggal_mulai_pelatihan'	=> $tanggal_mulai_pelatihan,
	    						'masa_belaku_sertifikat'	=> $masa_belaku_sertifikat,
	    						'masa_alert'	=> $this->input->post('masa_alert'),
	    						'file_sertifikat'	=> $nama_filenya,
	    						'user_update'	=> $nik
	   						);
	        }
	        else{
	        	$data = array('nip' => $this->input->post('nip'),
	    						'nama'	=> $this->input->post('nama'),
	    						'unit'	=> $this->input->post('unit'),
	    						'kode_diklat'	=> $this->input->post('kode_diklat'),
	    						'judul_diklat'	=> $this->input->post('judul_diklat'),
	    						'kode_sertifikat'	=> $this->input->post('kode_sertifikat'),
	    						'penyelenggara'	=> $this->input->post('penyelenggara'),
	    						'tanggal_mulai_pelatihan'	=> $tanggal_mulai_pelatihan,
	    						'masa_belaku_sertifikat'	=> $masa_belaku_sertifikat,
	    						'masa_alert'	=> $this->input->post('masa_alert'),
	    						'user_update'	=> $nik
	   						);
	        }
        	
        	$this->field_m->update($this->session->userdata('id_sertifikat'), $data);
			
			$this->session->set_flashdata('message', 'Satu data berhasil diupdate!');
		
        	redirect('field', 'refresh');
 		}else{
        	$this->load->view('includes/backend', $data);
   		}

	}

	// proses delete data
	function hapus($id)
	{
 		$this->field_m->delete($id);
		$this->session->set_flashdata('message', 'Data berhasil dihapus');
		
		redirect('field', 'refresh');
 	}

	// validasi unique inputan, ketika di tambah
	function valid_caption($caption)
	{
		if ($this->field_m->valid_caption($caption) == TRUE)
		{
			$this->form_validation->set_message('caption', "Caption $caption sudah terdaftar");
			return FALSE;
		}
		else
		{			
			return TRUE;
		}
	}

	// validasi unique inputan, ketika di edit
	function valid_caption_edit()
	{
		$current_id = $this->session->userdata('id_field');
		$detail 	= $this->field_m->get_by_id($current_id);
		
		$current		= $detail->caption;
		$caption 	= $this->input->post('caption');
				
		if ($caption == $current)
		{
			return TRUE;
		}
		else
		{
			if($this->field_m->valid_caption($caption) === TRUE)
			{
				$this->form_validation->set_message('valid_caption_edit', "Caption $caption sudah terdaftar");
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}

	function download($id, $flag)
	{
		$this->load->helper('download');

		$detail = $this->field_m->get_by_id($id);
		
		$this->session->set_userdata('file_sertifikat', $detail->file_sertifikat);
		$file = $this->session->userdata('file_sertifikat');

		if ($file != "") {
			$data = file_get_contents(FCPATH.'uploads/sertifikat/'.$file.''); // Read the file's contents
			$name = $file;

			force_download($name, $data);
			if($flag == "edit"){
				redirect('field/ubah/'.$id.'');
			}else{
				redirect('field');
			}
		}else{
			$this->session->set_flashdata('message', 'File tidak ditemukan');
		
			if($flag == "edit"){
				redirect('field/ubah/'.$id.'');
			}else{
				redirect('field');
			}
		}
	}

	function report()
	{
		$conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $judul_diklat = $this->input->post('judul_diklat');
        $nama_pegawai = $this->input->post('nama_pegawai');
        $masa_expired = $this->input->post('masa_expired');
        $nip = $this->input->post('nip');
        $sortBy 		= $this->input->post('sortBy');

        if(!empty($judul_diklat)){
            $conditions['search']['judul_diklat'] = $judul_diklat;
        }
        if(!empty($nama_pegawai)){
            $conditions['search']['nama'] = $nama_pegawai;
        }
        if(!empty($masa_expired)){
            $conditions['search']['masa_alert'] = $masa_expired;
        }
        if(!empty($nip)){
            $conditions['search']['nip'] = $nip;
        }
        
        //total rows count
        $totalRec = count($this->field_m->getRows($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'field/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        // $conditions['start'] = 0;
        // $conditions['limit'] = ;
        
        //get posts data
        $data['posts'] = $this->field_m->getRows($conditions);

        $data['content'] = 'fields/excel_v';
        $contents = $this->load->view($data['content'],$data);
		
		
	}

	function listEx($masa)
	{
		$data['main_content'] 	= 'fields/list_ex_v';
		$data['box_title'] 		= 'Data Users';
		$data['query'] = $this->field_m->getAllExpired($masa);
		
		$this->load->view('includes/backend', $data);	
	}

}

/* End of file field.php */
/* Location: ./application/modules/field/controllers/field.php */