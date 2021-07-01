<!DOCTYPE html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<title>Simreka</title>
<link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-UFYrvXUptS2rhdmzjbRdUJX8sVoECO55sw&usqp=CAU" sizes="16x16" type="image/png">
<body class="body-class">
<section class="contact-from pt-4">
<div class="container">       
    <div class="setpassword justify-content-center">
        <div class="setpassword-classic">
        <h2 class="text-center mt-md-3"><b> Set Password</b> </h2>
        <hr>
            <form class="needs-validation" action="/api/register" novalidate>
              <div class="password_mismatch text-danger"></div>
            <div class="form-group">
                <label for="password" class="form-label"> Password</label>
                <input type="password" class="form-control" id="password" aria-describedby="emailHelp" placeholder="Enter Passsword" onkeyup="removeError(this)">
                <div class="password text-danger"></div>
            </div>
            <div class="form-group">
                <label for="confirm_password" class="form-label"> Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" onkeyup="removeError(this)">
                <div class="confirm_password text-danger"></div>
            </div>
            <div class="mt-md-5">
                <button type="submit sign_up" class="btn btn-primary">SUBMIT</button>
            </div>
            </form>
            <br>
        </div>
    </div>
  </div>
  </section>
</body>
</html>
<script>

$( 'form' ).submit( function( event ) {

    event.preventDefault();
     
    confirm_password  = $('#confirm_password').val();
    password          = $('#password').val();

    
    if(password == ''){

        generateErrorToastr('Please enter Password','password');
        return false;
    }
    if(confirm_password == ''){

        generateErrorToastr('Please confirm Password','confirm_password');
        return false;
    }

    if(password != confirm_password){

       generateErrorToastr('Password does not match','password_mismatch');
       return false;
    }

    $.ajax({  
        url     : "/api/setpassword", 
        type   : "POST", 
        data    : {
            "_token"  : "{{ csrf_token() }}",
            "password"  : password,
            "uniqid"    : "{!! $uniqid !!}"
        },
        success:function(data){

            var result = JSON.parse(data);
            if(result.status == 200){

                Swal.fire({
                  title: result.message,
                  icon : 'success',
                  confirmButtonText: 'OK',
                  preConfirm: (inputValue) => {
                    window.location.replace("http://127.0.0.1:8001/login");
                  }
                });
            }
            else{

                Swal.fire({
                  title: result.message,
                  icon : 'error',
                  confirmButtonText: 'OK',
                  preConfirm: (inputValue) => {
                    location.reload();
                  }
                });
            }
        }
    });

});

function generateErrorToastr(message,field){
 
    $("."+field).append(message);
    $("#"+field).addClass('is-invalid'); 
}

function removeError(element){

    if($('#'+element.id).hasClass('is-invalid')){

        $("."+element.id).remove();
        $("#"+element.id).removeClass('is-invalid');
        $("#"+element.id).addClass('is-valid');
    }
}

$('#password').blur(function(){

    if (/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/.test($('#password').val()))
    {
        return (true)
    }
    else{
        
        $(".password").append("should be eight character , at least 1 letter and 1 number and a character");
        $("#password").addClass('is-invalid');
        $("#password").val('');
    }

});

</script>