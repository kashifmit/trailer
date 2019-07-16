<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

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
          @if($message = Session::get('error'))
                    
                    <h2 style="color:black;">{{$message}}</h2>
                    
                @endif
			<form method="post" action="{{url('/checkUser')}}">
			{{csrf_field()}}
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" name="email" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
              </div>
              <div>
                <button class="btn btn-default submit" type="submit">Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <!--<p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>-->
                </p>

                <div class="clearfix"></div>
                <br />

               
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
			<form method="post" action="{{url('/createUser')}}">
			{{csrf_field()}}
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" name="name" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" name="email" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
              </div>
              <div>
                <button class="btn btn-default submit" type="submit">Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
