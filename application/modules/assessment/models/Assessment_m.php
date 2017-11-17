<?php 

class Assessment_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'assesment';
		$this->data['primary_key']	= 'id_assesment';
	}
}