<?php 



require_once("../includes/config.inc.php");
require_once("../includes/PageDataAccess.inc.php");

$pda = new PageDataAccess(getDBLink());

// echo("ACTIVE PAGES");
// $activePages = $pda->getPageList();
// var_dump($activePages);

// echo("ALL PAGES");
// $allPages = $pda->getPageList(false);
// var_dump($allPages);

// echo("SINGLE PAGE");
// $page = $pda->getPageById(1);
// var_dump($page);

// echo("SINGLE PAGE W/ ERROR");
// try{
//     $page = $pda->getPageById("blah");
//     var_dump($page);
// }
// catch(Exception $err){
//     echo("Yes! the handleError() function worked and threw an exception");
// }

// create some dummy data to insert into the pages table
/*
$page = array();
$page['path'] = "some path";
$page['title'] = "some title";
$page['description'] = "some description";
$page['content'] = "some content";
$page['categoryId'] = 1;
$page['publishedDate'] = date('Y-m-d', time());
$page['active'] = 'yes';

echo("<br>INSERT PAGE");

$page = $pda->insertPage($page);
var_dump($page); // Note the pageId that is assigned by the database
*/
/*
echo("<br>UPDATE PAGE");

// change the data
$page['path'] = "some other path";
$page['title'] = "some other title";
$page['description'] = "some other description";
$page['content'] = "some other content";
$page['categoryId'] = 2;
$page['publishedDate'] = date('Y-m-d', time());
$page['active'] = 'no';

$page = $pda->updatePage($page);
var_dump($page);
*/

?>