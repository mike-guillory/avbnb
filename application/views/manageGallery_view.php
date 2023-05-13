	<div class="" style="width: 950px; margin: 0 auto">
		
		<div class="" style="float: left; width: 300px">
	            
	        <h2 style="text-align: center">Upload Image</h2>	

			<!--<code><?php //echo $msg;?></code> -->

			<!--<code>
				<?php //if($upload_data != ''):?>

					<?php //var_dump($upload_data);?></code>

					<img scr="<?php //echo $upload_data['full_path'];?>">

				<?php //endif;?> -->

			<?php echo form_open_multipart("manageGallery/uploadImage"); ?>

				<!-- See http://codesamplez.com/development/codeigniter-file-upload 
						for instructions on how to allow selection of multiple files -->
				
				<!-- CI expects "userfile" by default. -->
				<p class="fileUpload"><?php echo form_upload("userfile"); ?></p>
				<!-- <p><input type="file" name="userfile" size="500" /></p> -->

				<p class="selectImageNumber">
					<?php 

						echo form_label('Image Number: ', 'ordNum');
						//echo form_input('ordNum', set_value(if(isset($_SESSION['imageNumber'])) echo '2'), 'id="ordNum"');
					?>
					<input type="text" name="ordNum" id="ordNum" value="<?php 
																			if(isset($_SESSION['imageNumber']) && $_SESSION['imageNumber']) 
																			{
																				echo $_SESSION['imageNumber']; 
																			}	
																			else 
																			{
																				echo $_SESSION['nextImageNumber'];
																			}  
																		?>" />
				</p>
				<p>
					<?php 
						echo form_label('Description: ', 'descrip');
						//echo form_input('descrip', set_value(), 'id="descrip"');
					?>
					<input type="text" name="descrip" id="descrip" value="<?php  if(isset($_SESSION['description'])) echo $_SESSION['description']; ?>" /> 
				</p>
				<p>

					<!-- Featured Check Box-->
						<label for="isFeatured">Featured: </label>
						<input type="checkbox" name="isFeatured" id="isFeatured" <?php if(isset($_SESSION['isFeatured']) && $_SESSION['isFeatured'] == 'on') echo 'checked="checked"' ?> />
				</p>
				<p>
					<?php echo form_submit("upload", "Upload"); ?>
					<!-- <p><input type="button" value="Upload" onclick="validate()" /></p> -->
				</p>

			<?php echo form_close(); ?>

	 		<div class="uploadImageErrors">
	 			<?php
	 				if(isset($_SESSION['errors']))
	 				{
	 					echo $_SESSION['errors'];
	 					unset($_SESSION['errors']);
	 				}	

	 				// echo "Image Number is: ". $_SESSION['imageNumber']. "<br>";
	 				// echo "Next Image Number is: ". $_SESSION['nextImageNumber'];					
				?>
				<!-- <p id="userfileError">You must choose a File.</p> -->
				<!-- <p id="imageNumberError">You must indicate an Image Number.</p> -->
			</div>

		</div>
		<div class="lightbox-gallery" style="float: left; width: 650px">
			<h2 style="text-align: center">Gallery</h2>
				<?php foreach($images as $image): ?>
					<div class="gallery-image-div">
						<figure class="manage-gallery-image-holder">
							<img src="images/gallery/thumbnails/<?=$image['imageName']?>"></img>
							<?php echo form_open(); ?>
							<div>
								<!-- Image Name -->
								<input type="text" id="updateImageName<?=$image['imageId']?>" class="<?=$image['imageId']?>" value="<?=$image['imageName']?>" />
								<input type="hidden" id="imageName<?=$image['imageId']?>" value="<?=$image['imageName']?>" />

								<!-- Image Number -->
								<input type="text" id="orderNumber<?=$image['imageId']?>" class="<?=$image['imageId']?>" size="2" value="<?=$image['orderNumber']?>"/>
								<input type="hidden" id="hiddenOrderNumber<?=$image['imageId']?>" value="<?=$image['orderNumber']?>" />
							</div>
							<div>
								<!-- Description -->
								<input type="text" id="updateDescription<?=$image['imageId']?>" class="<?=$image['imageId']?>" value="<?=$image['description']?>" size="31"/>
								<input type="hidden" id="description<?=$image['imageId']?>" value="<?=$image['description']?>" />
							</div>
							<div>
								<!-- Featured Check Box-->
								<label for="isFeatured">Featured: </label>
								<input type="checkbox" id="isFeatured<?=$image['imageId']?>" class="<?=$image['imageId']?>" <?php if($image['isFeatured']){echo "checked='checked'";} ?>/> <!-- {{#if IsFeatured}} checked {{/if}} -->

								<!-- Submit Button -->
								<input type="submit" value="Update" id="<?=$image['imageId']?>" onclick="return confirm('Are you sure you want to Edit this image?')" />

								<!-- Delete Button -->
								<?php 
									echo anchor("manageGallery/deleteImage/".$image['imageId']."/".$image['orderNumber']."/".$image['imageName'], "<input type='button' value='Delete'>", 
									array("onclick" => "return confirm('Are you sure you want to delete".$image['imageName']."?')")); 
								?>
							</div>
							<?php echo form_close(); ?>
							<figcaption class="update-caption" id="image<?=$image['imageId']?>">&#x2714;</figcaption>
						</figure>
					</div>
				<?php endforeach; ?>
			<script type="text/javascript">

			$(this).click(function(e){

				var tc = $(e.target).attr('class');
				$('#image' + tc).css('color', '#fff');

				if($.isNumeric(e.target.id)){

					var imageId = (e.target.id);
					var oldOrderNumber = $('#hiddenOrderNumber' + imageId).val();

					var imageData = {
						id: imageId,
				 		updateImageName: $('#updateImageName' + imageId).val(),
				 		imageName: $('#imageName' + imageId).val(),
						orderNumber: $('#orderNumber' + imageId).val(),
				 		updateDescription: $('#updateDescription' + imageId).val(),
				 		isFeatured: $('#isFeatured' + imageId).prop("checked")
					};

					$.ajax({
						url: "manageGallery/updateImage",
						type: 'POST',
						data: imageData,
						dataType: 'json',
						success: function(data){

							$('#image' + imageId).html("&#x2714; Updated").css('color', 'green');
							$('#imageName' + imageId).val(data.ImageName); // update the hidden imageName so if it's changed back the program won't go looking for the old name
							if(data.OrderNumber != oldOrderNumber){
								window.location.href = "manageGallery";
							};
						}
					});
					e.preventDefault();
				}
			});

			</script>

			<!-- This is here because it stops the progressIndicator.js from functioning. -->
			<script src="scripts/js/gallery.js"></script>
		</div>
	</div>
</div>
</body>
</html>