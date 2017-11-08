<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->library(array('form_validation'));

		$this->load->model(array('user_m', 'login/users_model'));
	}

	function index()
	{
		$data['main_content'] 	= 'user_v';
		$data['box_title'] 		= 'Data Users';
		$data['query'] = $this->user_m->getAll();
		
		$this->load->view('includes/backend', $data);	
	}

	function tambah()
	{
		$data["main_content"] 	= "form_v";
		$data['box_title'] 		= 'Form Data User';
		$data['form_action']	= site_url('user/insert');

		$this->load->view("includes/backend",$data);
	}

	function insert()
	{
		$tanggal 	= date("Y-m-d");
		$jam 		= date("H:i:s");
		$nik 		= $this->session->userdata('nik');
		// validasi
		$this->form_validation->set_rules('nik','NIK', 'required|callback_valid_nik');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Peringatan</strong> ', '</div>');
        if($this->form_validation->run() === TRUE) {

    		if($_FILES['photo']['name'] != ""){
		        //upload foto
		    	//Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)	 
		        $configUpload['upload_path'] 	= FCPATH.'uploads/photo/';
		        $configUpload['allowed_types'] 	= '*';
		        $configUpload['max_size'] 		= '0';
		        $this->load->library('upload', $configUpload);
		        $this->upload->do_upload('photo');
		        
		        $upload_data 	= $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		        $file_name 		= $upload_data['file_name']; //uploded file name
				$extension		= $upload_data['file_ext'];    // uploded file extension

			    $data = array('nik' 		=> $this->input->post('nik'),
							'password' 			=> md5($this->input->post('password')),
							'full_name' 		=> $this->input->post('full_name'),
							'id_level' 			=> $this->input->post('id_level'),
							'aktif' 			=> (($this->input->post('aktif') == 'on') ? '1' : '0' ),
							'unit' 				=> $this->input->post('unit'),
							'bagian' 			=> $this->input->post('bagian'),
							'email_korporat' 	=> $this->input->post('email_korporat'),
							'email_nonkorporat' => $this->input->post('email_nonkorporat'),
							'no_hp' 			=> $this->input->post('no_hp'),
							'photo' 			=> $file_name,
							'tanggal_update' 	=> $tanggal, 
      						'jam_update' 		=> $jam,
      						'user_update' 		=> $nik
					);
		        
		    }
			else
			{
	        	$data = array('nik' 				=> $this->input->post('nik'),
	   							'password' 			=> md5($this->input->post('password')),
	   							'full_name' 		=> $this->input->post('full_name'),
	   							'id_level' 			=> $this->input->post('id_level'),
	   							'aktif' 			=> (($this->input->post('aktif') == 'on') ? '1' : '0' ),
	   							'unit' 				=> $this->input->post('unit'),
	   							'bagian' 			=> $this->input->post('bagian'),
	   							'email_korporat' 	=> $this->input->post('email_korporat'),
	   							'email_nonkorporat' => $this->input->post('email_nonkorporat'),
	   							'no_hp' 			=> $this->input->post('no_hp'),
	   							'tanggal_update' 	=> $tanggal, 
      							'jam_update' 		=> $jam,
      							'user_update' 		=> $nik
							);
	        }	

	        $this->user_m->add($data);
        	$this->session->set_flashdata('message', 'Data berhasil disimpan');
			redirect('user', 'refresh');
        }
        else
        {
			$this->tambah();	
   		}
	}

	function profile($nik, $id)
	{
		$data['box_title'] 		= 'Form Data User';
		$data['form_action']	= site_url('user/update');
		
		$detail = $this->user_m->get_by_id($id);
		
		$this->session->set_userdata('id_user', $detail->id_user);

		$data['default']['id_user'] 	= $detail->id_user;
		$data['default']['full_name'] 	= $detail->full_name;
		$data['default']['nik'] 		= $detail->nik;
		$data['default']['aktif'] 		= $detail->aktif;
		$data['default']['id_level'] 	= $detail->id_level;
		$data['default']['unit'] 				= $detail->unit;
		$data['default']['bagian'] 				= $detail->bagian;
		$data['default']['email_korporat'] 		= $detail->email_korporat;
		$data['default']['email_nonkorporat'] 	= $detail->email_nonkorporat;
		$data['default']['no_hp'] 				= $detail->no_hp;
		$data['default']['photo'] 				= $detail->photo;
		$data['default']['flag'] 				= "profile";

		$data['main_content'] = 'form_v';
		$this->load->view('includes/backend', $data);
	}

	function changepassword($nik, $id)
	{
		$data['box_title'] 		= 'Form Change Password';
		$data['form_action']	= site_url('user/update_password');
		
		$detail = $this->user_m->get_by_id($id);
		
		$this->session->set_userdata('id_user', $detail->id_user);

		$data['default']['id_user'] 	= $detail->id_user;
		$data['default']['nik'] 	= $detail->nik;
		$data['default']['flag'] 				= "profile";

		$data['main_content'] = 'password_v';
		$this->load->view('includes/backend', $data);
	}

	function resetpassword($nik, $id)
	{
		$data['box_title'] 		= 'Form Change Password';
		$data['form_action']	= site_url('user/update_password');
		
		$detail = $this->user_m->get_by_id($id);
		
		$this->session->set_userdata('id_user', $detail->id_user);

		$data['default']['id_user'] = $detail->id_user;
		$data['default']['nik'] 	= $detail->nik;
		$data['default']['flag'] 	= "resetpassword";

		$data['main_content'] = 'password_v';
		$this->load->view('includes/backend', $data);
	}

	function update_password()
	{
		$query = $this->users_model->validate();
		
		$nik = $this->input->post('nik');
		$id_user = $this->input->post('id_user');
		$flag = $this->input->post('flag');

		if($flag == "resetpassword")
		{
				$data = array('password' => md5($this->input->post('password_baru')));
		        
				$this->user_m->update($this->session->userdata('id_user'), $data);
				
				$this->session->set_flashdata('message', 'Satu data berhasil diupdate!');

				redirect('user', 'refresh');
				
		}
		else
		{
		
			if($query) // if the user's credentials validated...
			{
				$data = array('password' => md5($this->input->post('password_baru')));
		        
				$this->user_m->update($this->session->userdata('id_user'), $data);
				
				$this->session->set_flashdata('message', 'Satu data berhasil diupdate!');

				if($flag == "profile")
				{
		        	redirect('dashboard', 'refresh');
				}else{
		        	redirect('user', 'refresh');
				}
			}
			else // incorrect username or password
			{
				$this->session->set_flashdata('message', 'Password lama tidak sesuai');
				redirect('user/changepassword/'.$nik.'/'.$id_user.'', 'refresh');
			}
		}

	}

	function ubah($id)
	{
		$data['box_title'] 		= 'Form Data User';
		$data['form_action']	= site_url('user/update');
		
		$detail = $this->user_m->get_by_id($id);
		
		$this->session->set_userdata('id_user', $detail->id_user);

		$data['default']['id_user'] 	= $detail->id_user;
		$data['default']['full_name'] 	= $detail->full_name;
		$data['default']['nik'] 		= $detail->nik;
		$data['default']['aktif'] 		= $detail->aktif;
		$data['default']['id_level'] 	= $detail->id_level;
		$data['default']['unit'] 				= $detail->unit;
		$data['default']['bagian'] 				= $detail->bagian;
		$data['default']['email_korporat'] 		= $detail->email_korporat;
		$data['default']['email_nonkorporat'] 	= $detail->email_nonkorporat;
		$data['default']['no_hp'] 				= $detail->no_hp;
		$data['default']['photo'] 				= $detail->photo;

		$data['main_content'] = 'form_v';
		$this->load->view('includes/backend', $data);
	}

	// proses edit data
	function update()
	{

		$data['main_content'] 	= 'form_v';
		$data['box_title'] 		= 'Form Data User';
		$data['form_action']	= site_url('user/update');

		$nik 		= $this->session->userdata('nik');

		$flag = $this->input->post('flag');

		$this->form_validation->set_rules('nik','NIK', 'required|callback_valid_nik_edit');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Peringatan</strong> ', '</div>');

        if($this->form_validation->run() === TRUE) {
        	if($_FILES['photo']['name'] != ""){
		        //upload foto
		    	//Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)	 
		        $configUpload['upload_path'] 	= FCPATH.'uploads/photo/';
		        $configUpload['allowed_types'] 	= '*';
		        $configUpload['max_size'] 		= '0';
		        $this->load->library('upload', $configUpload);
		        $this->upload->do_upload('photo');
		        
		        $upload_data 	= $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		        $file_name 		= $upload_data['file_name']; //uploded file name
				$extension		= $upload_data['file_ext'];    // uploded file extension

			    $data = array('nik' 		=> $this->input->post('nik'),
							'full_name' 		=> $this->input->post('full_name'),
							'id_level' 			=> $this->input->post('id_level'),
							'aktif' 			=> (($this->input->post('aktif') == 'on') ? '1' : '0' ),
							'unit' 				=> $this->input->post('unit'),
							'bagian' 			=> $this->input->post('bagian'),
							'email_korporat' 	=> $this->input->post('email_korporat'),
							'email_nonkorporat' => $this->input->post('email_nonkorporat'),
							'no_hp' 			=> $this->input->post('no_hp'),
							'photo' 			=> $file_name,
							'user_update' 		=> $nik
					);
		    }
			else
			{
	        	$data = array('nik' 				=> $this->input->post('nik'),
	   							'full_name' 		=> $this->input->post('full_name'),
	   							'id_level' 			=> $this->input->post('id_level'),
	   							'aktif' 			=> (($this->input->post('aktif') == 'on') ? '1' : '0' ),
	   							'unit' 				=> $this->input->post('unit'),
	   							'bagian' 			=> $this->input->post('bagian'),
	   							'email_korporat' 	=> $this->input->post('email_korporat'),
	   							'email_nonkorporat' => $this->input->post('email_nonkorporat'),
	   							'no_hp' 			=> $this->input->post('no_hp'),
	   							'user_update' 		=> $nik
							);
	        }	
			$this->user_m->update($this->session->userdata('id_user'), $data);
			
			$this->session->set_flashdata('message', 'Satu data berhasil diupdate!');

			if($flag == "profile")
			{
	        	redirect('dashboard', 'refresh');
			}else{
	        	redirect('user', 'refresh');
			}
 		}else{

 			$id = $this->session->userdata('id_user');

 			$detail = $this->user_m->get_by_id($id);
		
			$data['default']['id_user'] 	= $detail->id_user;
			$data['default']['full_name'] 	= $detail->full_name;
			$data['default']['nik'] 		= $detail->nik;
			$data['default']['aktif'] 		= $detail->aktif;
			$data['default']['id_level'] 	= $detail->id_level;
			$data['default']['unit'] 				= $detail->unit;
			$data['default']['bagian'] 				= $detail->bagian;
			$data['default']['email_korporat'] 		= $detail->email_korporat;
			$data['default']['email_nonkorporat'] 	= $detail->email_nonkorporat;
			$data['default']['no_hp'] 				= $detail->no_hp;
			$data['default']['photo'] 				= $detail->photo;

        	$this->load->view('includes/backend', $data);
   		}

	}

	// proses delete data
	function hapus($id)
	{
 		$detail = $this->user_m->get_by_id($id);
 		$file_name = $detail->photo;
 		if(isset($detail->photo)){
 			unlink('././uploads/photo/'.$file_name); //File Deleted After uploading in database .
 		}
 		$this->user_m->delete($id);

		$this->session->set_flashdata('message', 'Data berhasil dihapus');
		
		redirect('user', 'refresh');
 	}

	// validasi unique inputan, ketika di tambah
	function valid_nik($nik)
	{
		if ($this->user_m->valid_nik($nik) == TRUE)
		{
			$this->form_validation->set_message('valid_nik', "NIK $nik sudah terdaftar");
			return FALSE;
		}
		else
		{			
			return TRUE;
		}
	}

	// validasi unique inputan, ketika di edit
	function valid_nik_edit()
	{
		$current_id = $this->session->userdata('id_user');
		$detail = $this->user_m->get_by_id($current_id);
		
		$current		= $detail->nik;
		$nik 	= $this->input->post('nik');
				
		if ($nik == $current)
		{
			return TRUE;
		}
		else
		{
			if($this->user_m->valid_nik($nik) === TRUE)
			{
				$this->form_validation->set_message('valid_nik_edit', "NIK $nik sudah terdaftar");
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}

}

/* End of file user.php */
/* Location: ./application/modules/user/controllers/user.php */