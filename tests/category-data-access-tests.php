<?php
require_once("../includes/config.inc.php");
require_once("../includes/CategoryDataAccess.inc.php");


$cda = new CategoryDataAccess(getDBLink());

echo("ACTIVE CATEGORIES");
$activeCategories = $cda->getCategoryList();
var_dump($activeCategories);

echo("ALL CATEGORIES");
$allCategories = $cda->getCategoryList(false);
var_dump($allCategories);

echo("<br>GET CATEGORY BY ID<br>");
$cat = $cda->getCategoryById(1);
var_dump($cat);

echo("<br>INSERT CATEGORY");

// create a 'category' (assoc array) to insert
$cat = array();
$cat['name'] = "A NEW CATEGORY!";
$cat['active'] = "yes";

echo "<br>UPDATE CATEGORY";
// insert it...
$cat = $cda->insertCategory($cat);
var_dump($cat);
$cat['categoryId'] = 3;
$cat['name'] = "AN UPDATED CATEGORY!";
$cat['active'] = "no";

// update it...
$cat = $cda->updateCategory($cat);
var_dump($cat);
			

?>