<!DOCTYPE html>
<html>
    <head>
        <title>Contact Form - liquidfish</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Required Bootstrap/CSS files -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href='{{ asset('css/custom.css') }}' rel='stylesheet' />
        <!-- Required JS files -->
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <div class='container-fluid container-web'>
            
            <!-- Success Message content Start -->
            <div class='content-hidden'>
                <div class="container success-msg-container">
                    <div class="row-img">
                        <div class="col-sm col-img">
                            <img src='{{ asset('images/mail-icon.svg') }}' class='success-img'/>
                        </div>
                        <div class='text-container'>
                            <h4>Thank you for getting in touch!</h4>
                            <h6>we will get back to you soon!</h6>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Success Message content End -->

            <!-- Contact Form Start -->
            <form>
                <!-- Title -->
                <h3 class='content-title'>How can we help you?</h3>

                <!-- 1st Row Start (Name, Email fields) -->
                <div class="row">
                    <div class="col-md-6" id='name-container'>
                        <div class='label-container'>
                            <label for='name' id='label-name'>name</label>
                        </div>
                        <input type="text" name='name' class="form-control">
                    </div>
                    <div class="col-md-6" id='email-container'>
                        <div class='label-container'>
                            <label for='email' id='label-email'>email</label>
                        </div>
                        <input type="text" name='email' class="form-control">
                    </div>
                </div>
                <!-- 1st Row End -->

                <!-- 2nd Row Start (Company, Phone Number fields) -->
                <div class="row">
                    <div class="col-md-6" id='company-container'>
                        <div class='label-container'>
                            <label for='company' id='label-company'>company</label>
                        </div>
                        <input type="text" name='company' class="form-control">
                    </div>
                    <div class="col-md-6" id='phone-container'>
                        <div class='label-container'>
                            <label for='phone' id='label-phone'>phone number</label>
                        </div>
                        <input type="text" name='phone' class="form-control">
                    </div>
                </div>
                <!-- 2nd Row End -->

                <!-- 3rd Row Start (Subject field) -->
                <div class="row">
                    <div class="col-md-12" id='subject-container'>
                        <div class='label-container'>
                            <label for='subject' id='label-subject'>subject</label>
                        </div>
                        <input type="text" name='subject' class="form-control">
                    </div>
                </div>
                <!-- 3rd Row End -->

                <!-- 4th Row Start (Message field) -->
                <div class="row">
                    <div class="col-md-12" id='message-container'>
                        <div class='label-container'>
                            <label for='message' id='label-message'>message</label>
                        </div>
                        <textarea rows='5' name='message' class="form-control"></textarea>
                    </div>
                </div>
                <!-- 4th Row End -->

                <!-- Submit button group Start -->
                <div class="input-group input-group-lg">
                    <div class='col'></div>
                    <div class="input-group-append">
                        <button class="btn btn-danger btn-lg btn-block" type="button">SEND</button>
                    </div>
                </div>
                <!-- Submit button group End -->
            </form>
            <!-- Contact Form End -->
        </div>

        <!-- Jquery Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   
    </body>
    <script type='text/javascript'>

        // Execute jquery code upon submit button click
        $('button').click(function(e){
            e.preventDefault();
            
            // Set the x-csrf-token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Ajax request
            $.ajax({
                url: "{{ url('/contact/post') }}",
                type: 'post',
                data: { 
                    name: $('input[name=name]').val(),
                    company: $('input[name=company]').val(),
                    email: $('input[name=email]').val(),
                    phone: $('input[name=phone]').val(),
                    subject: $('input[name=subject]').val(),
                    message: $('textarea').val()
                    },
                success: function(data){
                    // Log success message in console
                    console.log(data);     
                    
                    
                    if(data.errors){
                            
                        // If error exists, mark input field with red border bottom, give label an exclamation mark and change input text color to red
                        // Validation Start
                        if(data.errors.indexOf('name') >= 0){
                            $('#name-container').css({'border-bottom-color':'red' });
                            $('#label-name').text('name ❗');
                        } else {
                            $('#name-container').css({'border-color':'#D3D3D3'});
                            $('#label-name').text('name');
                        }
                        
                        if(data.errors.indexOf('email') >= 0){
                            $('#email-container').css({'border-bottom-color':'red' });
                            $('#label-email').text('email ❗');
                        }
                        else if(data.errors.indexOf('email-format') >= 0){
                            $('#email-container').css({'border-bottom-color':'red' });
                            $('input[name=email]').css({'color':'#DC3545' });
                            $('#label-email').text('email ❗');
                        }
                        else {
                            $('#email-container').css({'border-color':'#D3D3D3'});
                            $('input[name=email]').css({'color':'#495057' });
                            $('#label-email').text('email');
                        }

                        if(data.errors.indexOf('company') >= 0){
                            $('#company-container').css({'border-bottom-color':'red' });
                            $('#label-company').text('company ❗');
                        } else {
                            $('#company-container').css({'border-color':'#D3D3D3'});
                            $('#label-company').text('company');
                        }

                        if(data.errors.indexOf('phone') >= 0){
                            $('#phone-container').css({'border-bottom-color':'red' });
                            $('#label-phone').text('phone ❗');
                        } else if(data.errors.indexOf('phone-format') >= 0){
                            $('#phone-container').css({'border-bottom-color':'red' });
                            $('input[name=phone]').css({'color':'#DC3545' });
                            $('#label-phone').text('phone ❗');
                        } else {
                            $('#phone-container').css({'border-color':'#D3D3D3'});
                            $('#label-phone').text('phone');
                            $('input[name=phone]').css({'color':'#495057' });
                        }

                        if(data.errors.indexOf('subject') >= 0){
                            $('#subject-container').css({'border-bottom-color':'red' });
                            $('#label-subject').text('subject ❗');
                        } else {
                            $('#subject-container').css({'border-color':'#D3D3D3'});
                            $('#label-subject').text('subject');
                        }

                        if(data.errors.indexOf('message') >= 0){
                            $('#message-container').css({'border-bottom-color':'red' });
                            $('#label-message').text('message ❗');
                        } else {
                            $('#message-container').css({'border-color':'#D3D3D3'});
                            $('#label-message').text('message');
                        }
                        // Validation End

                    } else {
                        $('form').css({'display': 'none'});
                        $('.content-hidden').fadeIn(1000);
                    }
                    
                },
                error: function(eMsg){
                    // Log errors in console
                    console.log(eMsg)
                } 
            });
        });

    </script>