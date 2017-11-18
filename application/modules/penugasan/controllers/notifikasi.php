<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model(array('penugasan_m'));
	}

	function sendMail()
	{
	/*
		$config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'mail.sibaskom.com',
		  'smtp_port' => 25,
		  'smtp_user' => 'admin@sibaskom.com', // change it to yours
		  'smtp_pass' => 'P@ssw0rd',// change it to yours
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE,
		  'mailtype' => 'HTML'
		);
		$this->load->library('email', $config);
	  */      
		$this->load->library('email');
		$expired = $this->penugasan_m->get(['waktu_alert' => date('Y-m-d')]);
		$countExp = count($expired);

		$tanggal = date("m-d-Y H:i:s");

		if($countExp > 0){

			$from_email = "rikoy@live.com"; 
		   	
		   	$query_email = $this->db->query("SELECT * FROM email_notifikasi");
		   	$res_email = $query_email->row();

			$to_email = '';
		   	$to_email .= $res_email->email1;
			if($res_email->email2 != ""){
				$to_email .= ",".$res_email->email2;}
			if($res_email->email3 != ""){
				$to_email .= ",".$res_email->email3;}
			if($res_email->email4 != ""){
				$to_email .= ",".$res_email->email4;}
			if($res_email->email5 != ""){
				$to_email .= ",".$res_email->email5;}
			
		    //Load email library 
	        $messg = ""; 
			$messg .= "Ini adalah notifikasi SIMOPS (Sistem Informasi Monitoring Data Bidang Pengembangan SDM) PT PLN (Persero). \n";
			
			   foreach ($expired as $row)
			   {
			   		$messg .= "\nNama: $row->nama\nNIP: $row->nip\n";
			   }

			$messg .= "\nMasa penugasan akan segera berakhir\n\nBest Regard\nAdmin SIMOPS";
	   	$messgs = "<b>tes</b>";
	        $this->email->from($from_email, 'Admin SIMOPS'); 
	        $this->email->to($to_email);
	        $this->email->subject('Notifikasi Sertifikat SIMOPS '.$tanggal); 
	        $this->email->message($messg); 
	   
	         //Send mail 
	        if($this->email->send()){
	         	echo "berhasil";
			}
	        else{ 
	         	echo "gagal";
			}
		}
	}

}

/* End of file notifikasi.php */
/* Location: ./application/modules/field/controllers/notifikasi.php */