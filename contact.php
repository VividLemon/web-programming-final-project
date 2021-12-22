<?php
	require_once("includes/config.inc.php");
	$pageTitle = "Contact Us";
	$pageDesc = "A contact us form";
	require("includes/header.inc.php");
	$sideBar = "includes/hobbies-sidebar.inc.php";
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$firstName = $_POST['txtFirstName'] ?? null;
		$lastName = $_POST['txtLastName'] ?? null;
		$email = $_POST['txtEmail'] ?? null;
		$comments = $_POST['txtComments'] ?? null;

		if(validateContactData($firstName, $lastName, $email, $comments)){
			$msg = "NAME: $firstName $lastName <br>";
			$msg .= "Email: $email <br>";
			$msg .= "Comments: $comments";
			
			sendEmail(ADMIN_EMAIL, "Contact Form", $msg, "From: " . $email);
			header("Location: " . PROJECT_DIR . "contact-confirmation.php");
			exit();
		}else{
			$msg = getAllSuperGlobals();
			sendEmail(ADMIN_EMAIL, "Security Warning!", $msg);
			header("Location: " . PROJECT_DIR . "error.php");
			exit();
		}
	}

?>
<script src="js/contact-form.js" defer></script>
<main>

	<div class="wrapper style1">
		<h1>Contact Me</h1>

		<form id="contactForm" method="POST" action="">
			<table class="default">
				<tr>
					<td valign="bottom">First Name:</td>
					<td>
						<div class="validation-message" id="vFirstName"></div>
						<input type="text" id="txtFirstName" name="txtFirstName">
					</td>
				</tr>
				<tr>
					<td valign="bottom">Last Name:</td>
					<td>
						<div class="validation-message" id="vLastName"></div>
						<input type="text" id="txtLastName" name="txtLastName">
					</td>
				</tr>
				<tr>
					<td valign="bottom">Email:</td>
					<td>
						<div class="validation-message" id="vEmail"></div>
						<input type="text" id="txtEmail" name="txtEmail">
					</td>
				</tr>
				<tr>
					<td valign="top">Comments:</td>
					<td>
						<div class="validation-message" id="vComments"></div>
						<textarea id="txtComments" name="txtComments"></textarea>
					</td>
				</tr>
				<tr>
					<td >&nbsp;</td>
					<td>
						<input type="submit" value="SUBMIT">
					</td>
				</tr>
			</table>
		</form>

	</div>

</main>


<?php
require("includes/footer.inc.php");
function validateContactData($firstName, $lastName, $email, $comments){
	if(empty($firstName) || empty($lastName) || empty($comments) || empty($email)){
		return false;
	}
	if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
		return false;
	}
	return true;
}
?>