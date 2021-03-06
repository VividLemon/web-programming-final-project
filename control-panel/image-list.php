<?php
require_once("../includes/config.inc.php");
require("authentication-check.inc.php");
require_once("../includes/FileDataAccess.inc.php");

$fda = new FileDataAccess(getDBLink());
$files = $fda->getFileList();
// Note: we may want to create a method in the FileDataAccess class
// that just returns image files (or adapt getFileList() with an optional paremeter) 
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

</head>
<body>
<h3>Images</h3>
<table border="1">
	<tr>
		<th>Thumbnail</th>
		<th>Description</th>
		<th>Extension</th>
	</tr>
	<?php
	// loop through the files and create a table row for each one
	foreach ($files as $f) {
		echo(createTableRow($f));
	}
	?>
</table>

</body>
</html>
<?php

/////// FUNCTIONS ////////

// creates a table row for a file
function createTableRow($file){

	$realFileName = $file['fileId'] . "." . $file['fileExtension']; 
	// It would be better to pull the 'real file name' from the database query
	// We can discuss this, but for now, we'll get the real file name by doing this
	
	$html = '<tr>';
	$html .= '<td><img src="' . THUMBNAIL_FOLDER . $realFileName . '" />'; 
	$html .= '<td>' . $file['fileDescription'] . '</td>';
	$html .= '<td>' . createFileLink($file) . '</td>';
	$html .= '</tr>';

	return $html;
}

// creates an anchor tag for a file
// creates an anchor tag for a file/image that will be inserted into a blog post
function createFileLink($file){

	$realFileName = $file['fileId'] . "." . $file['fileExtension']; 
	// It would be better to pull the 'real file name' from the database query
	// We can discuss this, but for now, we'll get the real file name by doing this

	// We need to escape any quotes in the file description, since they
	// could mess up the attribute in the anchor tag we are creating
	$description = addslashes($file['fileDescription']);

	$html = "<a";
	$html .= " href=\"javascript:void(0)\" ";
	$html .= " class=\"insertImg\"";
	$html .= " data-filename=\"$realFileName\"";
	$html .= " data-filedescription=\"$description\"";
	$html .= ">INSERT</a>";

	return $html; 
}
?>
