<?php



	include_once('db.php');


		$authorfeed = ( isset( $_POST['authorfeed'] ) ) ? $_POST['authorfeed'] : '';
		$email = ( isset( $_POST['email'] ) ) ? $_POST['email'] : '';
		$feedtext = ( isset( $_POST['feedtext'] ) ) ? $_POST['feedtext'] : '';
		// var_dump(	$feedtext);
		$date = date("Y-m-d H:i:s");

		if ($authorfeed == '') {
		    $error_fields[] = 'name';
		}

		if ($email == '') {
		    $error_fields[] = 'email';
		}

		if ( $feedtext == '') {
		    $error_fields[] = 'text';
		}

		if (!empty($error_fields)) {
		    $response = [
		        "status" => false,
		        "type" => 1,
		        "message" => "Please enter correct",
		        "fields" => $error_fields
		    ];

		    echo json_encode($response);
		    die();
		} elseif ( empty($error_fields) ) {			
			include_once('functions/upload-file.php');
			$FileNames = serialize($FileNames);

			$SqlQuery = "INSERT INTO `feedbacks` (`name`, `email`, `text`, `files`, `date`, `status`) VALUES (?,?,?,?,?,'unpublished')";
			$FeedbackQuery = $conn->prepare($SqlQuery)->execute([$authorfeed,$email,$feedtext,$FileNames,$date]);

			if ($FeedbackQuery) {				 		
				$response = [
				    "status" => true,
				    "message" => "Your feedback was send"
				];
				echo json_encode($response);
				die();
			}else {
				$response = [
				    "status" => false,
				    "type" => 1,
				    "message" => "Please enter correct",
				    "fields" => $error_fields
				];
				echo json_encode($response);
				die();
			}
		}

