<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Admin extends CI_Controller
	{
		function __construct(){
			session_start();
			parent::__construct();
		}
		
		public function index()
		{
			if(isset($_SESSION['userName']))
			{
				$data['page'] = "admin";
				$this->load->view('adminHeader_view', $data);
				$this->load->view('admin_view');
			}
			else
			{
				// echo sha1('mypassword'); die(); // This echos the word 'mypassword' as it looks after sha1 encryption
				$this->load->library('form_validation');
				// $this->form_validation->set_rules('emailAddress', 'Email Address', 'required | valid_email');
				$this->form_validation->set_rules('userName', 'User Name', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

				if($this->form_validation->run() !== false)
				{
					$this->load->model('admin_model');
					$credentials = $this->admin_model->verifyUser(
								$this->input->post('userName'), 
								$this->input->post('password')
							);

					if($credentials !== false)
					{
						$_SESSION['userName'] = $this->input->post('userName');
						//redirect('manageGallery');
						$data['page'] = "admin";
						$this->load->view('adminHeader_view', $data);
						$this->load->view('admin_view');
					}
					else
					{
						$data['loginFailed'] = "Login Failed. Please try again.";
						$this->load->view('login_view', $data);
					}
					
				}
				else // If the form doesn't validate, reload the view so validation_errors() cna be shown.
				{
					$this->load->view('login_view');
				}
			}
			
			
		}

		public function logout()
		{
			session_destroy();
			redirect(''); // leave empty to redirect to homepage
		}
	}