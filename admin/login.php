<?php
include 'includes/header.php';

if($session->is_signed_in()){
	redirect('index.php');
}

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$user_found = User::verify_user($username, $password);

	if($user_found){
		$session->login($user_found);
		redirect('index.php');
	}else{
		$the_msg =  "Sorry Thats Error In Your Username Or Password";
	}
}else{
	$the_msg='';
	$username='';
	$password='';
}

?>

<div class="col-md-4 mx-auto login">
	<form action="" method="POST">
		<?php if (!empty($the_msg)) {
				echo "<div class='alert alert-danger'> $the_msg </div>";
		} ?>
		
		<div class="form-group">
			<label for="username">Username</label>
			<input type="username" name="username" class="form-control" value="abdulrhman">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" class="form-control" value="123">
		</div>
		<div class="form-group">
			<input type="submit" name="submit" value="Login" class="btn btn-primary">
		</div>
	</form>
</div>