<?php
//a file to force download files
$file = ''; //gets the file name from the given url
$dir  = ''; //gets the directory of the file
/*if(isset($_REQUEST['file']) && isset($_REQUEST['dir'])){
	$file = $_REQUEST['file'];
	$dir  = $_REQUEST['dir'];
	$filename = $dir.$file;

	if (file_exists($filename)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filename));
		readfile($filename);
		exit;
	}else{
		echo "string";
	}
}
*/

if(isset($_REQUEST["file"]) && isset($_REQUEST["dir"])){
    // Get parameter and decode URL-encoded string
    $file = urldecode($_REQUEST["file"]);
    $dir = urldecode($_REQUEST["dir"]);

   
    // Test whether the file name contains illegal characters
        
    if(preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)){
        $filepath = $dir . $file;
   
        // Process download
        if(file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'
                                        .basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
  
            // Flush system output buffer
            flush(); 
            readfile($filepath);
            die();
        } else {
            http_response_code(404);
            die();
        }
    } else {
        die("Download cannot be processed");
    }
}
