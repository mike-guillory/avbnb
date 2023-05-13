<?php 

	// I think I need to connect to the database


	$data = array(
		'id'				=> $this->input->post('id'),
		'updateImageName'	=> $this->input->post('updateImageName'),
		'oldImageName'		=> $this->input->post('imageName'),
		'orderNumber'		=> $this->input->post('orderNumber'),
		'description'		=> $this->input->post('updateDescription'),
		'isFeatured'		=> $this->input->post('isFeatured')
	);

	$id = $data['id'];
	$orderNumber = $data['orderNumber'];
	$imageName = $data['updateImageName'];
	$description = $data['description'];
	$isFeatured = $data['isFeatured'];
	$oldImageName = $data['oldImageName'];

	if(!$isFeatured)
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

	echo true;