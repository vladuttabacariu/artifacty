<?php
$siteroot = '/Artifacty';
include('C:\xampp\htdocs\Artifacty\includes/config.php'); 
include('C:\xampp\htdocs\Artifacty/PHPMailer/class.phpmailer.php');
?>
<head>
	<meta charset="UTF-8">
	<title>Artifacty</title>
	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
	<script type="text/javascript" src="<?php echo $siteroot;?>/javascript/slider.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $siteroot;?>/css/css.css">
	<script type="text/javascript" src="<?php echo $siteroot;?>/javascript/worldMap.js"></script>
</head>
<header>
	<div id="header">
		<div id="headerContainer" class="clearfix">
			<div id="logo">
				<img src="<?php echo $siteroot;?>/images/logo/logo.png"/>
			</div>
			<div id="register_login">
				<?php if( $user->is_logged_in() ){echo '<a href="'.$siteroot.'/pages/memberpage.php">Hi, '.$_SESSION['username'].'</a>';} else { echo '<a href="'.$siteroot.'/pages/login.php">Login</a>';}?> |
				<?php if( $user->is_logged_in() ){echo '<a href="'.$siteroot.'/pages/memberpage.php">My Account</a>';}?> | 
				<?php if( $user->is_logged_in() ){echo '<a href="'.$siteroot.'/pages/logout.php">Log Out!</a>';} else { echo '<a href="'.$siteroot.'/pages/register.php">Register</a>';}?>				
			</div>
			<form action="#" method="get" id="quick_search" role="search">
				<div id="search" class="clearfix">
					<input id="quickSearch" class="text white" placeholder="" type="search">
					<span class="btn_icon icon_search">
						<input value="Search" onclick="search(1)">
					</span>
				</div>
			</form>
			
		</div>		
	</div>
</header>