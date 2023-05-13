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
				$this->load->model('Gallery_model');
				$data['images'] = $this->Gallery_model->getGallery();
				$data['page'] = "gallery";
				$_SESSION['nextImageNumber'] = $this->Gallery_model->getNextImageNumber();
				$this->load->view('adminHeader_view', $data);
				$this->load->view('manageGallery_view');				
			}
		}

		function updateImage()
		{
			$this->load->model('gallery_model');
			$this->gallery_model->updateImage();

			//redirect('manageGallery');
		}

		function deleteImage()
		{
			$this->load->model('gallery_model');
			$this->gallery_model->deleteImage();
			
			redirect('manageGallery');
		}

		function uploadImage() 
		{
			unset($_SESSION['errors']);
			unset($_SESSION['imageNumber']);
			unset($_SESSION['description']);
			unset($_SESSION['isFeatured']);
			unset($_SESSION['imageFile']);

			// $if = $_SESSION['isFeatured'];

			// echo "<script>alert($if);</script>";

			// I think I'd prefer to do this validation client-side.
			$this->load->library('form_validation');
			if(empty($_FILES['userfile']['name']))// I don't know why it's ['userfile']['name'], but it is.
			{
				$this->form_validation->set_rules('userfile', 'Choose File', 'required');
				//$this->form_validation->set_message('required', 'You must choose an image file to upload.');
			}
			$this->form_validation->set_rules('ordNum', 'Image Number', 'numeric');
			$this->form_validation->set_message('numeric', 'The Image Number must be a number.');

			if($this->form_validation->run() !== false)
			{
				$this->load->model('gallery_model');
				$this->gallery_model->uploadImage(); // No need to pass the image data to the upload function
				redirect('manageGallery'); // Change this and all other like it to $this->index(); and see what happens
			}
			else
			{
				$this->load->view('manageGallery_view');
				//$this->index();
				$_SESSION['errors'] = validation_errors();
				$_SESSION['imageNumber'] = $this->input->post('ordNum');
				$_SESSION['description'] = $this->input->post('descrip');
				$_SESSION['isFeatured'] = $this->input->post('isFeatured');
				$_SESSION['imageFile'] = $_FILES['userfile']['name'];

				redirect('manageGallery');
			}
		}
	}



	// function addImage()
		// {
		// 	$data = array(
		// 		// Variable names must match Field names in DB, but are case insenesitive
		// 		'imageName' => $this->input->post('imageName'), // The same thing as doing $_POST['imageName']
		// 		'orderNumber' => $this->input->post('orderNumber')
		// 	);

		// 	$this->load->model('gallery_model'); // Or autoload it
		// 	$this->gallery_model->addImage($data);
		// 	//$this->index();
		// 	redirect('manageGallery');
		// }