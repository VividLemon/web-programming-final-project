<?php
require_once("config.inc.php");

?>

<!DOCTYPE HTML>

<head>
    <title><?php echo $pageTitle; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="<?php echo(PROJECT_DIR); ?>assets/css/main.css" />
    <!-- NoScript -->
    <noscript>
        <link rel="stylesheet" href="<?php echo(PROJECT_DIR); ?>assets/css/noscript.css" /></noscript>

</head>


<div id="header">
    <!-- Inner -->
    <div class="inner">
        <header>
            <h1><?php echo $pageTitle; ?></h1>
        </header>
    </div>

    <!-- Nav -->
    <nav id="nav">
        <ul>
            <li><a href="<?php echo(PROJECT_DIR); ?>index.php">Home</a></li>
            <li><a href="<?php echo(PROJECT_DIR); ?>pictures.php">Pictures -- get rid of?</a></li>
            <li><a href="<?php echo(PROJECT_DIR); ?>blog/index.php">Blog</a></li>
            <li><a href="<?php echo(PROJECT_DIR); ?>contact.php">Contact</a></li>
            <?php
			if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == "yes"){
				
				echo('<li><a href="' . PROJECT_DIR . 'control-panel/index.php">Control Panel</a></li>');
				
			}else{
				echo '<li><a href="' . PROJECT_DIR . 'control-panel/login.php">Login</a></li>'; // TODO: DELETE THIS ON SERVER UPLOAD!!!!
			}
			if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == "yes"){
				echo '<li><a href="' . PROJECT_DIR . 'control-panel/logout.php">Logout</a></li>';
			}
			?>
        </ul>
    </nav>

    

</div>

</div>