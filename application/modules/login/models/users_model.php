<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	function validate()
	{
		$this->db->where('nik', $this->input->post('nik'));
		$this->db->where('password', md5($this->input->post('password')));
		$this->db->where('aktif', '1');

		$query = $this->db->get('users');
		
		if($query->num_rows == 1)
		{
			foreach($query->result() as $qad)
			{
				$sess_data['level'] 	= $qad->id_level;
				$sess_data['nama'] 		= $qad->full_name;
				$sess_data['nik'] 		= $qad->nik;
				$sess_data['id_users'] 	= $qad->id_user;
				$sess_data['unit'] 		= $qad->unit;
				$this->session->set_userdata($sess_data);
			}

			return true;
		}
		
	}

	function validate_resetpassword()
	{
		$this->db->where('nik', $this->input->post('nik'));
		$this->db->where('email_korporat !=', '');

		$query = $this->db->get('users');
		
		if($query->num_rows == 1)
		{
			foreach($query->result() as $qad)
			{
				$sess_data['nama_forget'] 		= $qad->full_name;
				$sess_data['nik_forget'] 		= $qad->nik;
				$sess_data['iduser_forget'] 		= $qad->id_user;
				$sess_data['email_korporat'] 	= $qad->email_korporat;
				$this->session->set_userdata($sess_data);
			}

			return true;
		}
	}

}

/* End of file users_model.php */
/* Location: ./application/modules/login/models/users_model.php */