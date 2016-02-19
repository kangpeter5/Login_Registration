<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Users extends CI_Controller {

	protected $view_data = array();
	protected $user_session = NULL;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
	{
		$this->load->view('main');
	}

	//register the user
	public function login()
    {
    	$this->load->library("form_validation");

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() === FALSE)
		{
		    $this->session->set_flashdata("login_error", "Invalid email or password");
		    redirect('/users/index');
		}
		else
		{
		    $email = $this->input->post('email');
		    $user = $this->user_model->get_user_by_email($email);
        	$password = md5($this->input->post('password'));

        	if($user && $user['password'] == $password)
        	{
	            $user = array(
	            	'first_name' => $user['first_name'],
	            	'last_name' => $user['last_name'],
	            	'email' => $user['email'],
	               	'is_logged_in' => TRUE
	            );
	            $this->session->set_userdata($user);
	            redirect("/users/profile");
	        }
	        else 
	        {
		    	$this->session->set_flashdata("login_error", "Invalid email or password");
	        	redirect('/users/index');
	        }
		}
    }

    public function register()
    {
    	$this->load->library("form_validation");

   		$this->form_validation->set_rules("first_name", "First Name", "trim|required");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required");
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|required|matches[confirm_password]|md5');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|md5');

		if($this->form_validation->run() === FALSE)
		{
		    $this->session->set_flashdata("registration_error", validation_errors());
		    redirect('/users/index');
		}
		else
		{
		    $first_name = $this->input->post('first_name');
		    $last_name = $this->input->post('last_name');
		    $email = $this->input->post('email');
        	$password = md5($this->input->post('password'));

        	$post = $this->input->post();
			$registered_user = $this->user_model->register_user($post);


			$this->session->set_flashdata("registered_user", $post);
			redirect('/users/profile');
		}
    }

    public function profile()
    {
    	// var_dump($this->session->all_userdata()); die();
    	$user = $this->user_model->get_user_by_email($this->session->userdata("email"));
	    // var_dump($user); die();
	    $info["user"] = $user;
    	$this->load->view('profile', $info);
    }
    //logout the user
    public function logout()
    {
        $this->session->sess_destroy();
        redirect("/users/index");   
    }
}
