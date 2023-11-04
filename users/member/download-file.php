<?php
//a file to force download files
$file = ''; //gets the file name from the given url
$dir  = ''; //gets the directory of the file
if(isset($_GET['file']) && isset($_GET['dir'])){
	$file = $_GET['file'];
	$dir  = $_GET['dir'];
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
	}
}
