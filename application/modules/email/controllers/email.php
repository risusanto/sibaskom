<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->library(array('form_validation'));

		$this->load->model('email_m');
	}

	function ubah($id)
	{
		$data['box_title'] 		= 'Form Data Email Notifikasi';
		$data['form_action']	= site_url('email/update');
		
		$detail = $this->email_m->get_by_id($id);
		
		$this->session->set_userdata('id_email_notifikasi', $detail->id_email_notifikasi);

		$data['default']['id_email_notifikasi'] 	= $detail->id_email_notifikasi;
		$data['default']['email1'] 	= $detail->email1;
		$data['default']['email2'] 	= $detail->email2;
		$data['default']['email3'] 	= $detail->email3;
		$data['default']['email4'] 	= $detail->email4;
		$data['default']['email5'] 	= $detail->email5;

		$data['main_content'] = 'main_v';
		$this->load->view('includes/backend', $data);
	}

	// proses edit data
	function update()
	{

		$data['main_content'] 	= 'main_v';
		$data['box_title'] 		= 'Form Data Email Notifikasi';
		$data['form_action']	= site_url('email/update');

		$nip = $this->session->userdata('nik');

		$this->form_validation->set_rules('email1','Alamat email 1', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Peringatan</strong> ', '</div>');

        if($this->form_validation->run() === TRUE) {
			$data = array('email1' => $this->input->post('email1')
							,'email2' => $this->input->post('email2')
							,'email3' => $this->input->post('email3')
							,'email4' => $this->input->post('email4')
							,'email5' => $this->input->post('email5')
							,'user_update' => $nip
						);
			
			$this->email_m->update($this->session->userdata('id_email_notifikasi'), $data);
			
			$this->session->set_flashdata('message', 'Data berhasil diupdate!');
		
        	redirect('email/ubah/1', 'refresh');
 		}else{
        	$this->load->view('includes/backend', $data);
   		}

	}

}

/* End of file email.php */
/* Location: ./application/modules/email/controllers/email.php */