<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	function is_logged_in()
	{
		$CI =& get_instance();
		$is_logged_in = $CI->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			// echo 'You don\'t have permission to access this page. <a href="'.base_url().'index.php/login">Login</a>';	
			// die();		
			redirect('login');
		}		
	}	
	
	
	// function is_logged_in()
	// {
	// 	$CI =& get_instance();
	// 	$ss = $CI->session->userdata('is_logged_in');

	// 	if($ss != '')
	// 	{
	// 	    return TRUE;
	// 	}
	// 	return FALSE;
	// 	//return true;
	// }