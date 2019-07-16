<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TrailerApp</title>

    <!-- Bootstrap -->
    <link href='{{url("vendors/bootstrap/dist/css/bootstrap.min.css")}}' rel="stylesheet">
    <!-- Font Awesome -->
    <link href='{{url("vendors/font-awesome/css/font-awesome.min.css")}}' rel="stylesheet">
    <!-- NProgress -->
    <link href='{{url("vendors/nprogress/nprogress.css")}}' rel="stylesheet">
    <!-- Animate.css -->
    <link href='{{url("vendors/animate.css/animate.min.css")}}' rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href='{{url("build/css/custom.min.css")}}' rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
  
      <div class="login_wrapper">
      
        <div class="animate form login_form">
        
          <section class="login_content">
          @foreach($org as $org)
              <h4>You are invited to create account for {{$org->organizationName}} organization. Please fill below information and submit. </h4>
            @endforeach
          @if($message = Session::get('error'))
                    
                    <h2 style="color:black;">{{$message}}</h2>
                    
                @endif
                <form method="post" action="{{url('/createTeamManager')}}">
            {{csrf_field()}}
            @foreach($data->all() as $data)
            @if($data->status==0)
            
              <input type="hidden" name="inviteId" value="{{$data->invitationId}}">
              
              <div>
                <input type="email" class="form-control" name="email" value="{{$data->Email}}" disabled />
              </div>
              <div>
                <input type="text" class="form-control" name="name" placeholder="Name" required/>
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required />
              </div>
              <div>
                <button class="btn btn-default submit" type="submit">Submit</button>
              </div>
                
              <div class="clearfix"></div>

              <div class="separator">
                
                <div class="clearfix"></div>
                <br />

                <div>
                 
              </div>
              @else
              <h1>you have all ready registerd</h1>
            @endif
            @endforeach
            </form>
          </section>
        </div>

        
      </div>
    </div>
  </body>
</html>
