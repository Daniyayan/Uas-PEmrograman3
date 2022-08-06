<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller {
	
	public function index()
	{
		header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->cekLogin();
		$data['title'] = "Login";
		$this->load->view('login',$data);
	}
	public function auth()
	{
		$this->load->model('user_model');
		
		$id = $this->input->post('username');
		$password = $this->input->post('password');
		
		$login = $this->user_model->authenticate($id,$password);
		if($login)
		{
            $chek = $this->user_model->generate();
            print_r($chek);
            $this->load->view('generate');
		}
		else
		{
			
			$this->load->view('login');
		}
	}
	
	public function logout()
	{
		$this->session->unset_userdata('isLogin1');
		$this->session->unset_userdata('loginstatus');
		redirect('login');
	}
	
	public function cekLogin()
	{
		if($this->session->userdata('isLogin1'))
			redirect('dashboard');
	}

	
}
