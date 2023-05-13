var GalleryImage = Backbone.Model.extend({
	// I don't know why, but this url: is needed in both the Model and the Collection
    url: function () {
		return 'scripts/php/getGallery.php/gallery';
	},

	defaults:{
		ImageID: '',
		ImageName: '',
		ImageOrderNumber: ''
	}
});

var Gallery = Backbone.Collection.extend({
	model: GalleryImage,
	// I don't know why, but this url: is needed in both the Model and the Collection
	url: function(){
		return 'scripts/php/getGallery.php/gallery';
	}
});


/* var Reservation = Backbone.Model.extend({
	url: function(){
		return '.scripts/php/'
	},
});*/

/*var AvailableRoom = Backbone.Model.extend({
	url: function(){
		return './scripts/php/getAvailableRooms.php/room';
	},
	
	defaults:{
		RoomID: "",
		RoomName: "",
		ImageName: ""
	}
});

var RoomsAvailable = Backbone.Collection.extend({
	model: AvailableRoom,
	url: function(){
		return './scripts/php/getAvailableRooms.php/room';
	}
});*/