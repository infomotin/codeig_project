<?php if (!defined('BASEPATH'))exit('No direct script access allowed');


class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
    }


    public function index() {
        $this->load->view('backend/login');


    }
    public function login_check(){
        // function for Security purpose html_escape()
        $email =html_escape($this->input->post('email'));
        $password =html_escape($this->input->post('password'));
        $data = array('email' => $email, 'password' => $password);
        $query = $this->db->get_where('admin', $data);
        // $anotherFormat = $this->db->get_where('admin', array('email' => $email, 'password' => $password))->result_array();
        // check condition here
        if ($query->num_rows() > 0) {
            $row = $query->row();
            var_dump($row);
            $this->session->set_userdata('login_type', 'admin');
            $this->session->set_userdata('admin_id', $row->admin_id);
            $this->session->set_userdata('login_user_id', $row->admin_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('admin_email', $row->email);
            $this->session->set_userdata('user_email', $row->email);
            $this->session->set_userdata('terminal', $row->terminal_id);
            $this->session->set_userdata('token ', $row->token);
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_flashdata('success', 'Login Successfully');
            redirect(base_url() . 'admin/dashboard');
        } else {
            $this->session->set_flashdata('error_message', get_phrase('invalid_login_credentials'));
            redirect(base_url() . 'login', 'refresh');
        }
        

    }
   

    
}
