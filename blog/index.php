<?php
	require_once("../includes/config.inc.php");
	$pageTitle = "Blog Posts Page";
	$pageDesc = "This page contains all the blog posts I have written for this site";	
	require("..\includes\header.inc.php");
	$sideBar = "..\includes\hobbies-sidebar.inc.php";
	require_once("../includes/PageDataAccess.inc.php");
	$pda = new PageDataAccess(getDBLink());
	$number_of_blogs = $pda->getPageList();
	$max_per_page = 6;
	$pageno = $_GET['pageno'] ?? 1;
	$search_query = $_GET['search'] ?? "";
	$offset = ($pageno - 1) * $max_per_page;
	$number_of_pages = ceil(count($number_of_blogs)/$max_per_page);
	if(!isset($_GET['search'])){
		$paginated = $pda->getPaginatedList($offset, $max_per_page);
	}else{
		$paginated = $pda->search_bar_pages($search_query);
		$number_of_blogs = $paginated;
		$number_of_pages = ceil(count($paginated)/$max_per_page);
		$paginated = $pda->search_bar_pages($search_query, true, true, $offset, $max_per_page);
	}
	
?>
<main>
	<div class="wrapper style1">
		<h1>Blog</h1>
		<form action="index.php" class="search">
			<input type="text" name="search" id="search" placeholder="Search..." class="search"> 
			<button type="submit"><i class="fa fa-search"><a href="<?php echo "<a href=\"search={$search_query}\""; ?>"></a></i></button>
		</form>
		<?php 
			if(isset($_GET['search']) && strlen($search_query) < 5){
				echo "Search text is too short. Try a more precise search";
			}else{
				if(count($number_of_blogs) < 1){
					echo "<h3>No results found. Sorry!</h3>";
				}else{
					if(count($number_of_blogs) > $max_per_page){
					echo place_page_numbers($number_of_pages, $pageno);
					echo createBlogList($paginated);
					echo place_page_numbers($number_of_pages, $pageno);
					}else{
						echo createBlogList($number_of_blogs);
					}
				}
			}
			
		?>
	</div>
</main>
<?php
function substring_length($str){
	$length_limit = 197;
	if(strlen($str) <= $length_limit){
		return $str;
	}else{
		$substring = substr($str, 0, 197);
		$substring .= "...";
		return $substring;
	}
}
function place_page_numbers($number_of_pages, $pageno){
	// if pages get to be large, should include a ... and
	 // a limited number of pages like typical convention
	$html = "<ul class=\"pagination\"><li>pages</li>";
	for($i = 1; $i <= $number_of_pages; $i++){
		$current_page = $pageno == $i ? "style=\"color:#DF7366;\"" : "";
		$is_not_last = $number_of_pages != $i ? "<p>,</p>" : "";
		$add_search = isset($_GET['search']) ? "search={$_GET['search']}&" : "";
		$html .= "<li {$current_page}><a href=\"?{$add_search}pageno={$i}\">{$i}</a></li>{$is_not_last}";
	}
	$html .= "</ul>";
	return $html;
}

function createBlogList($pages){
	if(count($pages) > 0){
		$html = "<div class=\"row\">";
		$count = 0;
		$total_passes = 0;
		foreach($pages as $p){
			$count++;
			$total_passes++;
			$content = substring_length($p['content']);
			$html .= "<article class=\"col-4 col-12-mobile special\">";
			$html .= "<div class=\"special-div\">";
			$html .= "<a href=\"blog-post.php?pageId={$p['pageId']}\">";
			$html .= "<img class=\"image featured special-div-img\" src=\"{$p['defaultImg']}\" style=\"margin-top:2rem; margin-bottom:2rem;margin: 0 auto;\">";
			$html .= "</a>"; 
			$html .= "<div class=\"special-div-2\">";
			$html .= "<header>";
			$html .= "<h3 style=\"text-decoration:underline;\"><a href=\"blog-post.php?pageId={$p['pageId']}\">{$p['title']}</a></h3>";
			$html .= "</header>";
			$html .= "<p style=\"font-size:0.9rem;\">{$content}</p>";
			$html .= "</div>";
			$html .= "</div>";
			$html .= "</article>";
			$html .= "<br>";
			if($count == 3){
				$html .= "</div>";
				$count = 0;
				if($total_passes != count($pages)){
					$html .= "<br>";
					$html .= "<div class=\"row\">";
				}
			}
		}
		$html .= "</div>";
		return $html;
	}else{
		return false;
	}
}
require("../includes/footer.inc.php");
?>
<script>
const images = document.querySelectorAll(".image");	
const windowResizeEvt = 800;
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
	if(window.innerWidth < windowResizeEvt){
		for(let i = 0; i < images.length; i++){
			images[i].style.display="none";
		}
	}
});
window.addEventListener('resize', debounce(() => {
	if(window.innerWidth < windowResizeEvt){
		for(let i = 0; i < images.length; i++){
			images[i].style.display="none";
		}
	}else if(window.innerWidth > windowResizeEvt && images[0].style.display == "none"){
		for(let i = 0; i < images.length; i++){
			images[i].style.display="block";
		}
	}
}, 500));
</script>