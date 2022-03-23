<?php
	session_start();
	if (!$_SESSION['result']) {
	    header('Location: /feedback/');
	}
	elseif ($_SESSION['result']) {
		include_once('header.php'); 
		include_once('db.php');
		
		$query =  $conn->prepare("SELECT * FROM `feedbacks` ORDER BY `date` DESC "); // WHERE `status` LIKE 'published' 
		$query->execute();
		$feedbacks = $query->fetchAll( PDO::FETCH_ASSOC );	
?>
<div class="title_page">
	<h1>This is admin panel</h1>
</div>
<div class="admin-panel">
	<ul class="feedback">
		<?php if ( $feedbacks ): ?>		
			<?php foreach ( $feedbacks as $feedback ): ?>
				<li class="comment">
					<div class="ID"><h3>ID : <?php print_r($feedback['ID']); ?></h3></div>
					<div class="name" id="name"> <h2>Name :<span><?php print_r($feedback['name']); ?></span></h2></div>
					<div>email : <p id="email"><?php print_r($feedback['email']); ?></p></div>	
					<div class="comment_text">
						<p id="text"><?php print_r($feedback['text']);  ?></p>
					</div>
					<div class="comment_imgs">
						<?php 
							$Files = array();
							$Files = unserialize($feedback['files']);
							$FilesLength = count($Files);
							if ( $FilesLength > 1 ) {
								for ($i=0; $i < $FilesLength; $i++) { 
									$img = '<img src="/feedback/'.$Files[$i] .'">';
									print_r($img);
								}							
							} else {
								$img = '<img src="/feedback/'.$Files[0] .'">';
								print_r($img);
							}							
						?>
					</div>
					<div style="display: flex; justify-content: space-around;">
						<?php 
							if ($feedback['status'] == 'unpublished' ) {
								$link = '<button id="update-status" feedid="'.$feedback['ID'].'" status="Published">Published</button>';
								print_r($link);
							}
							else {
								$link = '<button id="update-status" feedid="'.$feedback['ID'].'" status="unpublished">Unpublished</button>';
								print_r($link);

							}
						?>
						<?php 
							$link = '<button id="update-feedback" feedid="'.$feedback['ID'].'" >update feedback</button>';
							print_r($link);
						?>

						

					</div>	
						
				</li>					
			<?php endforeach; ?>
			

		<?php endif; ?>	
	</ul>
</div>
	<section class="container">
		<div class="title_form">
			<h2>Update Field</h2>
		</div>
		<form id="update-feedback-form" action="" enctype="multipart/form-data">
			<label id="ID"><h1></h1></label>
			<label for="name" class="form_inputs form_name">			 
			   <input type="text" class="form-control" id="name" name="authorfeed" placeholder="Your name" required><!-- required -->
			</label>

			<label for="email" class="form_inputs form_email">
			   <input type="email" class="form-control" id="email" name="email" placeholder="Your email" required>  
			</label>

			<label for="feedback" class="form_inputs form_feedback">
			   	<textarea class="form-control" type="textarea" name="feedtext" id="feedtext" placeholder="Your feedback" maxlength="6000" rows="7" required></textarea>
			</label>    

           <button type="submit"  class="btn btn-lg btn-warning btn-block button send-btn" ><span>Submit</span></button>	
	    </form>
	</section>




<?php 

}
include_once('footer.php'); 
