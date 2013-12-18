<?php

function d( $array  , $die_cond=0 )
{
	echo "<pre>";
	print_r($array);
	echo "</pre>";
	
	if($die_cond)
		die();
}
?>