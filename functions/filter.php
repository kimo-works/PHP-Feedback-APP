<?php 
$sort_by = $_POST["selectedCountry"];
include_once('../db.php');
// $query =  $conn->query("SELECT * FROM `feedbacks` order by  (``) VALUES ('$sort_by')");
// if (condition) {	
	$query =  $conn->query("SELECT * FROM feedbacks WHERE `status` LIKE 'published' ORDER BY " . $sort_by . " DESC ");
	 ///"ASC","DESC"]
// }
$query->execute();
$sort_by = $query->fetchAll( PDO::FETCH_ASSOC );	// var_dump($result);
?>
<?php if ( $sort_by ): ?>
	<?php $response = '';		
	foreach ( $sort_by as $feedback ){ 
	 	$response .= "<li class='comment'>";
		$response .= 	"<div class='name'><h3>Name : $feedback[name]</h3></div>";
		$response .= 	"<div>email : $feedback[email]</div>";	
		$response .= 	"<div class='comment_text'>";
		$response .= 		"<p>$feedback[text]</p>";
		$response .= 	"</div>";
		$response .= 	"<div class='comment_imgs'>";
						$Files = unserialize($feedback['files']);
						$FilesLength = count($Files);
						if ( $FilesLength > 1 ) {
							for ($i=0; $i < $FilesLength; $i++) { 
								$response .= '<img src="/feedback/'.$Files[$i] .'">';						
							}							
						} else {
							$response .= '<img src="/feedback/'.$Files[0] .'">';						
						}
		$response .="</div>";
		$response .= "</li>";
	} ?>
<?php endif; ?>
<?php echo json_encode($response); ?>