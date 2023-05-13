<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Gallery extends CI_Controller
	{	
		public function index(){
			
			$data = array('title' => "Photo Gallery&#44; Arbourview Bed and Breakfast&#44; St Catharines");
			$data['description'] = "Click an image to see enlarged slideshow. Breakfast Room · Swing and Garden · Japanese Maple Room · Arbourview House · Guest Lounge · Courtyard Patio · Lake Ontario...";
			$this->load->view('header_view', $data);
			
			$this->load->model('Gallery_model');
			$data['images'] = $this->Gallery_model->getGallery();
			$this->load->model('Content_model');
			$data['price'] = $this->Content_model->getContent()->price;
			$this->load->view('left_column_view', $data);

			$this->load->view('gallery_view');
			$this->load->view('footer_view');
		}
	}
