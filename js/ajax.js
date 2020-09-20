jQuery(document).ready(function($){
	/*$('#addressModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var id = button.data('id');
		var modal = $(this);
    });*/
    /*https://api.instagram.com/oembed/?url=http://instagr.am/p/B5S5tLUHR0V/*/

    $.ajax({
        type : "get",
        dataType : "json",
        url : "https://api.instagram.com/oembed/?url=http://instagr.am/p/B5S5tLUHR0V/",
        // data : {
        //     action: "check_password", 
        //     password_current : password_current,
        //     password_1 : password_1,
        //     password_2 : password_2,
        // },
        // beforeSend: function() {                
        //     $('.mos-change-password-form').after('<div class="post-loader"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
        //     $(this).prop('disabled', true);
        // },
        // success: function(response) {
        //     console.log(response);            
        // },
    });    
    $('#change_account_password').click(function(){
        var password_current = $('#password_current').val();
        var password_1 = $('#password_1').val();
        var password_2 = $('#password_2').val();
        $.ajax({
            type : "post",
            dataType : "json",
            url : ajax_obj.ajax_url,
            data : {
                action: "check_password", 
                password_current : password_current,
                password_1 : password_1,
                password_2 : password_2,
            },
            // beforeSend: function() {                
            //     $('.mos-change-password-form').after('<div class="post-loader"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
            //     $(this).prop('disabled', true);
            // },
            success: function(response) {
                // console.log(response);
                if(response.type == 'success'){                    
                    $('#password_current').val('');
                    $('#password_1').val('');
                    $('#password_2').val('');
                }
                $('.alert').remove();
                $('.mos-change-password-form').before('<div class="alert alert-'+response.type+' alert-dismissible fade show" role="alert">'+response.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            },
        });

    });
    $('.edit-modal').click(function(){
        // if (id != 'new'){
        id = $(this).data('id');
        $.ajax({
            type : "post",
            dataType : "json",
            url : ajax_obj.ajax_url,
            data : {
                action: "load_address", 
                id : id,
            },
            // beforeSend: function() {},
            success: function(response) {
                console.log(response);
                // Add response in Modal body
                if (response) {
                    $('#addressModal .modal-body').find('#first_name').val(response.first_name);
                    $('#addressModal .modal-body').find('#last_name').val(response.last_name);
                    $('#addressModal .modal-body').find('#phone').val(response.phone);
                    $('#addressModal .modal-body').find('#fax').val(response.fax);
                    $('#addressModal .modal-body').find('#address').val(response.address);
                    $('#addressModal .modal-body').find('#district').val(response.district);
                    $('#addressModal .modal-body').find('#post').val(response.post);
                    $('#addressModal .modal-body').find('#id').val(response.id);
                    $('#addressModal .modal-body').find('#type').val(response.type);
                    $('#addressModal .modal-body').find('#submit').val('update').html('Update');
                } else {
                    $('#addressModal .modal-body').find('#first_name').val('');
                    $('#addressModal .modal-body').find('#last_name').val('');
                    $('#addressModal .modal-body').find('#phone').val('');
                    $('#addressModal .modal-body').find('#fax').val('');
                    $('#addressModal .modal-body').find('#address').val('');
                    $('#addressModal .modal-body').find('#district').val('');
                    $('#addressModal .modal-body').find('#post').val('');
                    $('#addressModal .modal-body').find('#id').val('new');
                    $('#addressModal .modal-body').find('#type').val('other');
                    $('#addressModal .modal-body').find('#submit').val('create').html('Create');
                }
                // Display Modal
                $('#addressModal').modal('show');
                // modal.find('.modal-body input').val(id);
            },
        });            
		// }
	});


    $('.load-event').click(function(){
        var loadedpost = $('#loadedpost').val();
        // alert(ajax_obj.ajax_url);
        $.ajax({
            type : "post",
            dataType : "json",
            url : ajax_obj.ajax_url,
            data : {
            	action: "load_events", 
            	loadedpost : loadedpost,
            },
		    beforeSend: function() {
		        $('.row.event-posts').after('<div class="post-loader"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
		        $('.load-event').prop('disabled', true);
		    },
            success: function(response) {
            	console.log(response);
            	$('.post-loader').remove();
            	$('.load-event').prop('disabled', false);
            	$('#loadedpost').val(response.count);
            	if (response.all_loaded) $('.load-event').remove();
            	$('.row.event-posts').html(response.html);
            }
        });
    });	
    $('.load-posts').click(function(){
        var post_type = $('#post_type').val();
        var post_loaded = $('#post_loaded').val();
        // alert(ajax_obj.ajax_url);
        $.ajax({
            type : "post",
            dataType : "json",
            url : ajax_obj.ajax_url,
            data : {
            	action: "load_posts", 
            	post_type : post_type,
            	post_loaded : post_loaded,
            },
		    beforeSend: function() {
		        $('#blogs').after('<div class="post-loader"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
		        $('.load-posts').prop('disabled', true);
		    },
            success: function(response) {
            	console.log(response);
            	$('.post-loader').remove();
            	$('.load-posts').prop('disabled', false);
            	$('#post_loaded').val(response.count);
            	if (response.all_loaded) $('.load-posts').remove();
            	$('#blogs').html(response.html);
            }
        });
    }); 

    $("#wp-reg-submit").click(function(){
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var conpassword = $('#conpassword').val();
        var tc_accepted = $('#tc_accepted:checked').val();
        console.log(tc_accepted);
        $('.login-error').remove();
        $('.form-group').removeClass('has-error');
        var error = 0;
        if (first_name) {
            var result = /^[a-zA-Z ._]+$/.test( first_name);
            if(!result){
                $('#first_name').closest('.form-group').addClass('has-error');
                $('#first_name').closest('.form-group').append('<div class="login-error">First name can contain only Alphabets and periods.</div>'); 
                error++;
            }           
        }
        else {
            $('#first_name').closest('.form-group').addClass('has-error');
            $('#first_name').closest('.form-group').append('<div class="login-error">First name is required.</div>'); 
            error++;
        }
        if (last_name) {
            var result = /^[a-zA-Z ._]+$/.test( last_name);
            if(!result){
                $('#last_name').closest('.form-group').addClass('has-error');
                $('#last_name').closest('.form-group').append('<div class="login-error">Last name can contain only Alphabets and periods.</div>'); 
                error++;
            }           
        }
        if (!phone) {
            $('#phone').closest('.form-group').addClass('has-error');
            $('#phone').closest('.form-group').append('<div class="login-error">Phone is required.</div>'); 
            error++;           
        }
        if (email) {
            var result = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/.test( email);
            if(!result){
                $('#email').closest('.form-group').addClass('has-error');
                $('#email').closest('.form-group').append('<div class="login-error">Invalid Email Format.</div>'); 
                error++;
            }           
        }
        else {
            $('#email').closest('.form-group').addClass('has-error');
            $('#email').closest('.form-group').append('<div class="login-error">Email is required.</div>'); 
            error++;
        }
        if (!password) {
            $('#password').closest('.form-group').addClass('has-error');
            $('#password').closest('.form-group').append('<div class="login-error">Password is required.</div>');  
            error++;          
        }
        else if (password != conpassword) {
            $('#conpassword').closest('.form-group').addClass('has-error');
            $('#conpassword').closest('.form-group').append('<div class="login-error">Those passwords didn\'t match. Try again.</div>');
            error++;
        }
        if (!tc_accepted) {
            $('#tc_accepted').closest('.form-group').addClass('has-error');
            $('#tc_accepted').closest('.form-group').append('<div class="login-error">This field is required.</div>');  
            error++;          
        }
        if (!error){
        	var form = $('#registerform');
        	var login = $('.mos-auth-link').attr('href');
		    $.ajax({
		    	type: "POST",
	            dataType : "json",
	            url : ajax_obj.ajax_url,
				data: {				
	            	action: "register_check",
					// form : form.serialize(), // serializes the form's elements.
	                user_login: phone,
	                user_email: email,
	                user_pass: password,
	                first_name: first_name,
	                last_name: last_name,
				},
	            beforeSend: function() {
	                $(".auth-form-wrapper").prepend('<div class="position-absolute d-flex justify-content-center align-items-center l15 r15 h-100 t0 l0 bg-black-50 zi9 auth-loader"><div class="spinner-border text-white" role="status"></div></div>');
	            },
				success: function(data) {
	                console.log(data); // show response from the php script.
	                if (data.error){
	                    $('.auth-loader').remove();
	                	$('.login-error').remove();
	                	if (data.error.phone){
		                	$('#phone').closest('.form-group').addClass('has-error');
		                	$('#phone').closest('.form-group').append('<div class="login-error">'+data.error.phone+'</div>');
		                } else {
		                	$('#email').closest('.form-group').addClass('has-error');
		                	$('#email').closest('.form-group').append('<div class="login-error">'+data.error.email+'</div>');
		                }
	                } else {
	                	window.location.href = login;
	                }
				}
		    });        	
        }
    });	

    $(".load-more-product").click(function(){
        var ths = $(this);
        ths.prop('disabled',true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
        // var offset = $(this).data('offset');
        var offset = $('.offset').val();
        var load = $(this).data('load');
        // console.log(offset);
        // console.log(load);
        $.ajax({
            type: "POST",
            dataType : "json",
            url : ajax_obj.ajax_url,
            data: {             
                action: "load_more_product",
                // form : form.serialize(), // serializes the form's elements.
                offset: offset,
                load: load,
            },
            success: function(data) {
                console.log(data); // show response from the php script.
                ths.closest('.products-container').find('.product-row').append(data.html);
                ths.prop('disabled',false).html('Load More');                
                $newOffset = parseInt(offset) + parseInt(load);
                ths.attr('data-offset', data.offset);
                ths.siblings('.offset').val(data.offset);
            }
        });
    });

    $("#wp-submit").click(function(){
	    // e.preventDefault(); // avoid to execute the actual submit of the form.
        var user_login = $('#user_login').val();
        var user_pass = $('#user_pass').val();
        var rememberme = $('#rememberme').val();

	    var form = $('#mos-loginform');
	    var url = form.attr('action');
	    // console.log(url);
	    $.ajax({
	    	type: "POST",
            dataType : "json",
            url : ajax_obj.ajax_url,
			data: {				
            	action: "login_check",
				// form : form.serialize(), // serializes the form's elements.
                user_login: user_login,
                user_pass: user_pass,
                url: url,
                rememberme: rememberme,
			},
            beforeSend: function() {
                $(".auth-form-wrapper").prepend('<div class="position-absolute d-flex justify-content-center align-items-center l15 r15 h-100 t0 l0 bg-black-50 zi9 auth-loader"><div class="spinner-border text-white" role="status"></div></div>');
            },
			success: function(data) {
                console.log(data); // show response from the php script.
                if (data.error){
                    $('.auth-loader').remove();
                	$('.login-error').remove();
                	$('#user_login').closest('.form-group').addClass('has-error');
                	$('#user_login').closest('.form-group').append('<div class="login-error">'+data.error+'</div>');
                } else {
                	// form.submit();
                    $.ajax({
                        type: "POST",
                        dataType : "json",
                        url : ajax_obj.ajax_url,
                        data: {             
                            action: "login_done",
                            // form : form.serialize(), // serializes the form's elements.
                            user_login: user_login,
                            user_pass: user_pass,
                            rememberme: rememberme,
                        },
                        success: function(data){
                            console.log(data);
                            if (data.loggedin == true){
                                document.location.href = data.url;
                            }
                        }

                    });
                }
			}
	    });
	});
});