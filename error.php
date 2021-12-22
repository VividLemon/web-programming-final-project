<?php
	require_once("includes/config.inc.php");
	$pageTitle = "SITES ERROR PAGE";
	$pageDesc = "This is an error page redirect. SORRY!";	
	require("includes/header.inc.php");
	$sideBar = "includes/hobbies-sidebar.inc.php";
	

?>

<main>

	<div class="wrapper style1">
		<h1>Error!</h1>
        <p>We have encountered an error on our end. All details have already been sent, it will be fixed as soon as possible! Sorry for the inconvenience</p>
	</div>

</main>
<?php
// if(!empty($sideBar)){
// 	require($sideBar);
// }

require("includes/footer.inc.php");
?>