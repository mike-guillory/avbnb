<?php

	//echo "<script type='text/javascript'>alert('in the php');</script>";


$file = "C:/xampp/htdocs/Arbourview/avbnb/images/test/houseExternalRight.jpg";

if(!unlink($file))
{
	echo ("Error deleting $file");
}
else
{
	echo "Deleted $file";
}