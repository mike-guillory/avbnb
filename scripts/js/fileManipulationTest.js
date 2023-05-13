function deleteImage(){

	$.ajax(
	{
		url: 		"../avbnb/scripts/php/deleteImage.php",
		data: 		"data=" + "somthing",
		type: 		"POST",
		context: 	$("#deleteNotice"), 
		success: 	function(data)
		{
			$(this).html(data);
		}  
	});
}

