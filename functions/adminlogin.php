<?php
session_start();
	include_once('../db.php'); 
	// var_dump($_POST);
	$login = ( isset( $_POST['login'] ) ) ? $_POST['login'] : '';
	$password = ( isset( $_POST['password'] ) ) ? $_POST['password'] : '';

	$error_fields = [];

	if ($login === '') {
	    $error_fields[] = 'login';
	}

	if ($password === '') {
	    $error_fields[] = 'password';
	}

	if (!empty($error_fields)) {
	    $response = [
	        "status" => false,
	        "type" => 1,
	        "message" => "Please enter your user name or password correct",
	        "fields" => $error_fields
	    ];

	    echo json_encode($response);

	    die();
	}

	// rebild this script
	 $password = md5($password);
	 // $UserQuery =  $conn->query("SELECT * FROM `users` WHERE `username` = '$login' AND `pass` = '$password'");
	 $UserQuery =  $conn->prepare("SELECT * FROM `users` WHERE `username` = '$login' AND `pass` = '$password'");
	 $UserQuery->execute();
	 $count = $UserQuery->rowCount();
	if ( $count > 0 ) {
		$result = $UserQuery->fetch(PDO::FETCH_ASSOC);
		$_SESSION['result'] = [
		    "id" => $result['id'],
		    "name" => $result['username'],
		];


	    $response = [ 
	     	"status" => true,
	        // "id" => $result['id'],
	        // "username" => $result['username']
	    ];
	     echo json_encode($response);
	     die();
	} else {
	    $response = [
	        "status" => false,
	        "message" => 'Wrong Username or Password',
	    ];

	    echo json_encode($response);
	    die();
	}

	// echo 'rtt' ;
	// session_start();
	// require_once 'connect.php';

		// if ($login == 'admin' && $password == '123' ) {
		// 	    $response = [
		// 	        "status" => true
		// 	    ];
		// 	    echo json_encode($response);
		// 	    die();
		// }
		
		// mysqli_num_rows($check_user)
		// this fun for 
	    // $result = $_SESSION['$result'] = [
	    //     "id" => $result['id'],
	    //     "username" => $result['username'],
	    // ];
		// print_r($result);
		// print("\n");

	 // // iterate over array by index and by name
	 // foreach($rows as $row) {

	 //     printf("$row[0] $row[1] $row[2]\n");
	 //     printf("$row['id'] $row['name'] $row['population']\n");

	 // }

	// $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
	// if (mysqli_num_rows($check_user) > 0) {

	//     $user = mysqli_fetch_assoc($check_user);

	//     $_SESSION['user'] = [
	//         "id" => $user['id'],
	//         "full_name" => $user['full_name'],
	//         "avatar" => $user['avatar'],
	//         "email" => $user['email']
	//     ];

	//     $response = [
	//         "status" => true
	//     ];

	//     echo json_encode($response);

	// } else {

	//     $response = [
	//         "status" => false,
	//         "message" => 'Не верный логин или пароль'
	//     ];

	//     echo json_encode($response);
	// }

	// $conn=null;
    // By this way you can close connection in PDO.

