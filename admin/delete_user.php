<?php
include 'includes/init.php';
if(!$session->is_signed_in()){
    redirect('login.php');
} 

if (empty($_GET['id'])) {
    redirect("../user.php");
}else{
	$user = User::find_by_id($_GET['id']);
	if ($user) {
		$user->delete_photo();
		redirect('user.php');
		$session->message("User {$user->username} has been Deleted");
	}else{
		redirect('user.php');
	}
}


?>