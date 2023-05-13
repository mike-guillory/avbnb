<script>
  // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  // (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  // m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  // })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  // ga('create', 'UA-54438409-1', 'auto');
  // ga('send', 'pageview');

</script>
	<div class="tourView">
		<div class="tourBackGround">
			<div class="tourFrame">
				<div class="tourDiv"><br><br>
					<h2>This Business is no Longer Operating</h2><br><br>
					<hr style="height: 3px; margin-bottom: 40px; background-color: white;">
					<p>The images rotating in the left column are selected from images on the gallery page and these 
						selections are controlled in the limited, custom CMS. The text under the heading “Friendly, 
						beautiful, quiet…” as well as the price per night in the left column are editable in the CMS. 
					<div class="buttonDiv">
						<button onclick="fadeOut()" autofocus>Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-8 column col-xs-12" id="content-right" style="align-items: stretch">
		<div class="col-sm-12" id="content-right-top">
			<div class="col-sm-12" style="display: inline; height: 60px; text-align: right; padding: 10px 0 10px 0">
				<div class="fb-like" data-href="http://www.avbnb.com" data-layout="button" data-action="like" data-show-faces="true"></div>
				<div class="fb-send" data-href="http://www.avbnb.com/" data-show-faces="true" data-colorscheme="dark"></div>
			</div>
			
			<h3 class='heading' style="text-align: center; margin-bottom: 20px">Friendly, beautiful, quiet and comfortable</h3>
			<?php echo $homepageParagraph; ?>
			<hr></hr>
			<div class="comment-slideshow col-sm-12" style="padding: 0">	<!-- height: 180px; --> 
				<div>
					<blockquote id='quote-one'>
					&#34;Relaxing and tranquil beauty describes Arbour View Bed &#38 Breakfast. This home is 
					immaculate. Exceptional hospitality and a tasteful breakfast are additional benefits.&#34;
					</blockquote>

					<footer class='quote-footer'>
						- The Andersons, Atlanta, Georgia USA
					</footer>
					<hr></hr>
				</div>
				<div>
					<blockquote id='quote-two'>
					&#34;This BnB was cosy, clean, and very welcoming. Brian does a great job of making guests 
					feel comfortable while attending to their needs. We would stay there again without hesitation!&#34;
					</blockquote>

					<footer class='quote-footer'>
						- Guylaine, Montreal, Canada
					</footer>
					<hr></hr>
				</div>
			</div>											
		</div>
		<div style="margin-top: 20px; text-align: center; padding: 0" class="col-sm-12" id="content-right-bottom">
			<h3 class='heading' id="welcome">Welcome to a beautiful night's rest</h3>
				
			<div class="bedroomImageDiv col-sm-4">
				<img class="img-responsive bedroomImage" alt="The Japanese Maple Room" src="images/rooms/jmRoomMainNoCBB.jpg"><span style="font-weight: 600">Japanese Maple Room</span>
			</div>
			<div class="bedroomImageDiv col-sm-4">
				<img class="img-responsive bedroomImage" alt="The Crimson Maple Room" src="images/rooms/cmRoomMainNoCBB.jpg"><span style="font-weight: 600">Crimson Maple Room</span>
			</div>
			<div class="bedroomImageDiv col-sm-4">
				<img class="img-responsive bedroomImage" alt="The Sun Room Bedroom" src="images/rooms/sRoomMainNoCBB.jpg"><span style="font-weight: 600">Sun Room</span>
			</div>
		</div>
	</div>
	<link rel="stylesheet" type="text/css" href="css/lightbox.css" />
	<script src="scripts/js/lib/jquery-1.11.0.min.js"></script>
	<script src="scripts/js/lib/jquery.cycle.lite-min.js"></script>
	<script src="scripts/js/lib/slideshow.js"></script>
	<script src="scripts/js/main.js"></script>
	<script src="scripts/js/models.js"></script>
	<script src="scripts/js/views.js"></script>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
	  fjs.parentNode.insertBefore(js, fjs);
	  }(document, 'script', 'facebook-jssdk'));
	</script>