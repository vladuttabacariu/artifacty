<!DOCTYPE html5>
<html>
	<?php include '../includes/header.php'; ?>
	<?php //check if already logged in move to home page
	if( $user->is_logged_in() ){ header('Location: '.DIR.'index.php'); }
	//process login form if submitted
	if(isset($_POST['submit'])){

		$username = $_POST['username'];
		$password = $_POST['password'];
		$_SESSION['username'] = $username;
		if($user->login($username,$password)){ 
			
			if($username=='admin'){
				header('Location: '.DIR.'pages/admin.php');
			}else{
				header('Location: '.DIR.'index.php');
			}
			
			exit;
		
		} else {
			$error[] = 'Wrong username or password or your account has not been activated.';
		}

	}//end if submit
	//define page title
	$title = 'Login';
	?>
	<body>   
		<?php include '../includes/navigationBar.php'; ?>
		<div id="container">
			<div class="signin_content">
				<h1>Please Login</h1>   
				<p><a href='/Artifacty/index.php'>Back to home page</a></p>
				<hr>
				<?php
					//check for any errors
					if(isset($error)){
						foreach($error as $error){
							echo '<p class="bg-danger">'.$error.'</p>';
						}
					}
					if(isset($_GET['action'])){

						//check the action
						switch ($_GET['action']) {
							case 'active':
								echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
								break;
							case 'reset':
								echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
								break;
							case 'resetAccount':
								echo "<h2 class='bg-success'>Password changed, you may now login.</h2>";
								break;
						}
					}				
				?>
				<form class="sign_in_new" action="" method="post" >
					<div class="input_cont">
						<input class="input_text" type="text" placeholder="Username" name="username" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1"></input>
					</div>
					<div class="input_cont">
						<input class="input_text" type="password" autocomplete="off" placeholder="Password" name="password" tabindex="2"></input> 
					</div> 
					  <p><a href='/Artifacty/pages/sendmailreset.php'>Forgot your Password?</a></p>
					<div class="input_cont">
						<input type="submit" name="submit" value="LOGIN" class="button register" tabindex="3">
					</div>
				</form>
			</div>
		</div>
	</body>
	<?php include '../includes/footer.php'; ?>
</html>