<?php

require_once("../includes/config.inc.php");
require("authentication-check.inc.php");
$pageTitle = "Control Panel";
$pageDescription = "";
//$sideBar = "hobbies-sidebar.inc.php";

require("../includes/header.inc.php");
?>
<main>
	<div class="wrapper style2">
		<h3>Control Panel</h3>
		<ul class="control-panel">
		<li><a href="blog-list.php">Blog List</a></li>
		<li><a href="blog-details.php">Add a new blog page</a></li>
		<li><a href="file-list.php">File list</a></li>
		<li><a href="category-list.php">Category list</a></li>
		</ul>
	</div>
</main>
		
<?php
if(!empty($sideBar)){
	require("../includes/" . $sideBar);
}
require("../includes/footer.inc.php");
?>