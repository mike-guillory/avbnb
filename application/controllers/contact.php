<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Contact extends CI_Controller
	{
		public function index(){

			$data = array('title' => "Map and Contact Information&#44; Arbourview Bed and Breakfast");
			$data['description'] = "See Arbourview Bed and Breakfast on Google Maps. Call 905 937-5261 (home) or 905 931-0844 (mobile). Address: 8 Regina Avenue, St Catharines, Ontario L2M 3G7";
			$this->load->view('header_view', $data);
			
			$this->load->model('Gallery_model');
			$data['images'] = $this->Gallery_model->getGallery();
			$this->load->model('Content_model');
			$data['price'] = $this->Content_model->getContent()->price;
			$this->load->view('left_column_view', $data);

			$this->load->view('contact_view');
			$this->load->view('footer_view');
		} 
	}