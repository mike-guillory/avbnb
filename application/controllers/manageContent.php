<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	class ManageContent extends CI_Controller
	{
		public function index()
		{			
			session_start();

			if(!isset($_SESSION['userName']))
			{
				redirect('admin');
			}
			else
			{
				$this->load->model('Content_model');
				$d['page'] = "content";
				$data = $this->Content_model->getContent();
				$this->load->view('adminHeader_view', $d);
				$this->load->view('manageContent_view',$data);				
			}		
		}

		function updateContent()
		{
			$this->load->model('content_model');
			$this->content_model->updateContent();

			redirect('manageContent');
		}
	}

		