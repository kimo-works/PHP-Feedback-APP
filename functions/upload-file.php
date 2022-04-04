<?php 

// var_dump( $_FILES );
	// global $FileNames123; 
	$FileNames= array();
if (isset( $_FILES['fileToUpload'] )) {
	$FilesCount = count($_FILES['fileToUpload']['name']);
	// var_dump($FilesCount);	 
	for ($i=0; $i < $FilesCount; $i++) { 	
		$UploadFolder = 'uploads/';
		$FileName = $_FILES['fileToUpload']['name'][$i];
		$FileTmp =  $_FILES['fileToUpload']['tmp_name'][$i];
		$FileSize = $_FILES['fileToUpload']['size'][$i];
		$FileError = $_FILES['fileToUpload']['error'][$i];
		$FileType = $_FILES['fileToUpload']['type'][$i];


		// this for know format files. 
		$FileExt = explode('.', $FileName);
		$FileActualExt = strtolower(end ($FileExt) );
		// in the array list of allowed files
		$Allowed = array("jpg","jpeg","png", "gif" );

		if ( in_array( $FileActualExt, $Allowed ) ) {
			if ( $FileError === 0 ) {
				if ($FileSize < 1000000) {
					$FileNameNew = uniqid( '' , true).".".$FileActualExt;
					
					$FileDestination = $UploadFolder."original/".$FileNameNew;
					// 
					$MoveFile =	move_uploaded_file( $FileTmp , $FileDestination );
					if ($MoveFile) {
						$size = getimagesize($UploadFolder."original/".$FileNameNew);
						$width = $size[0];
						$height = $size[1];
						// var_dump($size);

						if ($width > 320 || $height > 240 ) {

							if ( $FileActualExt == "jpg"  ||  $FileActualExt == "jpeg") {
								$IMGFileName = $UploadFolder."original/".$FileNameNew;
								$source = imagecreatefromjpeg($IMGFileName);
								list($width, $height) = getimagesize($IMGFileName);
								$newwidth = 320;
								$newheight = 240;
								$destination = imagecreatetruecolor($newwidth, $newheight);
								imagecopyresampled($destination, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
								$output = $UploadFolder."resize/".$FileNameNew;
								imagejpeg($destination, $output , 100);
								array_push( $FileNames , $output );
							}
							if ( $FileActualExt == "png" ) {
								$IMGFileName = $UploadFolder."original/".$FileNameNew;
								$source = imagecreatefrompng($IMGFileName);
								list($width, $height) = getimagesize($IMGFileName);
								$newwidth = 320;
								$newheight = 240;
								$destination = imagecreatetruecolor($newwidth, $newheight);
								imagecopyresampled($destination, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height,$white);
								$output = $UploadFolder."resize/".$FileNameNew;
								imagepng($destination, $output);
								array_push( $FileNames , $output );
							}
							if ( $FileActualExt == "gif" ) {
								$IMGFileName = $UploadFolder."original/".$FileNameNew;
								$source = imagecreatefromgif($IMGFileName);
								list($width, $height) = getimagesize($IMGFileName);
								$newwidth = 320;
								$newheight = 240;
								$destination = imagecreatetruecolor($newwidth, $newheight);
								imagecopyresampled($destination, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
								$output = $UploadFolder."resize/".$FileNameNew;
								imagegif($destination, $output);
								array_push( $FileNames , $output );
							}
						}
						else {
							$output = $UploadFolder."original/".$FileNameNew;
							// $ImgPlace = $UploadFolder.$FileNameNew;
							array_push( $FileNames , $output );

						}

						 // 320х240 


						if ($i == $FilesCount) {
				

						}
				
					}
					else {
					    $error_fields[] = 'Files field';
					    $response = [
						        "status" => false,
						        "type" => 8,
						        "message" => "Error please try again later .",
						        "fields" => $error_fields
					    ];
					    echo json_encode($response);
					    die();
					}
				}
				else {
				    $error_fields[] = 'Files field';
				    $response = [
					        "status" => false,
					        "type" => 7,
					        "message" => "Your file so big !",
					        "fields" => $error_fields
				    ];
				    echo json_encode($response);
				    die();
				}


			} 
			else {
			    $error_fields[] = 'Files field';
			    $response = [
				        "status" => false,
				        "type" => 7,
				        "message" => "You had an error !",
				        "fields" => $error_fields
			    ];
			    echo json_encode($response);
			    die();
			}
		} 
		else {
		    $error_fields[] = 'Files field';
		    $response = [
			        "status" => false,
			        "type" => 6,
			        "message" => "Please enter correct files This File not Allowed .",
			        "fields" => $error_fields
		    ];
		    echo json_encode($response);
		    die();
		}
	}
 


}
