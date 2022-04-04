<?php
  include_once('../db.php');
    $authorfeed = ( isset( $_POST['authorfeed'] ) ) ? $_POST['authorfeed'] : '';
    $email = ( isset( $_POST['email'] ) ) ? $_POST['email'] : '';
    $feedtext = ( isset( $_POST['feedtext'] ) ) ? $_POST['feedtext'] : '';
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
    } elseif ( empty($error_fields) ) {     
      include_once('upload-file.php');
      $FileNames = serialize($FileNames);

      $SqlQuery = "INSERT INTO `feedbacks` (`name`, `email`, `text`, `files`, `date`, `status`) VALUES (?,?,?,?,?,'Preview')";
      $FeedbackQuery = $conn->prepare($SqlQuery)->execute([$authorfeed,$email,$feedtext,$FileNames,$date]);
      

      $rel = '<li class="comment">
                <div class="name"><h3>Name : '.$authorfeed.'</h3></div>
                <div>email : '.$email.'</div>    
                <div class="comment_text">
                    <p>'.$feedtext.'</p>
                </div>
                <div class="comment_imgs">';
 
                        $Files = array();
                        $Files = unserialize($FileNames);
                        $FilesLength = count($Files);
                        if ( $FilesLength > 1 ) {
                            for ($i=0; $i < $FilesLength; $i++) { 
                                $rel .= '<img src="http://127.0.0.1/feedback/functions/'.$Files[$i] .'">';
                                
                            }                           
                        } else {
                            $rel .= '<img src="http://127.0.0.1/feedback/functions/'.$Files[0] .'">';
                            
                        }
                        
                   

            $rel .= '</div></li>';



      if ($FeedbackQuery) {           
        $response = [
            "status" => true,
            "message" => "Your feedback is in Preview mode",
            "rel" => $rel,
          

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
