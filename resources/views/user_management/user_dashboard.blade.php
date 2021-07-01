<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<link rel="stylesheet" href="css/style.css">


<title>Simreka</title>
<link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-UFYrvXUptS2rhdmzjbRdUJX8sVoECO55sw&usqp=CAU" sizes="16x16" type="image/png">
<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper">
  <nav class="navbar navbar-fixed-top" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">
        <img src="https://cdn.dribbble.com/users/1326178/screenshots/6050577/p.png?compress=1&resize=400x300" alt="LOGO">
      </a>
    </div>       
    <ul class="nav navbar-right top-nav" >          
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-2x fa-cog" style="color:blue;"></i>
        </a>
        <ul class="dropdown-menu">
          <li><a  onclick="clearStorge()"><i class="fa fa-lg fa-power-off"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-right user_name"><h4>{{$user->first_name}} {{$user->last_name}}</h4></ul> 
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav side-nav">
        <li class="nav-link nav-item active" data-toggle="tab" href="#dashboard" id="1" role="tab" > 
          <a data-toggle="tab"  role="tab" id="dashboard" href="#dashboard" onclick="getTab(this)">
            <span class="hidden-sm-up"><i class="fa fa-2x fa-tachometer"></i></span> 
            <span class="hidden-xs-down">&nbsp;&nbsp;Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-link" data-toggle="tab" href="#blogs" id="2" role="tab"> 
          <a data-toggle="tab" role="tab" id="blogs" href="#blogs" onclick="getTab(this)">
            <span class="hidden-sm-up"><i class="fa fa-2x fa-dashcube"></i></span> 
            <span class="hidden-xs-down">&nbsp;&nbsp;&nbsp;Blogs</span>
          </a> 
        </li>
      </ul>
    </div>
  </nav>

  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row" id="main" >
        <div class="tab-content">
         <div class="tab-pane active" id="dashboard" role="tabpanel">
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
              <div class="card row summary">
                <div class="col-md-1"></div>
                <div class="col-md-3">
                  <span class="hidden-sm-up"><i class="fa fa-3x fa-book card-icon" style="color: blue;"></i></span> 
                </div>
                <div class="col-md-7 text-right">
                 <div><h3 id='total_blogs'></h3></div>
                 <div class="row">Number of Blogs Written</div>
               </div>
             </div>
           </div>
           <div class="col-md-3">
            <div class="card row summary">
              <div class="col-md-1"></div>
              <div class="col-md-3">
                <span class="hidden-sm-up"><i class="fa fa-3x fa-check card-icon" style="color: green;"></i></span> 
              </div>
              <div class="col-md-7 text-right">
               <div><h3 id='total_verified'>7</h3></div>
               <div class="row">Number of Active Blogs</div>
             </div>
           </div>
         </div>
         <div class="col-md-3">
          <div class="card row summary">
            <div class="col-md-1"></div>
            <div class="col-md-3">
              <span class="hidden-sm-up"><i class="fa fa-3x fa-exclamation-circle card-icon" style="color: orange;"></i></span> 
            </div>
            <div class="col-md-7 text-right">
             <div><h3 id='total_verification_pending'></h3></div>
             <div class="row">Verification Pending</div>
           </div>
         </div>
       </div>

     </div>
     <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-9">
        <div class="card ">
          <div class="card-body" id="blog_chart">
          </div>
        </div>
      </div>
    </div>
  </div>




  <div class="tab-pane" id="blogs" role="tabpanel">
   <div class="row"> 
    <div id="page-wrapper">
      <div class="container-fluid">
        <ul class="nav nav-tabs" role="tablist" id="tabs">
          <li class="nav-link nav-item active" data-toggle="tab" href="#user_blogs"  role="tab"> 
            <a>
              <span class="hidden-sm-up"><i class="fa fa-2x fa-book"></i></span> 
              <span class="hidden-xs-down">Blogs</span>
            </a>
          </li>
          <li class="nav-item nav-link" data-toggle="tab" href="#create_blogs" role="tab"> 
            <a>
              <span class="hidden-sm-up"><i class="fa fa-2x fa-pencil-square"></i></span> 
              <span class="hidden-xs-down">Create New Blog</span>
            </a> 
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="user_blogs" role="tabpanel">

            <div class="row edit_blog">
              <div class="card col-md-1"></div>
              <div class="row">
                <div class="card col-md-8">
                  <div class="form-group">
                    <label  class="form-label">Heading</label>
                    <input type="text" class="form-control" name="edit_heading" id="edit_heading"  placeholder="Heading here ..." onkeyup="removeError(this)">
                    <div class="edit_heading text-danger" ></div>
                  </div>
                  <input type="hidden" name="blog_id" id="blog_id">
                  <input type="hidden" name="is_blog_verified" id="is_blog_verified">
                  <div class="form-group">
                    <label  class="form-label">Content</label>
                    <textarea class="form-control" name="edit_content" id="edit_content"  placeholder="Content here ..."  onkeyup="removeError(this)"></textarea>
                    <div class="edit_content text-danger"></div>
                  </div>
                  <div class="mt-md-3 content-center">
                    <button type="submit sign_up" class="btn btn-primary" onclick="editBlog()">UPDATE</button>
                  </div>
                </div>
              </div>
            </div>


            <div class="row existing_blogs">
              @if(!empty($blogs))
              <div class="card col-md-1"></div>
              <div class="row">
                <div class="card col-md-10">
                  <table class="table table-striped table-dark">
                    <thead>
                      <tr>
                        <th scope="col">Created At</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Is Blog Verified</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($blogs as $value)
                      <tr>
                        <td>{{date('Y-m-d H:i:s',strtotime($value->created_at))}}</td>
                        <td>{{$value->heading}}</td>
                        <td>
                          @if($value->is_blog_verified == 1)
                          <span class="hidden-sm-up"><i class="fa fa-lg fa-check" style="color: green;"></i></span> 
                          @else
                          <span class="hidden-sm-up"><i class="fa fa-lg fa-times" style="color: red;"></i></span> 
                          @endif
                        </td>
                        <td>
                          <button class="btn btn-info" onclick="updateBlog({!! $value->blog_id !!},{!! $value->is_blog_verified !!})"><i class="fa fa-lg fa-pencil"></i></button>
                          <button class="btn btn-danger" onclick="deleteBlog({!! $value->blog_id !!})"><i class="fa fa-lg fa-trash-o"></i></button>
                          <button class="btn btn-success" onclick="readBlog('{!! $value->content !!}','{!! $value->heading !!}')"><i class="fa fa-eye"></i></button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-2">{{$blogs->links()}}</div>
              </div>
              @else
              @endif
            </div>




          </div>
          <div class="tab-pane " id="create_blogs" role="tabpanel">
            <div class="col-md-1"></div>
            <div class="col-md-8">
              <form class="needs-validation" method="POST" enctype="multipart/form-data"  novalidate>
                {{ csrf_field() }}
                <div class="form-group">
                  <label  class="form-label">Heading</label>
                  <input type="text" class="form-control" name="heading" id="heading"  placeholder="Heading here ..." onkeyup="removeError(this)">
                  <div class="heading text-danger" ></div>
                </div>
                <div class="form-group">
                  <label  class="form-label">Content</label>
                  <textarea class="form-control" name="content" id="content"  placeholder="Content here ..."  onkeyup="removeError(this)"></textarea>
                  <div class="content text-danger"></div>
                </div>
                <div class="mt-md-3 content-center">
                  <button type="submit sign_up" class="btn btn-primary">SUBMIT</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $('.edit_blog').hide();
    $('.existing_blogs').show();

    $.ajax({  
      url         : "/api/getBlogAnalytics", 
      type        : "POST",
      data        : {
        "_token"      : "{{ csrf_token() }}",
        'users_id'    : {!! $user->users_id !!}
      },
      success:function(data){
        var result = JSON.parse(data);
        document.getElementById('total_blogs').innerHTML = result.data.total_blogs;
        document.getElementById('total_verified').innerHTML = result.data.total_verified;
        document.getElementById('total_verification_pending').innerHTML = result.data.total_verification_pending;
      }
    });

    $.ajax({  
      url         : "/api/getBlogStatistics", 
      type        : "POST",
      data        : {
        "_token"      : "{{ csrf_token() }}",
        'users_id'    : {!! $user->users_id !!}
      },
      success:function(data){

        var result = JSON.parse(data);
        if(result.data.length > 0){

          new Morris.Line({
            element: 'blog_chart',
            data: result.data,
            xkey: ['blog_date'],
            ykeys: ['blog_count'],
            labels: ['No of Blogs'],
            resize: true,
            gridLineColor: '#eef0f2',
            hideHover: 'auto'
          });
        }
        else{

         $('#blog_chart').html("<img src='https://img-en.fs.com/community/communityV2-noMain.jpg' style='height:60%;width:60%; margin-left:26%;'>");
       }
       
     }
   });

    if(localStorage.getItem('activeTab')){

      if(localStorage.getItem('activeTab') == 'dashboard'){   

        $('#blogs.tab-pane').removeClass('active');
        $('#2.nav-item').removeClass('active');
        $('#dashboard.tab-pane').addClass('active');
        $('#1.nav-item').addClass('active');

      }else{

        $('#blogs.tab-pane').addClass('active');
        $('#2.nav-item').addClass('active');
        $('#dashboard.tab-pane').removeClass('active');
        $('#1.nav-item').removeClass('active');
      }
    }
    else{

      $('#blogs.tab-pane').removeClass('active');
      $('#2.nav-item').removeClass('active');
      $('#dashboard.tab-pane').addClass('active');
      $('#1.nav-item').addClass('active');
    }
  });
  
  $( 'form' ).submit( function( event ) {

    event.preventDefault();
    var formData =  new FormData($('form')[0]);
    
    heading   = $('#heading').val();
    content   = $('#content').val();

    if(heading == ''){

      generateErrorToastr('Please enter Heading','heading');
      return false;
    }
    if(content == ''){

      generateErrorToastr('Please enter Content','content');
      return false;
    }
    if ($('#content').val().length < 100)
    {
      generateErrorToastr('Content must have minimum 100 characters','content');
      return false;
    }

    $.ajax({  
      url         : "/api/create_blog", 
      type        : "POST",
      data        : {
        "_token"      : "{{ csrf_token() }}",
        'heading'     : heading,
        'content'     : content,
        'users_id'    : {!! $user->users_id !!}
      },
      success:function(data){
        var result = JSON.parse(data);
        if(result.status == 200){

          Swal.fire({
            title: result.message,
            icon : 'success',
            confirmButtonText: 'OK',
            preConfirm: (inputValue) => {
                    // window.location.replace("http://127.0.0.1:8001/api/login");
                    location.reload();
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


  function deleteBlog(blog_id){

   Swal.fire({
    title: "Are you sure to delete this blog ",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#8CD4F5",
    confirmButtonText: "Yes, Delete it !!",
    cancelButtonText: "No, cancel it !!",
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
    closeOnCancel: false
  }).then((isConfirm)=>
  {

    if (isConfirm.value) {
      window.Swal.fire({
        title: "Loading...",
        showConfirmButton:false,
        imageUrl: "https://i.pinimg.com/originals/f6/65/6a/f6656aa6fdb6b8f905dea0bcc2d71dd8.gif",
        imageSize: '50x50'
      });
      var request_url= "api/deleteBlog";
      $.ajax({  
        type: "DELETE",  
        url: request_url,  
        data: {
          "_token"         : "{{ csrf_token() }}",
          'blog_id'        : blog_id

        },  
        success: function(datas) 
        { 
          result = JSON.parse(datas);
          if (result.status == 200){
            Swal.close();
            Swal.fire({
              title: "Success !!",
              text: result.message,
              icon: "success",
              showCancelButton: false,
              confirmButtonColor: "#8CD4F5",
              confirmButtonText: "Yes, ok !!",
              cancelButtonText: "No, cancel it !!",
              closeOnConfirm: false,
              closeOnCancel: false
            }).then((isConfirm)=>{
             location.reload();
           }
           );
          }
          else{

            Swal.fire({
              title: "Oops !!",
              text: result.message,
              icon: "error",
              showCancelButton: false,
              confirmButtonColor: "#8CD4F5",
              confirmButtonText: "Yes, ok !!",
              cancelButtonText: "No, cancel it !!",
              closeOnConfirm: false,
              closeOnCancel: false
            }).then((isConfirm)=>{
             location.reload();
           }
           );
          }
        },
        error: function (request, status, error) {
         Swal.fire({
          title: "Hey, Something Went Wrong Please Try Again",
          icon: "error",
          showCancelButton: false,
          confirmButtonColor: "#8CD4F5",
          confirmButtonText: "Yes, ok !!",
          cancelButtonText: "No, cancel it !!",
          closeOnConfirm: false,
          closeOnCancel: false
        }).
         then((isConfirm)=>{location.reload();}
          );
       }
     });
    }
    else
    {
      Swal.fire("Cancelled !!", "Hey, Something Went Wrong Please Try Again !!", "error");
    }
  }); 
}

function updateBlog(blog_id,is_blog_verified){

 $.ajax({  
  type: "POST",  
  url: "api/getBlogDetails",  
  data: {
    "_token"             : "{{ csrf_token() }}",
    'blog_id'            : blog_id,
    'is_blog_verified'   : is_blog_verified,
  },
  success: function(datas) 
  { 
    result = JSON.parse(datas);
    if (result.data.length > 0){
      
     $('#edit_heading').val(result.data[0].heading);
     $('#edit_content').val(result.data[0].content);
     $('#is_blog_verified').val(result.data[0].is_blog_verified);
     $('#blog_id').val(result.data[0].blog_id);
     $('.edit_blog').show();
     $('.existing_blogs').hide();
   }
   else{

    Swal.fire({
      title: "Oops !!",
      text: result.data,
      icon: "error",
      showCancelButton: false,
      confirmButtonColor: "#8CD4F5",
      confirmButtonText: "Yes, ok !!",
      cancelButtonText: "No, cancel it !!",
      closeOnConfirm: false,
      closeOnCancel: false
    }).then((isConfirm)=>{
     location.reload();
   }
   );
  }
},
error: function (request, status, error) {
 Swal.fire({
  title: "Hey, Something Went Wrong Please Try Again",
  icon: "error",
  showCancelButton: false,
  confirmButtonColor: "#8CD4F5",
  confirmButtonText: "Yes, ok !!",
  cancelButtonText: "No, cancel it !!",
  closeOnConfirm: false,
  closeOnCancel: false
}).
 then((isConfirm)=>{location.reload();}
  );
}
});  
}

function editBlog(){

  edit_heading   = $('#edit_heading').val();
  edit_content   = $('#edit_content').val();

  if(edit_heading == ''){

    generateErrorToastr('Please enter Heading','edit_heading');
    return false;
  }
  if(edit_content == ''){

    generateErrorToastr('Please enter Content','edit_content');
    return false;
  }
  if ($('#edit_content').val().length < 100)
  {
    generateErrorToastr('Content must have minimum 100 characters','edit_content');
    return false;
  }

  Swal.fire({
    title: "Are you sure to update this blog ",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#8CD4F5",
    confirmButtonText: "Yes, Update it !!",
    cancelButtonText: "No, cancel it !!",
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
    closeOnCancel: false
  }).then((isConfirm)=>
  {

    if (isConfirm.value) {
      window.Swal.fire({
        title: "Loading...",
        showConfirmButton:false,
        imageUrl: "https://i.pinimg.com/originals/f6/65/6a/f6656aa6fdb6b8f905dea0bcc2d71dd8.gif",
        imageSize: '50x50'
      });
      $.ajax({  
        type: "POST",  
        url: "api/create_blog",  
        data: {
          "_token"            :   "{{ csrf_token() }}",
          "heading"           :   $('#edit_heading').val(),
          "content"           :   $('#edit_content').val(),
          "is_blog_verified"  :   $('#is_blog_verified').val(),
          "blog_id"           :   $('#blog_id').val()

        },  
        success: function(datas) 
        { 
          result = JSON.parse(datas);
          if (result.status == 200){
            Swal.close();
            Swal.fire({
              title: "Success !!",
              text: result.message,
              icon: "success",
              showCancelButton: false,
              confirmButtonColor: "#8CD4F5",
              confirmButtonText: "Yes, ok !!",
              cancelButtonText: "No, cancel it !!",
              closeOnConfirm: false,
              closeOnCancel: false
            }).then((isConfirm)=>{
             location.reload();
           }
           );
          }
          else{

            Swal.fire({
              title: "Oops !!",
              text: result.message,
              icon: "error",
              showCancelButton: false,
              confirmButtonColor: "#8CD4F5",
              confirmButtonText: "Yes, ok !!",
              cancelButtonText: "No, cancel it !!",
              closeOnConfirm: false,
              closeOnCancel: false
            }).then((isConfirm)=>{
             location.reload();
           }
           );
          }
        },
        error: function (request, status, error) {
         Swal.fire({
          title: "Hey, Something Went Wrong Please Try Again",
          icon: "error",
          showCancelButton: false,
          confirmButtonColor: "#8CD4F5",
          confirmButtonText: "Yes, ok !!",
          cancelButtonText: "No, cancel it !!",
          closeOnConfirm: false,
          closeOnCancel: false
        }).
         then((isConfirm)=>{location.reload();}
          );
       }
     });
    }
    else
    {
      Swal.fire("Cancelled !!", "Hey, Something Went Wrong Please Try Again !!", "error");
    }
  });
}

function getTab(e){

 console.log(e.id);
 localStorage.setItem('activeTab',e.id);
 var activeTab = localStorage.getItem('activeTab');

 if(localStorage.getItem('activeTab') == 'dashboard'){   

  $('#blogs.tab-pane').removeClass('active');
  $('#2.nav-item').removeClass('active');
  $('#dashboard.tab-pane').addClass('active');
  $('#1.nav-item').addClass('active');
  location.reload();

}else{

  $('#blogs.tab-pane').addClass('active');
  $('#2.nav-item').addClass('active');
  $('#dashboard.tab-pane').removeClass('active');
  $('#1.nav-item').removeClass('active');
  location.reload();
}
}

function clearStorge(){

  localStorage.clear();
  window.location = "/logout";
}

function readBlog(content,heading){

  Swal.fire({
    title: heading,
    text: content,
    confirmButtonColor: '#DD6B55',
    customClass: 'swal-wide',
    confirmButtonText: 'OK',
  }).
  then((isConfirm)=>{

  });
}


</script>






