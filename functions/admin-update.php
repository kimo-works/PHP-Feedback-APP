<?php 
	include_once('../db.php');
	$ID = ( isset( $_POST['ID'] ) ) ? $_POST['ID'] : '';
	$status = ( isset( $_POST['status'] ) ) ? $_POST['status'] : '';
	if (!empty($status)) {	
		$sql = "UPDATE feedbacks SET status = '$status' WHERE ID = '$ID' ";
		$query = $conn->query($sql);
		$query = $query->execute();
		if ($query) {
			if ($status == "unpublished") {
				$message = "Published";
			}
			elseif ($status == "Published") {
				$message = "unpublished";
			}
			$response = [
				"status" => true,
				"message" => $message,
			];
			echo json_encode($response);
			die();
		}
	}