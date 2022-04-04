<?php 
var_dump($_POST);
    include_once('../db.php');
  $authorfeed = ( isset( $_POST['authorfeed'] ) ) ? $_POST['authorfeed'] : '';
  $email = ( isset( $_POST['email'] ) ) ? $_POST['email'] : '';
  $feedtext = ( isset( $_POST['feedtext'] ) ) ? $_POST['feedtext'] : '';
  $ID =  ( isset( $_POST['ID'] ) ) ? $_POST['ID'] : '';
  // var_dump(  $feedtext);
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
    }
    elseif ( empty($error_fields) ) {         

    
            $sql = "UPDATE `feedbacks` SET 
                   `name` = '$authorfeed', 
                   `email` = '$email', 
                   `text` = '$feedtext',                
                   `date` = '$date'
                    where `ID` = '$ID'";
          
            $query = $conn->query($sql);
            $query = $query->execute();

          
            if ($query) {                       
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
       
 