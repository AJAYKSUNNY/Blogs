<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link href="css/style.css" rel="stylesheet" type="text/css" > -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<style>
    *,
*::before,
*::after {
  box-sizing: border-box;
}
html,
body {
  height: 100%;
  font-family: Open Sans;
}
body {
  background: hsl(86, 85%, 95%);
  background-image: linear-gradient(to right top, #f9f9f3, #e7f3b9, #c5f083, #90ed51, #16eb12);
}

/*--------------------
Form
--------------------*/

label{

    font-family:Arial;
    font-size:100%;
}
/*--------------------
Signup
--------------------*/
.signup {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 1;
  width: 800px;
  background: hsl(0, 0, 100);
  border-radius: 10px;
  box-shadow: 0 3px 25px hsla(0, 0, 0, 0.2);
  overflow: hidden;
  display: flex;
}

.signup-connect{
  width: 50%;
  height : 500px;
  margin-top:7%;
  border-radius: 14% 0% 0% 14%;
  padding: 300px 50px;
  background: linear-gradient(134deg, hsl(44, 96%, 65%), hsl(34, 95%, 45%));
  color: hsl(0, 0, 100);
  background-image: url("https://www.setaswall.com/wp-content/uploads/2017/10/Ipad-Apple-Iphone-Ipod-Android-380x676.jpg");
}
.signup-classic
{
  width: 70%;
  height : 700px;
  padding: 30px 50px;
  border-radius: 10% 10% 10% 10%;
  background-color : white;
  /* background-image: linear-gradient(to right top, #f9f9f3, #e7f3b9, #c5f083, #90ed51, #16eb12); */
  /* background-image: linear-gradient(to right top, #f9f9f3, #b6b8af, #767b71, #3b4338, #011201); */
}


.btn{

    margin-left : 24%;
    height:50px;
    width : 50%;
    justify-content: center;
}
</style>
<body>
<section class="contact-from pt-4">
<div class="container">       
    <div class="signup">
        <div class="signup-connect">
        </div>
        <div class="signup-classic">
        <h2 class="text-center mt-md-3"><b> Let's get started</b> </h2>
        <div class="justify-content-center text-danger api_response_error">  </div>
        <div class="justify-content-center text-success"> </div>
        <hr>
            <form class="needs-validation" method="POST" enctype="multipart/form-data" id="register_form"  novalidate>
            {{ csrf_field() }}
            <div class="form-group">
                <label  class="form-label">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name"  placeholder="Enter first name" onkeyup="removeError(this)">
                <div class="first_name text-danger"></div>
            </div>
            <div class="form-group">
                <label  class="form-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name"  placeholder="Enter last name" onkeyup="removeError(this)" >
                <div class="last_name text-danger"></div>
            </div>
            <div class="form-group">
                <label  class="form-label">Email </label>
                <input type="email" class="form-control" name="email" id="email"  placeholder="Enter email" onkeyup="removeError(this)">
                <div class="email text-danger"></div>
            </div>
            <div class="form-group">
                <label  class="form-label">Mobile</label>
                <input type="tel" maxlength="10"  class="form-control" name="mobile" id="mobile"  placeholder="Enter mobile" onkeyup="removeError(this)">
                <div class="mobile text-danger"></div>
            </div>
            <div> 
                <label class="form-label"></label>
            </div>
            <div class="mt-md-3">
                <button type="submit sign_up" class="sign_up btn btn-primary">SIGN UP</button>
            </div>
            </form>
            <div class="mt-md-2 text-center">
                <span>Already a User? <a href= "/login">Login here</a></span>
            </div>
        </div>
    </div>
  </div>
  </section>
</body>
</html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script>

$( 'form' ).submit( function( event ) {

    
    event.preventDefault();
    var formData =  new FormData($('form')[0]);
     
    first_name  = $('#first_name').val();
    last_name   = $('#last_name').val();
    email       = $('#email').val();
    mobile      = $('#mobile').val();

    if(first_name == ''){

        generateErrorToastr('Please enter First name','first_name');
        return false;
    }
    if(last_name == ''){

        generateErrorToastr('Please enter Last name','last_name');
        return false;
    }
    if(email == ''){

        generateErrorToastr('Please enter Email','email');
        return false;
    }
    if(mobile == ''){

        generateErrorToastr('Please enter Mobile','mobile');
        return false;
    }

    $('.sign_up').html("<img src='https://i.gifer.com/ZZ5H.gif' style='height:20px;width:20px;' />");

    $.ajax({  
        url         : "/api/register", 
        type        : "POST",
        data        : {
            "_token": "{{ csrf_token() }}",
            'first_name'    : first_name,
            'last_name'     : last_name,
            'email'         : email,
            'username'      : mobile,
            'password'      : null
        },
        success: function(datas) 
        { 
          document.getElementById("register_form").reset();
          if (datas.status == 200){
            
            $('.sign_up').html("SIGN UP");
            $('.text-success').html("Email send to set password");
          }
          else{

            $('.sign_up').html("SIGN UP");
            $('.api_response_error').html("Email verification failed");
          }
        },
        error: function (request, status, error) {
         document.getElementById("register_form").reset();
         $('.sign_up').html("SIGN UP");
         $('.api_response_error').html("Email verification failed");
       }
    });
    
});

function generateErrorToastr(message,field){

    if(!$("#"+field).hasClass('is-invalid')){
        $("."+field).append(message);
        $("#"+field).addClass('is-invalid'); 
    }
}

function removeError(element){

    if($('#'+element.id).hasClass('is-invalid')){

        $("."+element.id).empty();
        $("#"+element.id).removeClass('is-invalid');
        $("#"+element.id).addClass('is-valid');
    }
}

$('#email').blur(function(){

    if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test($('#email').val()))
    {
        return (true)
    }
    else{
        
        $(".email").append("Email correct email");
        $("#email").addClass('is-invalid');
        $("#email").val(' ');
    }

});

$('#mobile').blur(function(){

    if (/^[1-9]{1}[0-9]{9}$/.test($('#mobile').val()))
    {
        return (true)
    }
    else{
        
        $(".mobile").append("Enter correct mobile");
        $("#mobile").addClass('is-invalid');
        $("#mobile").val(' ');
    }

});


</script>