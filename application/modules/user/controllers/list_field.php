<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_field extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->library(array('form_validation', 'excel'));

		$this->load->model(array('user_m'));
	}

	function index()
	{
		
		$data['form_action']	= site_url('user/list_field/ExcelDataAdd');
		$data['main_content'] 	= 'list_fields/list_field_v';
		$data['box_title'] 		= 'Import Data Sertifikat Pegawai';
		$data['query'] = $this->user_m->getDuplicat();
		
		$this->load->view('includes/backend', $data);	
	}

	public function ExcelDataAdd()	
	{  
		$tanggal 	= date("Y-m-d");
		$jam 		= date("H:i:s");
		$nip 		= $this->session->userdata('nik');

		//Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)	 
        $configUpload['upload_path'] 	= FCPATH.'uploads/excel/';
        $configUpload['allowed_types'] 	= '*';
        $configUpload['max_size'] 		= '0';
        $this->load->library('upload', $configUpload);
        $this->upload->do_upload('userfile');
        
        $upload_data 	= $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        $file_name 		= $upload_data['file_name']; //uploded file name
		$extension		= $upload_data['file_ext'];    // uploded file extension
		
		$objReader = PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
		// $objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
        //Set to read only
        $objReader->setReadDataOnly(true); 		  
        //Load excel file
		$objPHPExcel	= $objReader->load(FCPATH.'uploads/excel/'.$file_name);		 
        $totalrows		= $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel	 
        $objWorksheet	= $objPHPExcel->setActiveSheetIndex(0);                
        //loop from first data untill last data
        for($i=2;$i<=$totalrows;$i++)
        {
            $nik				= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();			
            $password			= md5($objWorksheet->getCellByColumnAndRow(1,$i)->getValue());
			$id_level 			= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue();
			$aktif				=$objWorksheet->getCellByColumnAndRow(3,$i)->getValue();
			$full_name			=$objWorksheet->getCellByColumnAndRow(4,$i)->getValue();
			$unit				=$objWorksheet->getCellByColumnAndRow(5,$i)->getValue();
			$bagian				=$objWorksheet->getCellByColumnAndRow(6,$i)->getValue();
			$email_korporat		=$objWorksheet->getCellByColumnAndRow(7,$i)->getValue();
			$email_nonkorporat	=$objWorksheet->getCellByColumnAndRow(8,$i)->getValue();
			$no_hp				=$objWorksheet->getCellByColumnAndRow(9,$i)->getValue();

			$data=array('nik'=> $nik, 
						'password'=> $password,
						'full_name'=> $full_name,
						'unit'=> $unit,
						'bagian'=> $bagian,
						'email_korporat'=> $email_korporat,
						'email_nonkorporat'=> $email_nonkorporat,
						'no_hp'=> $no_hp,
						'id_level'=> $id_level,
						'aktif'=> $aktif,
						'tanggal_update' 	=> $tanggal, 
  						'jam_update' 		=> $jam,
  						'user_update' 		=> $nip
						);
			$this->user_m->add($data);		  
        }
        unlink('././uploads/excel/'.$file_name); //File Deleted After uploading in database .
        $this->session->set_flashdata('message', 'Data berhasil disimpan');		 
        redirect('user/list_field','refresh');   
    }

    // proses delete data
	function hapus($id)
	{
 		$this->user_m->delete($id);
		$this->session->set_flashdata('message', 'Data berhasil dihapus');
		
		redirect('user/list_field', 'refresh');
 	}
}

/* End of file list_field.php */
/* Location: ./application/modules/field/controllers/list_field.php */