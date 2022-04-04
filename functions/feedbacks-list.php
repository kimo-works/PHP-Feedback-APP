<?php
	$query =  $conn->prepare("SELECT * FROM `feedbacks` WHERE `status` LIKE 'published' ORDER BY `date` DESC ");
	$query->execute();
	$feedbacks = $query->fetchAll( PDO::FETCH_ASSOC );	
?>
<ul class="feedback">
	<?php if ( $feedbacks ): ?>		
		<?php foreach ( $feedbacks as $feedback ): ?>
			<li class="comment">
				<div class="name"><h3>Name : <?php print_r($feedback['name']); ?></h3></div>
				<div>email : <?php print_r($feedback['email']); ?></div>	
				<div class="comment_text">
					<p><?php print_r($feedback['text']);  ?></p>
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
			</li>					
		<?php endforeach; ?>
		

	<?php endif; ?>	
	<li class="Preview"></li>
</ul>