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

		function tambah()
		{
			if ($this->POST('tambah')) {
				// validasi
				$this->form_validation->set_rules('nip','NIP', 'required');
						$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Peringatan</strong> ', '</div>');

						if($this->form_validation->run() === TRUE) {
								$data = array('nip' => $this->input->post('nip'),
								'nama'	=> $this->POST('nama'),
								'unit'	=> $this->POST('unit'),
								'tanggal_awal_masa_penugasan'	=> $this->POST('tanggal_awal_masa_penugasan'),
								'lokasi_penugasan'	=> $this->POST('lokasi_penugasan'),
								'lama_penugasan'	=> $this->POST('lama_penugasan'),
								'waktu_alert'	=> $this->POST('waktu_alert'),
								);
								$this->penugasan_m->insert($data);

										$this->session->set_flashdata('message', 'Data berhasil disimpan');
								redirect('penugasan', 'refresh');
								exit;
									}
									else
									{
								$this->tambah();
								exit;
								}
			}
			$data["main_content"] 	= "fields/form_v";
			$this->load->view("includes/backend",$data);
		}

		function ubah($id){
			$data['penugasan'] = $this->penugasan_m->get_row(['id_penugasan' => $id]);
			if (!isset($id) || !isset($data['penugasan'])) {
				redirect('penugasan');
				exit;
			}
			if ($this->POST('edit')) {
				// validasi
				$this->form_validation->set_rules('nip','NIP', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Peringatan</strong> ', '</div>');

				if($this->form_validation->run() === TRUE) {
						$data = array('nip' => $this->input->post('nip'),
						'nama'	=> $this->POST('nama'),
						'unit'	=> $this->POST('unit'),
						'tanggal_awal_masa_penugasan'	=> $this->POST('tanggal_awal_masa_penugasan'),
						'lokasi_penugasan'	=> $this->POST('lokasi_penugasan'),
						'lama_penugasan'	=> $this->POST('lama_penugasan'),
						'waktu_alert'	=> $this->POST('waktu_alert'),
						);
						$this->penugasan_m->update($id,$data);

								$this->session->set_flashdata('message', 'Data berhasil disimpan');
						redirect('penugasan', 'refresh');
						exit;
							}
							else
							{
								$this->session->set_flashdata('message', 'Error: Data gagal disimpan');
						redirect('penugasan');
						exit;
						}
			}
			$data["main_content"] 	= "fields/form-edit_v";
			$this->load->view("includes/backend",$data);
		}

		function hapus($id){
			$this->penugasan_m->delete($id);

			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			redirect('penugasan','refresh');
			exit;
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
			$sortBy = $this->input->post('sortBy');
			$lokasi_penugasan = $this->POST('lokasi_penugasan');


	        if(!empty($nama_pegawai)){
	            $conditions['search']['nama'] = $nama_pegawai;
	        }
			if(!empty($lokasi_penugasan)){
	            $conditions['search']['lokasi_penugasan'] = $lokasi_penugasan;
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

	        $data['posts'] = $this->penugasan_m->getRows($conditions);

	        $data['content'] = 'fields/excel_v';
	        $contents = $this->load->view($data['content'],$data);
		}

}

/* End of file dashboard.php */
/* Location: ./application/modules/penugasan/controllers/penugasan.php */
