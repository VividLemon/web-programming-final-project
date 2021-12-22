<?php
$pageTitle = "Category list";
$pageDescription = "";

require_once("../includes/config.inc.php");
require_once("authentication-check.inc.php");
require_once("../includes/CategoryDataAccess.inc.php");
require_once("../includes/header.inc.php");

$cda = new CategoryDataAccess(getDBLink());

$category = array();
$category['categoryId'] = 0;
$category['name'] = "";
$category['active'] = "no";



if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET['categoryId'])){
        $category = $cda->getCategoryById($_GET['categoryId']);
    }

}else if($_SERVER["REQUEST_METHOD"] == "POST"){
    $category['name'] = $_POST['name'];
    $category['active'] = $_POST['active'] ?? $category['active'];
    $category['categoryId'] = $_POST['categoryId'];
    $validationErrors = validateCategories($category);
    if(empty($validationErrors)){
        if($category['categoryId'] > 0){
            $cda->updateCategory($category);
        }else{
            $cda->insertCategory($category);
        }
        //$category['categoryId'] = $_POST['categoryId'];
        Header("Location: " . PROJECT_DIR . "control-panel/category-list.php");
    }
}

?>

<main>
    <div class="wrapper style2">
        <h1>Category Details</h1>
        <form class="control-panel" method="POST" action="<?php echo($_SERVER['PHP_SELF']) ?>">
        <input type="hidden" name="categoryId" value="<?php echo $category['categoryId']; ?>">
        <label for="name" style="font-size: 0.9rem;">Name</label>
        <?php echo(isset($validationErrors['name']) ? wrapValidationMsg($validationErrors['name']) : ""); ?>
        <input type="text" name="name" id="name" value="<?php echo $category['name']; ?>">
        <label for="active">Active</label>
        <?php echo(isset($validationErrors['active']) ? wrapValidationMsg($validationErrors['active']) . "<br>" : ""); ?>
        <label for="yes" style="display:inline; font-size: 0.9rem;">Yes</label><input type="radio" name="active" id="yes" value="yes" <?php echo ($category['active'] == "yes" ? "checked" : ""); ?>>
        <label for="no" style="display:inline; font-size: 0.9rem;">No</label><input type="radio" name="active" id="no" value="no" <?php echo ($category['active'] == "no" ? "checked" : ""); ?>>
        <br>
        <input type="submit" value="Save">
    </div>
</main>


<?php

function validateCategories($category){
    $errors = array();
    if(empty($category['name'])){
        $errors['name'] = "You must enter a name for the category.";
    }
    if(empty($category['active'])){
        //Foul play suspected!
        $errors['active'] = "You must choose whether or not it is active.";
    }
    return $errors;
}


require_once("../includes/footer.inc.php");

?>