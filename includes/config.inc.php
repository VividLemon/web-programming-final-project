<?php

    session_start();

    set_error_handler("customErrorHandler");

    if($_SERVER['SERVER_NAME'] == 'localhost'){
        
        define("PROJECT_DIR", "/AdvancedWebDev/PHP/MyWebSiteFinal/web-programming-final-project/");
        define("IMAGES_DIR", PROJECT_DIR . "images/");
        define("DEBUG_MODE", true);
        define("ADMIN_EMAIL", "copseyi@students.westerntc.edu");
        define("DB_HOST", "localhost");
        define("DB_USER", "root");
        define("DB_PASSWORD", "");
        define("DB_NAME", "my-new-site");
        define("UPLOAD_FOLDER", PROJECT_DIR . "uploaded-files/");
        define("SERVER_UPLOAD_FOLDER", $_SERVER['DOCUMENT_ROOT'] . UPLOAD_FOLDER);
        define("THUMBNAIL_FOLDER", UPLOAD_FOLDER . "thumbnails/");
        define("SERVER_THUMBNAIL_FOLDER", SERVER_UPLOAD_FOLDER . "thumbnails/");

    }else{
        define("PROJECT_DIR", "/");
        define('IMAGES_DIR', PROJECT_DIR . "images/");
        define("DEBUG_MODE", false);
        define("ADMIN_EMAIL", "copseyi@students.westerntc.edu");
        define("DB_HOST", "xxxxxxxx");// GET THESE FROM cPANEL in QTH. Make user to get these.
        define("DB_USER", "xxxxxxxx");// GET THESE FROM cPANEL in QTH. Make user to get these.
        define("DB_PASSWORD", "xxxxxxxx");// GET THESE FROM cPANEL in QTH. Make user to get these.
        define("DB_NAME", "my-new-site");
        define("UPLOAD_FOLDER", PROJECT_DIR . "uploaded-files/");
        define("SERVER_UPLOAD_FOLDER", $_SERVER['DOCUMENT_ROOT'] . UPLOAD_FOLDER);
        define("THUMBNAIL_FOLDER", UPLOAD_FOLDER . "thumbnails/");
        define("SERVER_THUMBNAIL_FOLDER", SERVER_UPLOAD_FOLDER . "thumbnails/");

        if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
            $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . $redirect);
            exit();
        }   
    }

    if(DEBUG_MODE){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }

    function sendEmail($to, $subject, $msg, $headers=""){
        rtrim($headers);
        $defaultHeaders = 'To: Website Admin <'. $to .'>' . "\r\n";
  	    $defaultHeaders .= 'MIME-Version: 1.0'  . "\r\n";
  	    $defaultHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  	    $headers = $defaultHeaders . $headers . "\r\n";
        
        if(mail($to, $subject, $msg, $headers)){
            return true;
        }else{
            return false;
        }
    }

    function customErrorHandler($errno, $errstr, $errfile, $errline){
        $errorMsg = "<b>THIS IS OUR CUSTOM ERROR HANDLER</b>";
        $errorMsg .= "<br>ERROR NUMBER: $errno";
        $errorMsg .= "<br>ERROR MSG: $errstr";
        $errorMsg .= "<br>FILE: $errfile";
        $errorMsg .= "<br>LINE NUMBER: $errline";

        if(DEBUG_MODE){
            echo($errorMsg);
        }else{
            sendEmail(ADMIN_EMAIL, "WEBSITE ERROR!", $errorMsg . getAllSuperGlobals());
            header("Location: " . PROJECT_DIR . "error.php");
            exit();
        }
    }
    function getAllSuperGlobals(){

        $str = "<br>POST VARS:<br>" . print_r($_POST, true);
        $str .= "<br>GET VARS:<br>" .  print_r($_GET, true);
        $str .= "<br>SERVER VARS:<br>" .   print_r($_SERVER, true);
        $str .= "<br>FILE VARS:<br>" .  print_r($_FILES, true);
        $str .= "<br>COOKIE VARS:<br>" .  print_r($_COOKIE, true);
        $str .= "<br>REQUEST VARS:<br>" .  print_r($_REQUEST, true);
        $str .= "<br>ENV VARS:<br>" .  print_r($_ENV, true);
    
        // Only include the SESSION super global if the site is using sessions
        if(isset($_SESSION)){
            $str .= "<br>SESSION VARS:<br>" .  print_r($_SESSION, true);
        }
    
        return $str;
    }
    $link = null;

    function getDBLink(){
        global $link;
        if($link == null){
            $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            if(!$link){
                throw new Exception(mysqli_connect_error());
            }
        }
        return $link;
    }

    function sanitizeHtml($inputHTML){
       
        // we'll allow these tags, but no others (we are white-listing)
        $allowed_tags = array('<sub>','<sup>','<div>','<span>','<h1>','<h2>','<br>','<h3>','<h4>','<h5>','<h6>','<h7>','<i>','<b>','<a>','<ul>','<ol>','<em>','<li>','<pre>','<hr>','<blockquote>','<p>','<img>','<strong>','<code>');
    
        //replace dangerous attributes...
        $bad_attributes = array('onerror','onmousemove','onmouseout','onmouseover','onkeypress','onkeydown','onkeyup','onclick','onchange','onload','javascript:');
        $inputHTML = str_replace($bad_attributes,"x",$inputHTML);
       
        $allowed_tags = implode('',$allowed_tags);
        $inputHTML = strip_tags($inputHTML, $allowed_tags);
    
        return $inputHTML;
    
    }
    function redirectTo404Page(){
        header("HTTP/1.0 404 Not Found");
        header("Location: " . PROJECT_DIR . "404.php");
    }

    function validateDate($dateStr){
        $dateParts = explode('/', $dateStr);
        if(count($dateParts) != 3){
            return false;
        }
        if(strpos($dateStr, ".") !== FALSE){
            return false;
        }
        if(intval($dateParts[0]) > 0 && intval($dateParts[1]) > 0 && intval($dateParts[2]) > 0){
            return checkdate($dateParts[0], $dateParts[1], $dateParts[2]);
        }else{
            return false;
        }
        return true;
    }
    function convertDateForMySQL($dateStr){
        $dt = new DateTime($dateStr);
        return $dt->format('Y-m-d');
    }

    function wrapValidationMsg($str){
        return "<span class=\"validation-message\">{$str}</span>";
    }