<script src="ckeditor.4.5.4.basic/ckeditor.js"></script>
<div id="container" style="width: 950px; margin: 0 auto;">
		<h1>Site Content</h1>

		<?php echo form_open('manageContent/updateContent'); ?>
		<div>
			<p>
				Price per night:
				<input type="text" name="updatePrice" value="<?php echo $price; ?>" />
				<!-- <input type="hidden" name="price" value="<?php //echo $Price; ?>" /> -->
				<?php 
					$submit = array(
							'name' =>	"updateContent",
							'value'	=>	"Update",
							'onclick' => "return confirm('Are you sure you want to make this change?')"
						);
					// echo form_submit($submit); 
				?>
			</p>

		</div> 

		<div style="margin-bottom: 20px">
			<p>
				Homepage paragraph:
				<!-- <input type="textarea" name="updateHomepageParagraph" value="<?php //echo $homepageParagraph; ?>" /> -->
				<!-- <input type="hidden" name="price" value="<?php //echo $updateHomepageParagraph; ?>" /> -->
			</p>

			<?php  
	            $data = array(
		            'name'        => 'updateHomepageParagraph',
		            'id'          => 'updateHomepageParagraph',
		            'value'       =>  $homepageParagraph
	            );

       			echo form_textarea($data); 
        	?>

			<script>
		        CKEDITOR.replace('updateHomepageParagraph', {
		            width: 650, // it looks like setting the width to 40px less than the width of where is will be displays will work. I guess it accounts for a padding of 20 in the editor window.
		            height: 300
		        });
		    </script>
		</div>
		<div style="text-align: center">
			<?php 
				echo form_submit($submit);
				echo form_close(); 
			?>
		</div>

	<!-- This is here because it stops the progressIndicator.js from functioning. -->
	<script src="scripts/js/gallery.js"></script>
</div><!-- end container-->
</body>
</html>