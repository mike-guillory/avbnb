<?php

	class Gallery_model extends CI_Model
	{
		function getGallery()
		{
			$this->db->order_by('OrderNumber');
			$query = $this->db->get('gallery');

			$images = array();

			foreach ($query->result() as $image) {
				$images[] = array(
					'imageId'		=> $image->ImageID,
					'imageName' 	=> $image->ImageName,
					'orderNumber'	=> $image->OrderNumber,
					'description'	=> $image->Description,
					'isFeatured'	=> $image->IsFeatured
				);
			}

			return $images;
		}

		function getWhereId($id)
		{
			$this->db->where('ImageID', $id);
			$query = $this->db->get('gallery');
			
			$row = $query->row();
			//return $row->ImageName;

			return $row;
		}

		function getNextImageNumber()
		{
			$query = $this->db->query("SELECT MAX(OrderNumber) AS highestImageNumber FROM gallery");

			$number = $query->row();

			$nextImageNumber = $number->highestImageNumber + 1;

			return $nextImageNumber;
		}

		function addImage($image)
		{
			$this->db->insert('gallery', $image);
			$id = $this->db->insert_id();
			$ordNum = $image['orderNumber'];
			$imageName = $image['imageName'];
			$description = $image['description'];
			$isFeatured = $image['isFeatured'];

			if(!$description){

				$description = "No Description";
			}
			
			$query = $this->db->query('CALL usp_updateImagesTwo('. $id. ', '. $ordNum. ', "'. $imageName. '" , "'. $description. '", "'. $isFeatured. '")');
		}


		function uploadImage()
		{
			// Upload the image to the images folder ///////////////////////////////
			$uploadConfig = array(
				'image_library'		=> 'GD2',
				'upload_path'		=> 'images/gallery/',
				'allowed_types' 	=> 'gif|jpg|jpeg|png'
			);

			$this->load->library('upload', $uploadConfig);
	    	$this->upload->do_upload(); // The CI do_upload function already looks for "userfile" as passed from the view.
			$image_data = $this->upload->data();

			$fileName = $image_data['file_name'];
			$sourceImage = $image_data['full_path'];

			// Resize original image //////////////////////////////////////////////////
			if($image_data['image_width'] > 1200 || $image_data['image_height'] > 900)
			{
				$resizeOriginalConfig = array(
								'image_library'		=> 'GD2',
								'source_image'		=> $sourceImage,
								'new_image'			=> "images/gallery", // There is a better way to do this.
								'maintain_ratio'	=> TRUE,
								'width'				=> 1200,
								'height'			=> 900
				);	

				$this->load->library('image_lib');	
				$this->image_lib->initialize($resizeOriginalConfig);	
		    	$this->image_lib->resize();
		    	$this->image_lib->clear();
			}
			///////////////////////////////////////////////////////////////////////////

			// Insert New Image data into the datbase ///////////////////////////////
			$newImageData = array(
				'imageName' => $fileName,
			 	'orderNumber' => $this->input->post('ordNum'),
			 	'description' => $this->input->post('descrip'),
			 	'isFeatured' => $this->input->post('isFeatured')
			);

			if(!$newImageData['isFeatured'])
			{
				$newImageData['isFeatured'] = 0;
			}
			else
			{
				$newImageData['isFeatured'] = 1;
			}

			$this->addImage($newImageData);
			/////////////////////////////////////////////////////////////////////////

			// Watermark the image ///////////////////////////////////////////////////
			$waterMarkConfig = array(
					'image_library'		=> 'GD2',
					'source_image'		=> $sourceImage,
					'wm_type'			=> 'overlay',
					'wm_overlay_path'	=> FCPATH. "img/arbourviewWatermark2.png",
					'wm_vrt_alignment'	=> 'bottom',
					'wm_hor_alignment'	=> 'right'
			);

			//$waterMarkConfig['wm_opacity'] = "50";
			//$waterMarkConfig['wm_x_transp'] = '32'; 
        	//$waterMarkConfig['wm_y_transp'] = '30';

			$this->load->library('image_lib');
			$this->image_lib->initialize($waterMarkConfig);	
			$this->image_lib->watermark();
			$this->image_lib->clear();

			//return $sourceImage;

			// $si = $image_data['orig_name'];
			// $this->resizeIt($si);
			///////////////////////////////////////////////////////////////////////////////

			// Create thumbnail /////////////////////////////////////////////////////
			$thumbnailConfig = array(
								'image_library'		=> 'GD2',
								'source_image'		=> $sourceImage,
								'new_image'			=> "images/gallery/thumbnails", // There is a better way to do this.
								'maintain_ratio'	=> TRUE,
								'width'				=> 310,//225,
								'height'			=> 180,//169
			);	

			$this->load->library('image_lib');	
			$this->image_lib->initialize($thumbnailConfig);	
	    	$this->image_lib->resize();
	    	$this->image_lib->clear();
	    	//////////////////////////////////////////////////////////////////////////	
		}
			
		function updateImage()
		{
			$data = array(
				'id'			=> $this->input->post('id'),
				'imageName'		=> $this->input->post('updateImageName'),
				'orderNumber'	=> $this->input->post('orderNumber'),
				'description'	=> $this->input->post('updateDescription'),
				'isFeatured'	=> $this->input->post('isFeatured')
			);

			$id = $data['id']; //$this->uri->segment(3);
			$orderNumber = $data['orderNumber'];
			$imageName = $data['imageName'];
			$description = $data['description'];
			$isFeatured = $data['isFeatured'];
			$oldImageName = $this->input->post('imageName');

			if($isFeatured == 'false')
			{
				$isFeatured = 0;
			}
			else
			{
				$isFeatured = 1;
			}

			rename('images/gallery/'.$oldImageName, 'images/gallery/'.$imageName);
			rename('images/gallery/thumbnails/'.$oldImageName, 'images/gallery/thumbnails/'.$imageName);

			$query = $this->db->query('CALL usp_updateImagesTwo('. $id. ', '. $orderNumber. ', "'. $imageName. '", "'. $description. '", "'. $isFeatured. '")');

			$varify = $this->getWhereId($id);
			
			//echo $this->db->affected_rows();
			echo json_encode($varify);
		}

		function deleteImage()
		{
			// TODO -- get the ID, OrderNumber and ImageName like in the $data array in updateImage() above
			$id = $this->uri->segment(3);
			$orderNumber = $this->uri->segment(4);
			$imageName = $this->uri->segment(5);

			$this->db->where('ImageID', $id);
			$this->db->delete('gallery');
			
			unlink(FCPATH. "images/gallery/". $imageName);
			unlink(FCPATH. "images/gallery/thumbnails/". $imageName);

			$query = $this->db->query('CALL usp_reorderImagesTwo('. $id. ', '. $orderNumber. ')');

			//echo"<script type='text/javascript'>alert('$orderNumber in the model');</script>";
		}
	}