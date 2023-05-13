var GalleryView = Backbone.View.extend({

	initialize: function(list){
		this.render(list);
	},
	
	render: function(list){
		var images = Handlebars.compile($("#gallery-template").html());
		$("div.lightbox-gallery").append(images(list));
	},
	
	
});

var AvailableRoomsView = Backbone.View.extend({

	initialize: function(list){
		this.render(list);
	},

	render: function(list){
		var rooms = Handlebars.compile($("#available-rooms-template").html());
		$("div.rooms-available").append(rooms(list));
	}


});

// var CalendarView = Backbone.View.extend({

	// initialize: function(){
		// this.render();
	// },
	
	// render: function(){
		// var calendar = Handlebars.compile($('#calendar-template').html());
		// $('div.lightbox-gallery').append(calendar());
	// },
	
	
// });