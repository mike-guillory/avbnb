(function(){

	// Gallery is a group of GalleryImage, both are defined in models.js.
	var galleryList = new Gallery();

	// Get a list of all the gallery image names stored in the database.
	// The interaction with the database happens when this .fetch follows
	// the url to getGallery.php in the Gallery model.
	var results = galleryList.fetch({
		
		success: function(){
			
			// GalleryView is defined in views.js
			// Galleryview is not used anywhere, it's just needed in the call of GalleryView.
			// Pass the list of image names (in jason format) obtained by the .fetch to the GalleryView template 
			var galleryView = new GalleryView(results.responseJSON);
			// The GalleryView template sends the list of image names to the correct script on gallery.html.
		
		}
	});
})();