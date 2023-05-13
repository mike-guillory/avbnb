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
					<p>Images in the gallery are uploaded in the CMS. Images that are larger than 1200px x 900px 
						are resized down to within those dimensions while maintaining the original aspect ratio. 
						Thumbnails for the gallery page are created and the images are watermarked when uploaded. 
						Their order and alt text are controlled in the CMS. Images can be reordered as needed 
						through a MySQL stored procedure.
					<div class="buttonDiv">
						<button onclick="fadeOut()" autofocus>Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-8 column lightbox-gallery">
		<h2 class="centered">Click an image to enlarge</h2>
		<?php if($images): ?>
			<?php foreach ($images as $image): ?>
				<div class="gallery-image-div">
					<figure class="gallery-image-holder">
						<a data-lightbox="gallery-set" href="images/gallery/<?=$image['imageName']?>">
							<img alt="<?=$image['description']?>" src="images/gallery/thumbnails/<?=$image['imageName']?>"></img>
						</a>
					</figure>
				</div>	
			<?php endforeach; ?>
		<?php else: ?>	
			<p style="text-align: center; font-size: 1.5em; color: #ff0000">There is a problem connecting to the database at this time.</p>
		<?php endif; ?>
	</div>
		<link rel="stylesheet" type="text/css" href="css/lightbox.css" />
		<script src="scripts/js/lib/jquery-1.11.0.min.js"></script>
		<script src="scripts/js/lib/jquery.cycle.lite-min.js"></script>
		<script src="scripts/js/lib/slideshow.js"></script>
		<script src="scripts/js/main.js"></script>
		<script src="scripts/js/models.js"></script>
		<script src="scripts/js/views.js"></script>
		<script src="scripts/js/lib/underscore.js"></script>
		<script src="scripts/js/lib/handlebars-v1.3.0.js"></script>
		<script src="scripts/js/lib/backbone.js"></script>
		<script src="scripts/js/lib/lightbox/js/lightbox.min.js"></script>
		<!-- This is here because it stops the progressIndicator.js from functioning otherwise. -->
		<script src="scripts/js/gallery.js"></script>