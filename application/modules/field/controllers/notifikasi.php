<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model(array('field_m'));
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
		$jml3Bulan 	= $this->field_m->countExpired(3);
		$jml6Bulan 	= $this->field_m->countExpired(6);
		$jml12Bulan = $this->field_m->countExpired(12);

		$tanggal = date("m-d-Y H:i:s");

		if($jml12Bulan > 0 || $jml6Bulan > 0 || $jml3Bulan > 0){

			$query_getEx = $this->db->query("SELECT * FROM sertifikat WHERE (masa_alert = 3 AND CURDATE() >= masa_belaku_sertifikat + INTERVAL 3 MONTH) OR (masa_alert = 6 AND CURDATE() >= masa_belaku_sertifikat + INTERVAL 6 MONTH) OR (masa_alert = 12 AND CURDATE() >= masa_belaku_sertifikat + INTERVAL 12 MONTH)");

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
	        $messg .= "Ini adalah notifikasi SI BASKOM (aplikaSI dataBASe KOMpetensi) PT PLN (Persero). \n";

	        if ($query_getEx->num_rows() > 0)
			{
			   foreach ($query_getEx->result() as $row)
			   {
			   		$messg .= "\nNo Sertifikat: $row->kode_sertifikat\nNama: $row->nama\nNIP: $row->nip\nJudul Diklat: $row->judul_diklat\nBerakhir pada: ".date("d-m-Y", strtotime($row->masa_belaku_sertifikat))."\n";
			   }
			}

			$messg .= "\nSilahkan ajukan diklat untuk pembaruan Sertifikasi Kompetensi\n\nBest Regard\nAdmin SI BASKOM";
	   	$messgs = "<b>tes</b>";
	        $this->email->from($from_email, 'Admin SI BASKOM'); 
	        $this->email->to($to_email);
	        $this->email->subject('Notifikasi Sertifikat SI BASKOM '.$tanggal); 
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