<?php
defined('BASEPATH') or exit('No direct script access allowed');
//import library dari Format dan REST_Controller
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/REST_Controller.php';

// use chriskacerguis\RestServer\REST_Controller;
//extends class dari REST_Controller
class Test_api extends REST_Controller
{
    public function index_get()
    {
        //testing response
        $response['status'] = true;
        $response['message'] = 'Tes Response';
        //menampilkan response
        $this->response($response);
    }
    public function user_get()
    {
        //testing response
        $response['error'] = false;
        $response['user']['username'] = 'Peter';
        $response['user']['email'] = 'peter@poltekpos.ac.id';
        $response['user']['detail']['fullname'] = 'Peter Holland';
        $response['user']['detail']['role'] = 'Programmer';
        $response['user']['detail']['joined_date'] = '2020-02-02';
        //menampilkan response
        $this->response($response);
    }
}
