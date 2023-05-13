<?php

	class Content_model extends CI_Model{

		public function getContent()
		{
			$query = $this->db->get('content');
			$content = $query->row(); // select a single row so I won't have to use foreach in the views

			return $content;
		}	

		public function updateContent()
		{
			$data = array(
				'price'	=> $this->input->post('updatePrice'),
				'homepageParagraph'	=> $this->input->post('updateHomepageParagraph')				
			);

			$this->db->update('content', $data);
		}				
	}