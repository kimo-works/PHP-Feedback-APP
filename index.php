<?php include_once('header.php'); ?>
	<section class="container">
		<?php include_once('inc/filter-form.php'); ?>
		<?php include_once('functions/feedbacks-list.php'); ?>
		<form id="FeedbackForm" action="" enctype="multipart/form-data">
			<label for="name" class="form_inputs form_name">			 
			   <input type="text" class="form-control" id="name" name="authorfeed" placeholder="Your name" required><!-- required -->
			</label>

			<label for="email" class="form_inputs form_email">
			   <input type="email" class="form-control" id="email" name="email" placeholder="Your email" required>  
			</label>

			<div class="form_inputs form_files">
				<label for="fileToUpload"><span>Choose file to upload :</span>
					<input type="file" id="fileToUpload" name="fileToUpload[]" multiple>
				</label>	
			</div>

			<label for="feedback" class="form_inputs form_feedback">
			   	<textarea class="form-control" type="textarea" name="feedtext" id="feedtext" placeholder="Your feedback" maxlength="6000" rows="7" required></textarea>
			</label>    
			<div class="msg__c"><span class="msg"></span></div>
           <button type="submit"  class="btn btn-lg btn-warning btn-block button send-btn" ><span>Submit</span></button>
           <button id="Preview"><span>Preview</span></button>		
	    </form>
	</section>
	
<?php include_once('footer.php'); ?>