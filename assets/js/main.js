$(document).ready(function() {
    let fileToUpload = [];
    let files = [];

    $('input[name="fileToUpload[]"]').change(function(e) {
        fileToUpload = e.target.files;
        $.each(fileToUpload, function(){
          files.push(this);
        });
    });

    $("#sort").on('change', function(e){
        e.preventDefault();

        let data = {};
        let selectedCountry = $('#sort option:selected').val();
        data = {
            'selectedCountry': selectedCountry
        };


       $.ajax({
           url: 'functions/filter.php',
           type: 'POST',
           dataType: 'json',         
           data: data,
           success: function(response){
                $('.feedback').html(response);

 
          },
   
          error: function(xhr, status, error) {
            var err = eval("(" + xhr.response + ")");
            console.log(xhr);
          }

       });
    });

$( "#Preview" ).on( "click", function(e){
    e.preventDefault();
    let authorfeed = $('input[name="authorfeed"]').val(),
        email = $('input[name="email"]').val(),
        feedtext = $('textarea[name="feedtext"]').val();
    let formData = new FormData();

    formData.append('authorfeed', authorfeed);
    formData.append('email', email);
    formData.append('feedtext', feedtext);
    for (var x = 0; x < files.length; x++) {
        formData.append("fileToUpload[]", files[x]);
    }

    $.ajax({
        url: 'functions/Preview.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success(responce) {

            if (responce.status) {
              console.log(responce);
              console.log(responce.rel);
             // .removeClass('none')
                $('.msg').text(responce.message);
                $('li.Preview').html(responce.rel);
    



            }    

        }
    }); 
});
$(document).on('submit', 'form#FeedbackForm', function(e){
    e.preventDefault();

    let authorfeed = $('input[name="authorfeed"]').val(),
        email = $('input[name="email"]').val(),
        feedtext = $('textarea[name="feedtext"]').val();
    let formData = new FormData();

    formData.append('authorfeed', authorfeed);
    formData.append('email', email);
    formData.append('feedtext', feedtext);

    for (var x = 0; x < files.length; x++) {
        formData.append("fileToUpload[]", files[x]);
    }

    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success(responce) {
          if (responce.status) {      
            $('input').val('');
            $('textarea[name="feedtext"]').val('');
            $('.msg').text(responce.message);
          }    

        }
    });    

    });

 $(document).on( "click","#update-status",  function(e){
      e.preventDefault();
      let ID = $(this).attr("feedid"),
      status = $(this).attr("status"),select = $(this);
      let UpdateStatus = {
        ID: ID,
        status:status
      };
      $.ajax({
        url: '/feedback/functions/admin-update.php',
        type: 'POST',
        dataType: 'json',
        data: UpdateStatus,
        success(responce) {         
            if (responce.status) {
             let val = responce.message;            
             select.text(val);
             select.attr( "status" , val );
            }   
        }
    });
});

$(document).on( "click","#update-feedback",  function(e){
  e.preventDefault();
  let ID = $(this).attr("feedid"),
      // parent = $(this).parent(),
      name = $(this).parents('.comment').find('#name h2 span').text(),
      text = $(this).parents('.comment').find('#text').text(),
      email = $(this).parents('.comment').find('#email').text();

  $('#update-feedback-form #ID').text(ID);
  $('#update-feedback-form #feedtext').val(text);
  $('#update-feedback-form #email').val(email);
  $('#update-feedback-form #name').val(name);
  $('html,body').animate({
      scrollTop: $("#update-feedback-form").offset().top},
      2000);
});

$(document).on('submit', '#update-feedback-form', function(e){
      e.preventDefault();
      let ID = $('#update-feedback-form #ID').text(),
          authorfeed = $('input[name="authorfeed"]').val(),
          email = $('input[name="email"]').val(),
          feedtext = $('textarea[name="feedtext"]').val();
          console.log(ID);
      let formData = new FormData();
      formData.append('authorfeed', authorfeed);
      formData.append('email', email);
      formData.append('feedtext', feedtext);
      formData.append('ID', ID);


      $.ajax({
        url: '/feedback/functions/update-feedback.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success(responce) {         
            if (responce.status) {
 
                 $('input').val('');
              $('textarea[name="feedtext"]').val('');

            }   
        }
    });
  });



});
