<?php
require_once("../includes/config.inc.php");
$pageTitle = "Logout success";
$pageDescription = "";
require_once("../includes/header.inc.php");

if(!empty($_SESSION)){
    Header("Location: " . PROJECT_DIR . "logout_unsuccess.php");
}
?>

Logout was successful.

<?php
require_once("../includes/footer.inc.php");

?>