<?php

class Login extends CI_Controller {
	
	function index()
	{
		$data['main_content'] = 'login_form';
		$this->load->view('includes/template', $data);		
	}
	
	function validate_credentials()
	{		
		$this->load->model('users_model');

		$query = $this->users_model->validate();
		
		if($query) // if the user's credentials validated...
		{
			$data = array(
				'is_logged_in' 	=> true
			);
			$this->session->set_userdata($data);
			redirect('dashboard');
		}
		else // incorrect username or password
		{
			$this->session->set_flashdata('message', 'NIP atau Password tidak sesuai');
			redirect('login', 'refresh');
		}
	}	

	function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}

	function forgetpassword()
	{
		$data['main_content'] = 'forget_form';
		$this->load->view('includes/template', $data);		
	}

	function sendResetPassword()
	{
		$this->load->model('users_model');

		$query = $this->users_model->validate_resetpassword();
		
		if($query) // if the user's credentials validated...
		{
			$from_email = "admin@sibaskom.com"; 
		         $to_email = $this->session->userdata('email_korporat'); 
		         $nama = $this->session->userdata('nama_forget');
		         $iduser_forget = $this->session->userdata('iduser_forget');
		   	$random = substr( md5(rand()), 0, 7);
		   	
		         //Load email library 
		         $this->load->library('email');
		         
		         $messg = "Dear $nama,\n\nAnda telah meminta untuk mereset password. Silahkan gunakan password ini untuk mengakses website SIBASKOM. Password baru Anda $random\n\nBest Regard\nAdmin SI BASKOM";
		   
		         $this->email->from($from_email, 'Admin SI BASKOM'); 
		         $this->email->to($to_email);
		         $this->email->subject('Reset Password SI BASKOM'); 
		         $this->email->message($messg); 
		   
		         //Send mail 
		         if($this->email->send()){
		         	$data = array(
				               'password' => md5($random)
				            );
				
				$this->db->where('id_user', $iduser_forget);
				$this->db->update('users', $data); 
				
		         	$this->session->set_flashdata('message', 'Silahkan cek email korporat anda.');
				redirect('login', 'refresh');
				$this->session->sess_destroy();
			}
		         else{ 
			        $this->session->set_flashdata('message', 'NIP atau Email anda belum terdaftar');
				redirect('login', 'refresh');
				$this->session->sess_destroy();
			}
		        // $this->index();
		}
		else // incorrect username or password
		{
			$this->session->set_flashdata('message', 'Reset Password Gagal, silahkan kontak admin.');
			// echo "gagal";
			redirect('login/forgetpassword', 'refresh');
		}
	}

	/*
	function signup()
	{
		$data['main_content'] = 'signup_form';
		$this->load->view('includes/template', $data);
	}
	

	function create_member()
	{
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('signup_form');
		}
		
		else
		{			
			$this->load->model('membership_model');
			
			if($query = $this->membership_model->create_member())
			{
				$data['main_content'] = 'signup_successful';
				$this->load->view('includes/template', $data);
			}
			else
			{
				$this->load->view('signup_form');			
			}
		}
		
	}
	*/

}