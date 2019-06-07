<?php
include 'includes/init.php';
if(!$session->is_signed_in()){
    redirect('login.php');
} 

if (empty($_GET['id'])) {
    redirect("../comments.php");
}else{
	$comment = Comment::find_by_id($_GET['id']);
	if ($comment) {
		$comment->delete();
		redirect("comment_photo.php?id={$comment->photo_id}");
		$session->message("Comment {$comment->id} has been Deleted");
	}else{
		redirect('comment_photo.php?id={$comment->photo_id}');
	}
}


?>