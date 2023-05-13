<?php

	class Gallery_model extends CI_Model{

		function getGallery()
		{
			$this->db->order_by('OrderNumber');
			$query = $this->db->get('gallery');

			return $query->result();
		}

		function addImage($image)
		{
			$this->db->insert('gallery', $image);
			$id = $this->db->insert_id();
			$ordNum = $image['orderNumber'];
			$imageName = $image['imageName'];
			$query = $this->db->query('CALL usp_updateImages('. $id. ', '. $ordNum. ', "'. $imageName. '")');
		}


		function doUpload()
		{

			//Configure
			//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
			$config['upload_path'] = 'images/gallery/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';

			//$image_data['upload_data'] = '';
	    
	    	//load the upload library
			$this->load->library('upload');
			$this->upload->initialize($config);
	    	//$this->upload->set_allowed_types('*');

	    	$this->upload->do_upload('userfile', $config);

			$image_data = $this->upload->data();

			// 	$image_data['msg'] = $this->upload->display_errors();

	        $fileName = $image_data['file_name'];

			$newImageData = array(
				// Variable names must match Field names in DB, but are case insenesitive
				'imageName' => $fileName,
			 	'orderNumber' => $this->input->post('ordNum')
			);
	        $this->load->model('gallery_model'); // Or autoload it
			$this->gallery_model->addImage($newImageData);



			$config = array(
					'source_image'		=> $image_data['full_path'],
					'wm_type'			=> 'overlay',
					'wm_overlay_path'	=> FCPATH. "img/arbourviewWatermark.png",
					'wm_vrt_alignment'	=> 'bottom',
					'wm_hor_alignment'	=> 'right'
			);

			$this->load->library('image_lib', $config);	
			$this->image_lib->watermark();

			$si = $image_data['orig_name'];

			$this->resizeIt($si);
		}
			

		function updateImage($data)
		{
			$id = $this->uri->segment(3);
			$orderNumber = $data['orderNumber'];
			$imageName = $data['imageName'];

			// $this->db->where('ImageID', $id);
			// $this->db->update('gallery', $data);

			$query = $this->db->query('CALL usp_updateImages('. $id. ', '. $orderNumber. ', "'. $imageName. '")');
		}

		function deleteImage($id, $orderNumber)
		{
			$this->db->where('ImageID', $id);
			$this->db->delete('gallery');
			$query = $this->db->query('CALL usp_reorderImages('. $id. ', '. $orderNumber. ')');

			//echo"<script type='text/javascript'>alert('$orderNumber in the model');</script>";
		}

		function resizeIt($si)
		{


			$resizeConfig = array(
								//'image_library'		=> 'gd2',
								'source_image'		=> FCPATH. $si,
								'new_image'			=> "images/gallery/thumbnails", // There is a better way to do this.
								'maintain_ratio'	=> TRUE,
								'width'				=> 225,
								'height'			=> 169
			);	

			//$config["manipulation_type"]['source_image'] = $image_data['full_path'];
			$this->load->library('image_lib', $resizeConfig);		
	    	$this->image_lib->resize();

	    	redirect('manageGallery');
			// //$this->load->view('manageGallery_view', $image_data);
		}
	}