<?php

require_once("../includes/config.inc.php");



$pageTitle = "Login";
$pageDescription = "Config panel";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $userNameEntered = isset($_POST['txtUserName']) ? $_POST['txtUserName'] : null;
    $passwordEntered = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : null;

    $userName = "you";
    $password = "opensesame";
    
    if($userNameEntered == $userName && $passwordEntered == $password){

        session_regenerate_id(true);
        $_SESSION['authenticated'] = "yes";
        
        header("Location: index.php");
        exit();
    }
    
}
elseif($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_COOKIE[session_name()])){
        setcookie( session_name(), "", time() - 3600, "/");
    }
    $_SESSION = array();

    session_destroy();
}



require("../includes/header.inc.php");
?>
<main>
	<div class="wrapper style1">
		<h3>Login</h3>
		<form method="POST" action="">
			<label for="txtUserName">User Name</label>
			<br>
			<input type="text" name="txtUserName" id="txtUserName" />
			<br>
			<label for="txtPassword">Password</label>
			<br>
			<input type="password" name="txtPassword" id="txtPassword" />
			<br>
            <input type="submit" value="Log In">
            <br>
		</form>
	</div>
</main>
		
<?php
if(!empty($sideBar)){
	require("../includes/" . $sideBar);
}

require("../includes/footer.inc.php");