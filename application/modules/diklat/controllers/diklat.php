<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diklat extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->library(array('form_validation', 'Ajax_pagination'));

		$this->load->model(array('diklat_m','email_notifikasi_m'));
		$this->perPage = 5;
	}

  function index()
	{
		$this->checkExp();
		$totalRec = count($this->diklat_m->getRows());

		//pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'diklat/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);

		$data['main_content'] 	= 'fields/diklat_v';
		$data['form_action'] 	= 'diklat/report';
		$data['box_title'] 		= 'Data Diklat Pegawai';

		//get the posts data
        $data['posts'] = $this->diklat_m->getRows(array('limit'=>$this->perPage));


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

        $nip = $this->input->post('nip');
        $sortBy 		= $this->input->post('sortBy');

        if(!empty($judul_diklat)){
            $conditions['search']['judul_diklat'] = $judul_diklat;
        }
        if(!empty($nama_pegawai)){
            $conditions['search']['nama'] = $nama_pegawai;
        }
        if(!empty($nip)){
            $conditions['search']['nip'] = $nip;
        }

        //total rows count
        $totalRec = count($this->diklat_m->getRows($conditions));

        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'diklat/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

        //get posts data
        $data['posts'] = $this->diklat_m->getRows($conditions);
        $data['box_title'] 		= 'Data Diklat Pegawai';
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

						if($this->form_validation->run() === TRUE) {

							if($_FILES['file_sertifikat']['name'] != ""){
								//upload foto
							//Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)
								$configUpload['upload_path'] 	= FCPATH.'uploads/diklat/';
								$configUpload['allowed_types'] 	= '*';
								$configUpload['max_size'] 		= '0';
								$this->load->library('upload', $configUpload);
								$this->upload->do_upload('file_sertifikat');

								$upload_data 	= $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
								$nama_filenya = $upload_data['file_name'];

								$data = array('nip' => $this->POST('nip'),
											'nama'	=> $this->POST('nama'),
											'unit'	=> $this->POST('unit'),
											'tanggal_awal_berlaku'	=> $this->POST('tanggal_awal_berlaku'),
											'tanggal_akhir_berlaku'	=> $this->POST('tanggal_akhir_berlaku'),
											'judul_diklat'	=> $this->POST('judul_diklat'),
											'no_sertifikat'	=> $this->POST('no_sertifikat'),
											'lembaga_penyelenggara'	=> $this->POST('lembaga_penyelenggara'),
											'waktu_alert'	=> $this->POST('waktu_alert'),
											'file_sertifikat'	=> $nama_filenya
										);
							}
							else{
								$data = array('nip' => $this->input->post('nip'),
								'nama'	=> $this->POST('nama'),
								'unit'	=> $this->POST('unit'),
								'tanggal_awal_berlaku'	=> $this->POST('tanggal_awal_berlaku'),
								'tanggal_akhir_berlaku'	=> $this->POST('tanggal_akhir_berlaku'),
								'judul_diklat'	=> $this->POST('judul_diklat'),
								'no_sertifikat'	=> $this->POST('no_sertifikat'),
								'lembaga_penyelenggara'	=> $this->POST('lembaga_penyelenggara'),
								'waktu_alert'	=> $this->POST('waktu_alert'),
								);
							}

					$this->diklat_m->insert($data);

							$this->session->set_flashdata('message', 'Data berhasil disimpan');
					redirect('diklat', 'refresh');
					exit;
						}
						else
						{
					$this->tambah();
					exit;
					}
			}
			$data["main_content"] 	= "fields/form_v";
			$data['box_title'] 		= 'Form Diklat Pegawai';
			$data['form_action']	= site_url('diklat/insert');

			$this->load->view("includes/backend",$data);
		}

		function ubah($id){
			$data['diklat'] = $this->diklat_m->get_row(['id_diklat' => $id]);
			if(!isset($id) || !isset($data['diklat'])){
				redirect('diklat');
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

							if($_FILES['file_sertifikat']['name'] != ""){
								//upload foto
							//Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)
								$configUpload['upload_path'] 	= FCPATH.'uploads/diklat/';
								$configUpload['allowed_types'] 	= '*';
								$configUpload['max_size'] 		= '0';
								$this->load->library('upload', $configUpload);
								$this->upload->do_upload('file_sertifikat');

								$upload_data 	= $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
								$nama_filenya = $upload_data['file_name'];

								$data = array('nip' => $this->POST('nip'),
											'nama'	=> $this->POST('nama'),
											'unit'	=> $this->POST('unit'),
											'tanggal_awal_berlaku'	=> $this->POST('tanggal_awal_berlaku'),
											'tanggal_akhir_berlaku'	=> $this->POST('tanggal_akhir_berlaku'),
											'judul_diklat'	=> $this->POST('judul_diklat'),
											'no_sertifikat'	=> $this->POST('no_sertifikat'),
											'lembaga_penyelenggara'	=> $this->POST('lembaga_penyelenggara'),
											'waktu_alert'	=> $this->POST('waktu_alert'),
											'file_sertifikat'	=> $nama_filenya
										);
							}
							else{
								$data = array('nip' => $this->input->post('nip'),
								'nama'	=> $this->POST('nama'),
								'unit'	=> $this->POST('unit'),
								'tanggal_awal_berlaku'	=> $this->POST('tanggal_awal_berlaku'),
								'tanggal_akhir_berlaku'	=> $this->POST('tanggal_akhir_berlaku'),
								'judul_diklat'	=> $this->POST('judul_diklat'),
								'no_sertifikat'	=> $this->POST('no_sertifikat'),
								'lembaga_penyelenggara'	=> $this->POST('lembaga_penyelenggara'),
								'waktu_alert'	=> $this->POST('waktu_alert'),
								);
							}

					$this->diklat_m->update($id,$data);

							$this->session->set_flashdata('message', 'Data berhasil diubah');
					redirect('diklat', 'refresh');
					exit;
						}
						else
						{
						$this->session->set_flashdata('message', 'Error: Data gagal diupdate');
						redirect('diklat', 'refresh');
						exit;
						}
			}
			$data['main_content'] = 'fields/form-edit_v';
			$this->load->view('includes/backend', $data);
		}

		function hapus($id){
			$this->diklat_m->delete($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');

			redirect('diklat', 'refresh');
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
					$judul_diklat = $this->POST('judul_diklat');

	        if(!empty($nama_pegawai)){
	            $conditions['search']['nama'] = $nama_pegawai;
	        }
					if(!empty($judul_diklat)){
	            $conditions['search']['judul_diklat'] = $judul_diklat;
	        }
	        if(!empty($nip)){
	            $conditions['search']['nip'] = $nip;
	        }

	        //total rows count
	        $totalRec = count($this->diklat_m->getRows($conditions));

	        //pagination configuration
	        $config['target']      = '#postList';
	        $config['base_url']    = base_url().'diklat/ajaxPaginationData';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'searchFilter';
	        $this->ajax_pagination->initialize($config);

	        $data['posts'] = $this->diklat_m->getRows($conditions);

	        $data['content'] = 'fields/excel_v';
	        $contents = $this->load->view($data['content'],$data);
		}

		function download($id){
			$this->load->helper('download');
			$detail = $this->diklat_m->get_row(['id_diklat' => $id]);
			if (!isset($id) || !isset($detail)) {
				redirect('diklat');
				exit;
			}
			$file = $detail->file_sertifikat;
			$data = file_get_contents(FCPATH.'uploads/diklat/'.$file.''); // Read the file's contents
			$name = $file;

			if (force_download($name, $data)) {
				# code...
			} else {
				# code...
				$this->session->set_flashdata('message', 'File tidak ditemukan');
				redirect('diklat','refresh');
				exit;
			}
		}

		function checkExp(){
			$data['expired'] = $this->diklat_m->get(['waktu_alert' => date('Y-m-d')]);
			if (count($data['expired']) > 0) {	
				foreach ($data['expired'] as $row) {
					$this->send_notification($row->nama,$row->nip,$row->tanggal_akhir_berlaku);
				}
			}else{
				echo '';
			}
		}

		private function send_notification($nama,$nip,$tanggal_akhir_berlaku){
			$email = $this->email_notifikasi_m->get_row(['id_email_notifikasi' => 1]);
			$this->load->library('my_phpmailer');
			$mail = new PHPMailer();
			$mail->IsSMTP();
	        $mail->SMTPAuth   = true;
	        $mail->SMTPSecure = "ssl";
	        $mail->Host       = "smtp.zoho.com";
	        $mail->Port       = 465;
	        $mail->Username   = "noreply@techphoria.web.id";  //isi dengan email untuk mengirim
	        $mail->Password   = "minimal8"; //isi dengan password email untuk mengirim
	        $mail->SetFrom($mail->Username, 'Notifikasi SIMOPS');
	        $mail->Subject    = 'Masa Berlaku Sertifikat Diklat Akan Berakhir';
			$mail->Body       = 'Masa berlaku sertifikat diklat pegawai dengan Nama: '.$nama.', NIP: '.$nip.', akan berakhir pada '. date("d-m-Y", strtotime($tanggal_akhir_berlaku));
			if ($email->email1 != '') {
				$mail->AddAddress($email->email1);
				$mail->Send();
			}
			if ($email->email2 != '') {
				$mail->AddAddress($email->email2);
				$mail->Send();
			}
			if ($email->email3 != '') {
				$mail->AddAddress($email->email3);
				$mail->Send();
			}
			if ($email->email4 != '') {
				$mail->AddAddress($email->email14);
				$mail->Send();
			}
			if ($email->email5 != '') {
				$mail->AddAddress($email->email5);
				$mail->Send();
			}
		}
}
