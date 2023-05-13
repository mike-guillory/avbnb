<!DOCTYPE html>
<html lang="en">
<head>
	<title>AVBNB Admin</title>
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap3.1.1/css/bootstrap.min.css" /> -->
	<link rel="stylesheet" type="text/css" href="css/lightbox.css" />
	<link rel="stylesheet" type="text/css" href="css/abv-bs.css" />

	<script src="scripts/js/lib/jquery-1.11.0.min.js"></script>
	<script src="scripts/js/lib/underscore.js"></script>
	<script src="scripts/js/lib/handlebars-v1.3.0.js"></script>
	<script src="scripts/js/lib/backbone.js"></script>
	<script src="scripts/js/lib/lightbox/js/lightbox.min.js"></script>
	<script src="scripts/js/validateImageInformation.js"></script>
	<script src="scripts/js/models.js"></script>
	<script src="scripts/js/views.js"></script>

	<style>
		body{
			font-family: arial;
			font-size: 1em;
		}
	</style>

	<?php 

		// echo '<style type="text/css">
		// 		a'

		if($page == "gallery"){
			echo '<style type="text/css">
					header{
						margin-right: -10px;
					}
					</style>';
		} 

	?>	

</head>
<body style="margin: 0 auto">
	<div id="container" style="width: 950px; margin: 0 auto">
		<header class="">
			<nav class="" style="background-color: #ffffff; text-align: right">
				<ul class="main-nav-admin">
					<!-- <li><?php echo anchor('admin', "Admin Home"); ?></li> -->
					<li><?php echo anchor('manageGallery', "Manage Gallery"); ?></li>
					<li><?php echo anchor('manageContent', "Manage Website Content"); ?></li>
					<li><?php echo anchor("logged_out", "Log Out", array("onclick" => "return confirm('Are you sure you want to log out?')")); ?></li>
				</ul>

<!-- 				<p class="" style="text-align: right"><?php echo anchor("logged_out", "Log Out",
				array("onclick" => "return confirm('Are you sure you want to log out?')")); ?></p> -->
			</nav>
		</header>
		<!-- This is here because it stops the progressIndicator.js from functioning. -->
		<script src="scripts/js/gallery.js"></script>