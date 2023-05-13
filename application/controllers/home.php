<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


	class Home extends CI_Controller
	{
		public function index()
		{
			$data = array('title' => "Arbourview Bed and Breakfast&#44; St Catharines&#44; Ontario");
			$data['description'] = "Friendly, beautiful, quiet and comfortable, Arbourview is located in St Catharines, Ontario, in the beautiful Niagara Falls Region. Nearby points of interest...";
			$this->load->view('header_view', $data); 

			$this->load->model('Gallery_model');
			$data['images'] = $this->Gallery_model->getGallery();
			$this->load->model('Content_model');
			$data['price'] = $this->Content_model->getContent()->price;	
			$data['homepageParagraph'] = $this->Content_model->getContent()->homepageParagraph;
			$this->load->view('left_column_view', $data);

			$this->load->view('home_view');
			$this->load->view('footer_view');
		}

		// public function testimonials()
		// {
		// 	$data = array('title' => "Arbourview Testimonials");
		// 	$this->load->view('header_view', $data);
			
		// 	$this->load->model('Gallery_model');
		// 	$data['images'] = $this->Gallery_model->getGallery();
		// 	$this->load->view('left_column_view', $data);

		// 	$this->load->view('testimonials_view');
		// 	$this->load->view('footer_view');
		// }

		// public function gallery()
		// {
		// 	$data = array('title' => "Arbourview Gallery");
		// 	$this->load->view('header_view', $data);
			
		// 	$this->load->model('Gallery_model');
		// 	$data['images'] = $this->Gallery_model->getGallery();
		// 	$this->load->view('left_column_view', $data);

		// 	$this->load->view('gallery_view');
		// 	$this->load->view('footer_view');
		// }

		// public function contact()
		// {
		// 	$data = array('title' => "Arbourview Contact and Map");
		// 	$this->load->view('header_view', $data);
			
		// 	$this->load->model('Gallery_model');
		// 	$data['images'] = $this->Gallery_model->getGallery();
		// 	$this->load->view('left_column_view', $data);

		// 	$this->load->view('contact_view');
		// 	$this->load->view('footer_view');
		// } 
	}