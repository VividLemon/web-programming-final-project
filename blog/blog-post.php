<?php
require_once("../includes/PageDataAccess.inc.php");
require_once("../includes/config.inc.php");
$pda = new PageDataAccess(getDBLink());
$page = null;
// use the pageId query string param to get all the data for the blog page
if(isset($_GET['pageId'])){
	try{
		$page = $pda->getPageById( $_GET['pageId'] );
	}catch(Exception $e){
		redirectTo404Page();
	}
}
if(!$page || $page['active'] == "no"){
	redirectTo404Page();
}
$pageTitle = $page['title'];
$pageDescription = $page['description'];
require("../includes/header.inc.php");
?>
		<main>
			<div class="wrapper style1">
				<div id="button" style="display:block;"><a href="<?php echo PROJECT_DIR . "blog/index.php"; ?>"><i style="font-size:24px" class="fa" id="back">&#xf104; back</i></a></div>
					<article>
						<i>Published date: <?php echo($page['publishedDate']); ?></i>
						<h3>Blog title: <?php echo($page['title']); ?></h3>
						<div class="blog-content">
							<?php echo($page['content']); ?>
						</div>
					</article>
			</div>
		</main>
<?php
if(!empty($sideBar)){
	require("../includes/" . $sideBar);
}
require("../includes/footer.inc.php");

?>
<script>
const button = document.getElementById(`back`);
const windowResizeEvt = 736;
const debounce = (func, delay) => { 
    let debounceTimer 
    return function() { 
        const context = this
            clearTimeout(debounceTimer) 
                debounceTimer 
            = setTimeout(() => func.apply(context), delay) 
    } 
}	
window.addEventListener('load', evt => {
	if(window.innerWidth > windowResizeEvt){
		button.style.display="none";
	}
});
window.addEventListener('resize', debounce(() => {
	if(window.innerWidth < windowResizeEvt){
		button.style.display="block";
	}else if(window.innerWidth > windowResizeEvt){
		button.style.display="none";
	}
}, 500));
</script>
