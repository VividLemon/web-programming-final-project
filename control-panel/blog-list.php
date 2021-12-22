<?php
    require_once("../includes/config.inc.php");
    require("authentication-check.inc.php");
    require_once("../includes/PageDataAccess.inc.php");
    $pageTitle = "Blog List";
    $pageDescription = "";
    require("../includes/header.inc.php");

?>

<main>

	<div class="wrapper style2">
        <h3>Blog List</h3>
        <a href="blog-details.php">Add a new blog page</a>
        <?php
        $pda = new PageDataAccess(getDBLink());
        $pages = $pda->getPageList(false);
        echo(displayPages($pages));
        
        ?>
	</div>

</main>
<?php




function displayPages($pages){
    $html = "<table class=\"default\" border=\"1\"";

    $html .= "<tr>
            <th>Title</th>
            <th>Publish Date</th>
            <th>Active</th>
            <th>Edit</th>";

    foreach($pages as $page){
        $html .= "<tr>";
        $html .= "<td>{$page['title']}</td>";
        $html .= "<td>{$page['publishedDate']}</td>";
        $html .= "<td>{$page['active']}</td>";
        $html .= "<td><a href=\"blog-details.php?pageId={$page['pageId']}\">EDIT</a></td></td>";
    }

    $html .= "</table>";

    return $html;
}


if(!empty($sideBar)){
	require($sideBar);
}

require("../includes/footer.inc.php");
?>