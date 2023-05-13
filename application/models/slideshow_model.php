<?php

	class Slideshow_model extends CI_Model
	{
		function getSlideshow()
		{
			$imageFiles = scandir(FCPATH. 'images/gallery/slides');

			$images = array();

			foreach ($imageFiles as $image) {
				$images[] = array(
						'url' => 'images/'. $image;
					);
			}

			return $images;
		}
	}