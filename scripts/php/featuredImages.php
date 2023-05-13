<?php

	$content = "foreach ($images as $image){if($image['isFeatured']){echo '<div><img src=&#34;images/gallery/thumbnails/'. $image['imageName']. '&#34;></img></div>';}}";
	

	echo $content;
?>