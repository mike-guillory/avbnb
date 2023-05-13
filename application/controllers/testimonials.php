<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Testimonials extends CI_Controller
	{
		public function index()
		{
			$data = array('title' => "Guests&#39; Testimonials&#44; Arbourview Bed and Breakfast");
			$data['description'] = "See what our guests are saying. ". "'". "My wife and I had a very nice stay here. Was clean, quiet and tastefully decorated and were treated very well by Brian. Is fairly close to Niagra Falls...". "'";
			$this->load->view('header_view', $data);
			
			$this->load->model('Gallery_model');
			$data['images'] = $this->Gallery_model->getGallery();
			$this->load->model('Content_model');
			$data['price'] = $this->Content_model->getContent()->price;
			$this->load->view('left_column_view', $data);

			$this->load->view('testimonials_view');
			$this->load->view('footer_view');
		}
	}