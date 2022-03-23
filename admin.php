<?php include_once('header.php'); ?>

	<section class="contener">
		<div class="title_page">
			<h2>Sign in</h2>
		</div>			
		<div class="contener_msg none">
			<p class="msg"></p>			
		</div>
		<form  role="form" method="post"  id="FeedbackForm">
			<div class="form_inputs form_name">			 
			   <input type="text" id="login" name="login" placeholder="User Name" required>
			</div>
			<div class="form_inputs form_email">
			   <input type="password" name="password"  id="password" placeholder="Your password" required>  
			</div>
           <button type="submit"  class="btn btn-lg btn-warning btn-block button send-btn" ><span>login</span></button>	
	    </form>
	</section>

	<script type="text/javascript">

		$('.send-btn').click(function (e) {
		    e.preventDefault();
		    $("input").removeClass('error');
		    let login = $('input[name="login"]').val(), password = $('input[name="password"]').val();
		    $.ajax({
		        url: 'functions/adminlogin.php',
		        type: 'POST',
		        dataType: 'json',
		        data: {
		            login: login , password: password
		        },
		        success (data) {

		            if (data.status) {
		                document.location.href = 'http://127.0.0.1/feedback/AdminPanel.php';
		            } else {

		            //     if (data.type === 1) {
		            //         data.fields.forEach(function (field) {
		            //             $(`input[name="${field}"]`).addClass('error');
		            //         });
		            //     }

		                $('.contener_msg').removeClass('none').text(data.message);
		            }

		        }
		    });

		});


	</script>
	
<?php include_once('footer.php'); ?>