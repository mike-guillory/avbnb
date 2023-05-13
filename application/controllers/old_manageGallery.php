<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	class ManageGallery extends CI_Controller
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
				$data = array();
				$this->load->model('gallery_model');
				if($query = $this->gallery_model->getGallery())
				{
					$data['images'] = $query;
				}

				//$data['msg'] = "";
	    
	    		//$data['upload_data'] = '';

				$this->load->view('manageGallery_view', $data);				
			}
		}

		function addImage()
		{
			$data = array(
				// Variable names must match Field names in DB, but are case insenesitive
				'imageName' => $this->input->post('imageName'), // The same thing as doing $_POST['imageName']
				'orderNumber' => $this->input->post('orderNumber')
			);

			$this->load->model('gallery_model'); // Or autoload it
			$this->gallery_model->addImage($data);
			//$this->index();
			redirect('manageGallery');
		}

		function updateImage()
		{
			$data = array(
				'imageName' => $this->input->post('updateImageName'),
				'orderNumber' => $this->input->post('orderNumber')
			);
			$this->load->model('gallery_model');
			$this->gallery_model->updateImage($data);
			redirect('manageGallery');
		}

		function deleteImage()
		{
			// TODO -- get the ID, OrderNumber and ImageName like in the $data array in updateImage() above
			$id = $this->uri->segment(3);
			$orderNumber = $this->uri->segment(4);
			$imageName = $this->uri->segment(5);
			$this->load->model('gallery_model');
			$this->gallery_model->deleteImage($id, $orderNumber);
			unlink(FCPATH. "images/gallery/". $imageName);
			unlink(FCPATH. "images/gallery/thumbnails/". $imageName);
			redirect('manageGallery');

			//echo"<script type='text/javascript'>alert('$orderNumber in the controller');</script>";
		}

		function uploadImage() {

			$this->load->model('gallery_model');
			$this->gallery_model->doUpload();
			
		}
	}