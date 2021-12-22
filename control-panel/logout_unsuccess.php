<?php
require_once("../includes/config.inc.php");
$pageTitle = "Logout success";
$pageDescription = "";
require_once("../includes/header.inc.php");

if(!empty($_SESSION)){
    Header("Location: " . PROJECT_DIR . "control-panel/logout_unsuccess.php");
}else{
    Header("Location: " . PROJECT_DIR . "control-panel/logout_success.php");
}
?>

Logout was unsuccessful!

<?php
require_once("../includes/footer.inc.php");

?>