<!DOCTYPE html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<title>Simreka</title>
<link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-UFYrvXUptS2rhdmzjbRdUJX8sVoECO55sw&usqp=CAU" sizes="16x16" type="image/png">
<body class="body-class">
<section class="contact-from pt-4">
<div class="container">       
    <div class="login justify-content-center">
        <div class="login-classic">
        <h2 class="text-center mt-md-3"><b> Login</b> </h2>
           <hr>
           @if(isset($message))
                <div class="justify-content-center text-danger">
                    {{ $message }}
                </div>
            @endif
            <form class="needs-validation" enctype="multipart/form-data" action="/user_login" method="POST" onsubmit="return validateFormOnSubmit(this)" novalidate>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" onkeyup="removeError(this)">
                <div class="email text-danger"></div>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" onkeyup="removeError(this)">
                <div class="password text-danger"></div>
            </div>
            <div class="mt-md-5">
                <button type="submit sign_up" class="btn btn-primary">LOG IN</button>
            </div>
            </form>
            <br>
            <div class="mt-md-1 text-center">
                <span>Not registered yet ? <a href= "/register">Register here</a></span>
            </div>
            <div class="mt-md-2 text-center">
                <span>Forgot Password ? <a href= "www.google.com">Reset here</a></span>
            </div>
        </div>
    </div>
  </div>
  </section>
</body>
</html>
<script>

function validateFormOnSubmit(event){

    email       =  $('#email').val();
    password    =  $('#password').val();

    if(email == ''){

        generateErrorToastr('Please enter Email','email');
        return false;
    }
    if(password == ''){

        generateErrorToastr('Please enter Password','password');
        return false;
    }

    return true;
}


function generateErrorToastr(message,field){
  
    if(!$("#"+field).hasClass('is-invalid')){
        $("."+field).append(message);
        $("#"+field).addClass('is-invalid'); 
    }
}


function removeError(element){

    if($('#'+element.id).hasClass('is-invalid')){
        $("."+element.id).remove();
        $("#"+element.id).removeClass('is-invalid');
        $("#"+element.id).addClass('is-valid');
    }
}


</script>