<?php
class FileDataAccess{
	
	private $link;

	// CONSTRUCTOR
	function __construct($link){
		$this->link = $link;
	}

	// We'll invoke this method when we encounter a database error
	function handleError($msg){
		throw new Exception($msg);
	}

	// Insert a file into the database
	function insertFile($file){

		// prevent SQL injection ('scrub' the $file param)
        $file["fileName"] = mysqli_real_escape_string($this->link, $file['fileName']);
        $file['fileDescription'] = mysqli_real_escape_string($this->link, $file['fileDescription']);
        $file['fileExtension'] = mysqli_real_escape_string($this->link, $file['fileExtension']);
        $file['fileSize'] = mysqli_real_escape_string($this->link, $file['fileSize']);
		// create the SQL statement/query
        $qStr = "INSERT INTO files (
            fileName,
            fileDescription,
            fileExtension,
            fileSize
            )VALUES(
                '{$file["fileName"]}',
                '{$file["fileDescription"]}',
                '{$file["fileExtension"]}',
                '{$file["fileSize"]}'
            )";
		// execute the query
        $result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));
		// if the result is valid (not false)
			// add the fileId to the $file array
            // return the $file array
        if($result){
            $file['fileId'] = mysqli_insert_id($this->link);
            return $file;
        }
        else{
            $this->handleError("Error when inserting file");
            return false;
        }
		// if the result is false (not valid)
			// invoke the handleError() method and pass in a msg as a param
			// return false
	}

	// Get a listing of all files
	function getFileList(){

		// create the SQL statement/query
        $qStr = "SELECT
                    fileId,
                    fileName,
                    fileDescription,
                    fileExtension,
                    fileSize
                    FROM files";
		// execute the query
        $result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));

		// create a $fileList array
        $fileList = array();
        
		// loop through the rows 
			// create a $file array
			// populate the $file array with data from the database (use htmlentities() to prevent XSS attacks!)
			// add the $file array to the $fileList array
        $row_count = mysqli_num_rows($result);
        for($i = 0; $i < $row_count; $i++){
            $fileCurrentRow = array();
            $row = mysqli_fetch_assoc($result);
            $fileCurrentRow['fileId'] = htmlentities($row['fileId']);
            $fileCurrentRow['fileName'] = htmlentities($row['fileName']);
            $fileCurrentRow['fileDescription'] = htmlentities($row['fileDescription']);
            $fileCurrentRow['fileExtension'] = htmlentities($row['fileExtension']);
            $fileCurrentRow['fileSize'] = htmlentities($row['fileSize']);
            array_push($fileList, $fileCurrentRow);
        }
        // return the $fileList
        return $fileList;
        
	}


	// Get a file by it's ID
	function getFileById($id){

		// prevent SQL injection attack by 'scrubbing' the $id
		$id = mysqli_real_escape_string($this->link, $id);
		// create the SQL statement to select a file by it's fileId
		$qStr = "SELECT fileId,
        fileName,
        fileDescription,
        fileExtension,
        fileSize
        FROM files
        WHERE fileId = $id";
        $result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $file = [
                "fileId" => htmlentities($row['fileId']),
                "fileName" => htmlentities($row['fileName']),
                "fileDescription" => htmlentities($row['fileDescription']),
                "fileExtension" => htmlentities($row['fileExtension']),
                "fileSize" => htmlentities($row['fileSize']),
            ];
            return $file; 
        }
        else{
            return false;
        }
		// execute the query and get the result
	
		// Check to see that we got 1 and only 1 row from the result
		
			// get the row from the result
			
			// create an array called $file
			
			// 'scrub' the columns in the row (use htmlentities() ) and transfer it into the $file array
			
			// return the $file
			

		// If we didn't get 1 row back, return false

		
	}

	// updates a row in the files table
	function updateFile($file){

        // prevent SQL injection by 'scrubbing' the values in the $file array
        $file['fileId'] = mysqli_real_escape_string($this->link, $file['fileId']);
		$file['fileName'] = mysqli_real_escape_string($this->link, $file['fileName']);
		$file['fileDescription'] = mysqli_real_escape_string($this->link, $file['fileDescription']);
		$file['fileExtension'] = mysqli_real_escape_string($this->link, $file['fileExtension']);
		$file['fileSize'] = mysqli_real_escape_string($this->link, $file['fileSize']);
		// build the SQL query
        $qStr = "UPDATE files SET
        fileName = '{$file['fileName']}',
        fileDescription = '{$file['fileDescription']}',
        fileExtension = '{$file['fileExtension']}',
        fileSize = '{$file['fileSize']}'
        WHERE fileId = {$file['fileId']}";
		// execute the query and get the results
        $result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));
        if($result){
            return $file;
        }
        else{
            $this->handleError("Unable to update file");
            return false;

        }
		// If the result exists (not false), and return the $file
		// If the result is false, then invoke the handleError() method and return false		
	
    }
    function getFileExtension($fileName){
        $parts = explode(".", $fileName);

        if(count($parts) < 2){
            $this->handle_error("$fileName has no file extension");
        }
        return array_pop($parts);
    }
}


