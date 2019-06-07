<?php

function __autoload($class){
	$class = strtolower($class);
	$the_pass = "includes/{$class}.php";
	if (file_exists($the_pass)) {
		require_once($the_pass);
	}else{
		die("This file name {$class}.php is not exist man...");
	}
}

function redirect($location){
	header("Location: {$location}");
}






?>