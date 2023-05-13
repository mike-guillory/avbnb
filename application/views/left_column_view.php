	<div class="grad1 col-sm-4 col-xs-12 column" id="content-left" style="align-items: stretch"><!-- may need to put "clear" back in the class -->
		
		<div class="col-sm-12" id="slideshowContainer">
			<div class='image-slideshow'>
				<?php
					if($images)
					{
						foreach ($images as $image) {
							if($image['isFeatured'])
							{
								echo '<div><img alt="'. $image['description']. '" src="images/gallery/thumbnails/'. $image['imageName']. '"></img></div>';
							}
						};
					}
					else{
						echo '<div><img alt="Enjoy your breakfast in Arbourview&#39;s beautiful dining room." src="img/DiningRoom.jpg"></img></div>';
					}
				?>
			</div>
		</div>

		<div class="amenitiesDiv col-sm-12">

			<div class="aafAndPoi col-sm-12 col-xs-6" id="aaf">
				<h3>Amenities and Facilities</h3>

					<ul id="amenities">
						<li>Full Breakfast of your choice</li>
						<li>Wireless High Speed Internet</li>
						<li>Ample Parking</li>
						<li>Central Air Conditioning</li>
						<li>Bike Storage</li>
						<li>Snowmobile Shelter</li>
					</ul>
			</div>
			
			<div class="aafAndPoi col-sm-12 col-xs-6" id="poi">
				<h3>Nearby Points of Interest</h3>
				<span style="font-size: 1.2em"><p>Within a fifteen minute drive</p></span>

					<ul id="pointsOfInterest">
						<li>Niagara Falls</li>
						<li>Niagara On The Lake</li>
						<li>Port Dalhousie</li>
					</ul>
			</div>
			<div class="reservationsBtnDiv col-sm-12 col-xs-12" style="margin-top: 3px">
				<span style="font-size: 1.5em"><h4><?php echo $price ?> per night<br> <span style="font-size: 0.7em">includes tax</span></h4></span>
				<a class="btn-reservations" id="reservationsButton" href="reservations">Reservations</a>
			</div>
		</div>
		<div class="col-sm-12  col-xs-12 footer-non-mobile">
 			<footer class="footer-nav col-xs-12" id="footer-container">
				<ul>
					<li><a href="home">MAIN INFO</a></li> 
					<li><a href="testimonials">TESTIMONIALS</a></li>
					<li><a href="gallery">GALLERY</a></li><br>
					<li><a href="contact">CONTACT & MAP</a></li>
					<li><a href="reservations">RESERVATIONS</a></li>
				</ul>
				<div class="col-sm-12  col-xs-12 addressDiv">
					<div class="addressContainer">
						<p class="address">	
							8 Regina Avenue<br>
							St Catharines, Ontario<br>
							L2M 3G7
						</p>
					</div>
					
				</div>
				
				<p>Copyright &#169; 2016 Arbourview Bed and Breakfast<br>
					Website by: Michael Guillory</p><!-- <a href="https://www.facebook.com/pages/Credo-Web-Development/1652813801599346" rel="nofollow" target="blank">Credo Web Development</a> -->
			</footer>
		</div>
	</div>

