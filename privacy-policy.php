<?php
	require_once("includes/config.inc.php");
	$pageTitle = "Privacy policy page";
	$pageDesc = "This contains all the privacy policy claims that we make over this website";
	require("includes/header.inc.php");
	$sideBar = "includes/hobbies-sidebar.inc.php";
	
?>

<main>

	<div class="wrapper style1">
		<h1>Privacy Policy</h1>
		<p>This site DOES NOT use google analytics at this time. The below statement is a placeholder</p>
		<p>
			I respect your privacy. This site uses Google Analytics to gather information that will be used to improve
			the quality of the site. Google Analytics uses cookies to collect information. The information collected is
			considered to be anonymous. For more information about how google collects and uses information, visit this
			<a href="https://www.google.com/policies/privacy/" target="_blank">page</a>.
		</p>

	</div>

</main>
<?php

require("includes/footer.inc.php");
?>