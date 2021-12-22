<?php
	require_once("includes/config.inc.php");
	$pageTitle = "Contact confirmation page";
	$pageDesc = "Contact confirmation for the sites contact page.";	
	require("includes/header.inc.php");
	$sideBar = "includes/hobbies-sidebar.inc.php";
	
	

?>

<main>

	<div class="wrapper style1">
		<h1>EMAIL HAS BEEN SENT!</h1>
		<div class="img-container">
			
		</div>
		<p>Thank you!</p>
	</div>

</main>
<?php
if(!empty($sideBar)){
	require($sideBar);
}

require("includes/footer.inc.php");
?>