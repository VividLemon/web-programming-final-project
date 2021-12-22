<?php
	require_once("includes/config.inc.php");
	$pageTitle = "Welcome to my site";
	$pageDesc = "Welcome to my website, it's about me, my hobbies, and web development";	
	require("includes/header.inc.php");
	$sideBar = "includes/hobbies-sidebar.inc.php";
	
	

?>

<main>

	<body class="homepage">

		<div class="wrapper style1">
			<h1>About Me</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>

		</div>
	</body>
</main>

<?php
// if(!empty($sideBar)){
// 	require($sideBar);
// }

require("includes/footer.inc.php");
?>