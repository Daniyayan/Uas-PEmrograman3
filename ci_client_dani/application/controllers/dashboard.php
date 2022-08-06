<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'core/Admin_Controller.php');

class Dashboard extends Admin_Controller {

	public function index()
	{
		$data['title'] = "DASHBOARD";
		$data['layout'] = "dashboard";
		
		$this->load->view('template',$data);
	}
}