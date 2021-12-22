<?php
if(isset($_COOKIE[session_name()])){
    setcookie( session_name(), "", time() - 3600, "/");
}
session_destroy();

//require_once("authentication-check.inc.php");
require_once("../includes/config.inc.php");
$pageTitle = "Logout";
$pageDescription = "";
require_once("../includes/header.inc.php");
if(isset($_COOKIE[session_name()])){
    Header("Location: " . PROJECT_DIR . "control-panel/logout_success.php");
}else{
    Header("Location: " . PROJECT_DIR . "control-panel/logout_unsuccess.php");
}
?>


<?php
require_once("../includes/footer.inc.php");

?>