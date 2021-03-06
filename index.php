<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>GGworld</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--link style-->
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<!--js files-->
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript" src="js/post.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<!--favicon-->
		<link rel="shortcut icon" type="image/x-icon" href="img/siteIcon.ico">
		  <?php
    		require_once ('php/twitter/twitter.php');
			require_once ('php/instagram/instagram.php');
    	?>
    	
	</head>
	<body>
	<div id="search-results"></div>
		<!--navbar-->
		<div class="navbar">
			<!--navbar container-->
			<div class="navbar-container">
				<a class="navbar-icon-container" href="#"> <img class="nav-icon" src="img/MB__Sb.png"> </a>
				<!--nav menu-->
				<aside class="login"></aside>
				<nav class="navbar-menu" role="navigation">
					<a class="nav-link" href="#">Home</a>
					<a class="nav-link" href="#">Setting</a>
					<a class="nav-link" href="php/twitter/clearsessions.php">Logout</a>
				</nav>
			</div>
		</div>
		<!--content-->
		<section id="home" name="main-contain">
			<div class="status">
				<div class="status-title-container">
					<label for="field">Status</label>
					<img src="img/insta-login.png" alt="Sign in with Insta">
					<img src="img/Twitter_logo_blue.png" alt="Sign in with Twitter">
				</div>
				<div class="status-content-container">
					<textarea class="status-textarea" placeholder="text......"></textarea>
				</div>
				<button>
					Submit
				</button>
			</div>
			</section>
			<footer>
				<div id = "loadMore"><button type="button" onclick="getTweets(postUrl)">Load More</button></div>
				<!--<button type="button"  id="loadMore" onclick="debug()">Load</button>-->
				<div id ="debug"></div>
			</footer>
		<!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
	</body>
</html>