<?php

class Auth_module
{
    var $CI;
    var $user_id;
    var $role_id;
    var $collegeId;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('session'); //if it's not autoloaded in your CI setup
        $admin_user_data = $this->CI->session->userdata('admin_user_data');
        $this->CI->load->model('admin_model');
        $this->CI->load->library('user_agent');
    }

    public function index()
    {
        if (!empty($this->user_id)) {

            $class = $this->CI->router->fetch_class();

            $method = $this->CI->router->fetch_method();
            $role_name = $this->getRoleName($this->role_id);

            if ($role_name) {
                $Adminpermission = $this->CI->admin_model->getPermissions($class, $role_name);
                $Adminpermission_lower = array();
                foreach ($Adminpermission as $mm_name)
                    $Adminpermission_lower[]  = strtolower($mm_name);


                if (!empty($Adminpermission)) {
                    if (in_array($method, $Adminpermission)  || in_array($method, $Adminpermission_lower)) {
                        $log_data['access'] =   'success';
                        //* all is ok here*/
                    } else  if ($class != 'dashboard' and $class != 'admin') {

                        $message = 'You don\'t have permissions to access this module. Please contact your administrator.';
                        $this->redirectMethod($message, $class);
                        $log_data['access'] =  'failed';
                    }
                } else if ($class != 'dashboard' and $class != 'admin') {
                    $message = 'You don\'t have sufficient permissions.please contact your administrator.';
                    $this->redirectMethod($message);
                    $log_data['access'] =  'not defined in db';
                }
            } else if ($class != 'dashboard' and $class != 'admin') {
                $message = 'Request role is not defined. Please contact to your administrator or mail : test@test.com .';
                $this->redirectMethod($message);
                $log_data['access'] =   'role name not defined';
            }
        }
    }

    public function redirectMethod($message, $class = '')
    {
        $message =  "<div class='alert alert-danger' role='alert'>" . $message . "</div>";
        $this->CI->session->set_flashdata('flashMessage', $message);
        if ($class == null) {
            redirect('dashboard');
        } else {
            redirect($class);
        }
    }

    public function getRoleName($id)
    {
        $master_db = $this->CI->load->database('master', TRUE);
        $result = $master_db->query("select role_name from role where id='$id'");

        $num_rows = $result->num_rows();
        if ($num_rows == 1) {
            return $result->row()->role_name;
        } else {
            return false;
        }
    }
}
