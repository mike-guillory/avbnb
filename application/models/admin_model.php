<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Admin_model extends CI_Model{
		function __construct()
		{

		}

		public function verifyUser($userName, $password)
		{
			$query = $this
						->db
						->where('UserName', $userName)
						->where('Password', $password)
						->limit(1)
						->get('users');

			if($query->num_rows > 0)
			{
				// This will show what the query returned
				//echo '<pre>';
				//print_r($query->row());
				//echo '</pre>';
				
				return $query->row();
			}
			return false;
		}					
	}