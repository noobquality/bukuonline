<?php
	if (isset($_GET['file']) && basename($_GET['file']) == $_GET['file']){
		$filename = $_GET['file'];
	} 
	else{
		$filename = NULL;
		$err = 'Maaf gambar tidak tersedia';
	}
	if (!$filename){
		echo $err;
	} 
	else{
		$path = 'products/'.$filename;
		if (file_exists($path) && is_readable($path)){
			$size = filesize($path);
			header('Content-Type: application/octet-stream');
			header('Content-Length: '.$size);
			header('Content-Disposition: attachment; filename='.$filename);
			header('Content-Transfer-Encoding: binary');
			$file = @ fopen($path, 'rb');
			if ($file){
				fpassthru($file);
				exit;
			} 
			else{
				echo $err;
			}
		} 
		else{
			echo $err;
		}
	}
?>
