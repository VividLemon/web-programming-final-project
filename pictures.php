<?php
	require_once("includes/config.inc.php");
	$pageTitle = "Pictures Page";
	$pageDesc = "This webpage has pictures for my site that I am showing off";
	require("includes/header.inc.php");
	$sideBar = "includes/hobbies-sidebar.inc.php";
	

?>
<script src="js/photo-gallery.js" defer></script>
<style>
			.button-container{
				display:flex;
				align-items: center;
			}
			.button-container > input[type="button"]{
				margin:auto;
				width:25%;
			}</style>
<main>
	<div class="wrapper style2">
		<article id="main" class="container special">
			<div id="image-gallery">
				<img id="mainImg" src="" class="image featured picture"/>
			</div>
			<div class="button-container">
			<input type="button" id="btnPrev" value="Prev" />
			<input type="button" id="btnNext" value="Next" />
			</div>
	</div>

</main>
<?php


require("includes/footer.inc.php");
?>