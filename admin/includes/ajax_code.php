<?php
	require 'init.php';
	// if (isset($_POST['x'])) {
	// 	echo "This Data From Server";
	// }else{
	// 	echo "NO";
	// }

	$user = new User();
	$photo = new Photo();
	
	
	if (isset($_POST['img_name'])) {
		$user->save_img_ajax($_POST['img_name'], $_POST['user_id']);
	}

	if (isset($_POST['photo_id'])) {
		Photo::display_sidebar_data($_POST['photo_id']);
	}
?>