<?php
require_once("../includes/config.inc.php");
require("authentication-check.inc.php");
require_once("../includes/FileDataAccess.inc.php");

$pageTitle = "File List";
$pageDescription = "";

require("../includes/header.inc.php");
?>
<main>
	<div class="wrapper style2">
		<h3>File List</h3>
		<a href="file-details.php">Add New File</a>
		<?php
		// Construct a FileDataAccess object (pass in the 'link' to the db)
		$fda = new FileDataAccess(getDBLink());
		
		// Invoke the getFileList() method and assign the return value to a variable named $files
		// Be careful: unlike getPageList(), getFileList() does not take any parameters.
        $files = $fda->getFileList();
        echo displayFiles($files);
		// invoke displayFiles() and pass $files in as the argument/param, then echo out the return value 
		?>
		
	</div>
</main>
		
<?php
if(!empty($sideBar)){
	require("../includes/" . $sideBar);
}

require("../includes/footer.inc.php");

/////////////////
// FUNCTIONS
/////////////////

// Wraps files in an html table
function displayFiles($files){

	// create a starting table tag and stor it in a var named $html
	$html = "<table class=\"default\">";

	// create column headers
	$html .= "<th>File id</th><th>File name</th><th>File description</th><th>File Extension</th><th>File size</th>";
	
	// create table rows (loop through the files)
    foreach($files as $value){
        $html .= "<tr>";
        $html .= "<td>{$value['fileId']}</td>";
        $html .= "<td>{$value['fileName']}</td>";
        $html .= "<td>{$value['fileDescription']}</td>";
        $html .= "<td>{$value['fileExtension']}</td>";
        $html .= "<td>{$value['fileSize']}</td>";
        $html .= "</tr>";
    }
    $html .= '</table>';
	// add the closing table tag
	
	// return the html string
    return $html;
}

?>
