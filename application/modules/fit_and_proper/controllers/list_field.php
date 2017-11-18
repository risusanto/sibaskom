<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_field extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->library(array('form_validation', 'excel'));

		$this->load->model(array('fit_and_proper_m'));
	}

	function index()
	{
		
		$data['form_action']	= site_url('fit_and_proper/list_field/ExcelDataAdd');
		$data['main_content'] 	= 'fields/list_field_v';
		$data['box_title'] 		= 'Import Data';
		
		$this->load->view('includes/backend', $data);	
	}

	public function ExcelDataAdd()	
	{ 
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
            $nip					= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();			
            $nama					= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue();
			$unit 					= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue();
			$job_suksesi			=$objWorksheet->getCellByColumnAndRow(3,$i)->getValue();
			$penguji			=$objWorksheet->getCellByColumnAndRow(4,$i)->getValue();
			$hasil_fit_and_proper		=$objWorksheet->getCellByColumnAndRow(5,$i)->getValue();

			$data=array('nip'=> $nip, 
						'nama'=> $nama,
						'unit'=> $unit,
						'job_suksesi'=> $job_suksesi,
						'penguji'=> $penguji,
						'hasil_fit_and_proper'=> $hasil_fit_and_proper
						);
			$this->fit_and_proper_m->insert($data);		  
        }
        unlink('././uploads/excel/'.$file_name); //File Deleted After uploading in database .
        $this->session->set_flashdata('message', 'Data berhasil disimpan');		 
        redirect('fit_and_proper','refresh');   
    }
}

/* End of file list_field.php */
/* Location: ./application/modules/field/controllers/list_field.php */