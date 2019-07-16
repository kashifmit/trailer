@include('header2')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Create Organization</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <!--<div class="x_title">
                    <h2>Form Design <small>different form elements</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>-->
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{url('/insert_dashboard')}}">
                    {{csrf_field()}}
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Select Type<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        Trailer:<input style="margin-left:10px;" type="radio" class="flat" id="trailer" name="gender"  value="M" /> 
                        Tractor:<input style="margin-left:10px;" type="radio" class="flat" id="tractor" name="gender"  value="F" />
                        </div>
                      </div>
                      <div id="trailer_details" style="display:none;">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Traile Category<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                        @foreach($Equipment_data as $data)
                            <option>{{$data->TrailerTypeCategoryName}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Trailer Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                        @foreach($Trailer_type as $type)
                            
                                <option>{{$type->TypeName}}</option>
                            
                        @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Manufacturer Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" name="manu_name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Condition Status<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                        @foreach($CStatus as $status)
                            
                                <option>{{$status->ConditionType}}</option>
                            
                        @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Susspesion<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                        @foreach($suspension as $sus)
                            
                                <option>{{$sus->SuspensionName}}</option>
                            
                        @endforeach
                          </select>
                        </div>
                      </div>
                      </div>
                      <div id="tracctor_details" style="display:none;">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tractor Type<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                        @foreach($Trailer_type as $data1)
                            <option>{{$data1->TypeName}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Serial<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="organization_name" required="required" class="form-control col-md-7 col-xs-12">
                          <input type="hidden" id="first-name" name="UserId" value="{{Session::get('userId')}}">
                        </div>
                      </div>
                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Manufacture Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" name="manu_name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Condition Status<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                        @foreach($CStatus as $status)
                            
                                <option>{{$status->ConditionType}}</option>
                            
                        @endforeach
                          </select>
                        </div>
                      </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" onClick="location.href='{{url('/home2')}}'" type="button">Cancel</button>
						  <button class="btn btn-primary" id="demo">Next</button>
                          <button type="submit" id="sub" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

     

           
          </div>
        </div>
          </div>
          <script type="text/javascript" src='{{url("js/jquery.min.js")}}'></script>        
<script>
$(document).ready(function(){
    $("#tractor").click(function(){
        $("#tracctor_details").show();
        $("#trailer_details").hide();
    });
    $("#trailer").click(function(){
        $("#trailer_details").show();
        $("#tracctor_details").hide();
    });
});
</script>            
        