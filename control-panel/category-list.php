<?php
$pageTitle = "Category list";
$pageDescription = "";

require_once("../includes/config.inc.php");
require_once("authentication-check.inc.php");
require_once("../includes/CategoryDataAccess.inc.php");
require_once("../includes/header.inc.php");




?>

<main>

	<div class="wrapper style2">
        <h3>Blog List</h3>
        <a href="category-details.php">Add a new category</a>
        <?php
        $cda = new CategoryDataAccess(getDBLink());
        $categories = $cda->getCategoryList(false);
        echo(displayCategories($categories));
        
        ?>
	</div>

</main>

<?php
function displayCategories($categories){
    $html = "<table class=\"default\" border =\"1\"";

    $html .= "<tr>
            <th>Name</th>
            <th>Active</th>
            <th>Edit</th>
            ";

            foreach($categories as $category){
                $html .= "<tr>";
                $html .= "<td>{$category['name']}</td>";
                $html .= "<td>{$category['active']}</td>";
                $html .= "<td><a href=\"category-details.php?categoryId={$category['categoryId']}\">EDIT</a></td>";
                $html .= "</tr>";
            }
            $html .= "</table>";

            return $html;
}

if(!empty($sideBar)){
    require($sideBar);

    
}
require_once("../includes/footer.inc.php");
?>