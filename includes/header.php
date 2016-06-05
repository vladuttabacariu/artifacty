<?php
$siteroot = '/Artifacty';
define('ROOT_DIR','C:/xampp/htdocs/Artifacty/');
include(ROOT_DIR.'includes/config.php'); 
include(ROOT_DIR.'PHPMailer/class.phpmailer.php');
?>
<head>
	<meta charset="UTF-8">
	<title>Artifacty</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo $siteroot;?>/javascript/slider.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $siteroot;?>/css/css.css">
	<script type="text/javascript" src="<?php echo $siteroot;?>/javascript/worldMap.js"></script>
</head>
<header>
	<div id="header">
		<div id="headerContainer">
			<div id="logo">
				<a href="<?php echo $siteroot.'/index.php';?>"><img src="<?php echo $siteroot;?>/images/logo/logo.png"/></a>
			</div>
			<div id="register_login">
				<?php if( $user->is_logged_in() ){if($_SESSION['username']=='admin'){echo '<a href="'.$siteroot.'/pages/admin.php">Hi, '.$_SESSION['username'].'</a>';}else{echo '<a href="'.$siteroot.'/pages/myartifacts.php">Hi, '.$_SESSION['username'].'</a>';}} else { echo '<a href="'.$siteroot.'/pages/login.php">Login</a>';}?> |
				<?php if( $user->is_logged_in() ){if($_SESSION['username']=='admin'){echo '<a href="'.$siteroot.'/pages/admin.php">Go to AdminPage</a>';}else{echo '<a href="'.$siteroot.'/pages/myartifacts.php">My Artifacts</a>';}}?> | 
				<?php if( $user->is_logged_in() ){echo '<a href="'.$siteroot.'/pages/logout.php">Log Out!</a>';} else { echo '<a href="'.$siteroot.'/pages/register.php">Register</a>';}?>				
			</div>
			<form action="/Artifacty/pages/search.php" method="get" id="quick_search" role="search">
				<div id="search">
					<input id="quickSearch" class="text white" placeholder="" name="search" type="search">
					<span class="btn_icon icon_search">
						<input value="Search" type="submit">
					</span>
				</div>
			</form>
			
		</div>		
	</div>
</header>