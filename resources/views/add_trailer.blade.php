@include('header2')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Create Trailer</h3>
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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data"  action="{{url('/InsertEquipmentdetails')}}">
                    {{csrf_field()}}
                     <!-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Select Type<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        Trailer:<input style="margin-left:10px;" type="radio"  id="trailer" name="gender"  value="1" /> 
                        Tractor:<input style="margin-left:10px;" type="radio"  id="tractor" name="gender"  value="0" />
                        </div>
                      </div>-->
                      <input type="hidden" name="gender"  value="1"/>
                      
                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Trailer Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="subcat">
                        @foreach($Trailer_type as $type)
                            
                                <option value="{{$type->TrailerTypeId}}">{{$type->TypeName}}</option>
                            
                        @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Manufacturer Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="manufacture">
                        @foreach($manafacture as $manu)
                            
                                <option value="{{$manu->ManufacturerId}}">{{$manu->ManuName}}</option>
                            
                        @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Condition Status<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="con_status">
                        @foreach($CStatus as $status)
                            
                                <option value="{{$status->ConditionStatusId}}">{{$status->ConditionType}}</option>
                            
                        @endforeach
                          </select>
                        </div>
                      </div>
                        <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Susspesion<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="susspension">
                          @foreach($suspension as $sus)
                              
                                  <option value="{{$sus->SuspensionId}}">{{$sus->SuspensionName}}</option>
                            
                        @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">LastInsepctionDate<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" id="one" name="LastInsepctionDate" required="required" class="form-control"/>
                        </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Name<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="site">
                          @foreach($site_data as $site_data)
                              
                                  <option value="{{$site_data->SiteId}}">{{$site_data->SiteName}}</option>
                            
                        @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Owner Info<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                Yes:<input style="margin-left:10px;" type="radio" class="flat" id="yes" name="info"  value="YES" checked /> 
                                No:<input style="margin-left:10px;" type="radio" class="flat" id="no" name="info"  value="NO" />
                          </div>
                      </div>
                      <div class="form-group" >
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><span class="required"></span>
                          </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <b style="font-size:18px;border-bottom: darkgrey;border-bottom-style: solid;">Equipment Registartion Details</b>
                      </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Make<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="two" name="Make1" required="required" class="form-control"/>  
                          </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Plate No.<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="three" required="required" name="Plate1" class="form-control"/>
                          </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Class<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="four" required="required" name="Class1" class="form-control"/>
                          </div>
                      </div>
                      
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ExpireDate<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" id="five" required="required" name="ExpireDate1" class="form-control"/>
                          </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TitleNo<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="six" required="required" name="TitleNo1" class="form-control"/>
                          </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">RegistrationDate<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" id="seven" required="required" name="RegistrationDate1" class="form-control"/>
                          </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">StateAbbreviation<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="StateAbbreviation1">
                          @foreach($state as $state)
                              
                                  <option value="{{$state->StateAbbreviation}}">{{$state->StateName}}</option>
                            
                        @endforeach
                          </select>
                          </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Moodel Year<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="Model1">
                          @foreach($year as $year)
                              
                                  <option value="{{$year->ModelYear}}">{{$year->ModelYear}}</option>
                            
                        @endforeach
                          </select>
                          </div>
                      </div>

                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Document Upload<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" required="required" id="file1" name="Document1" class="form-control">
                          </div>
                      </div>
                      
                
                      
                      
                     
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" onClick="location.href='{{url('/home2')}}'" type="button">Cancel</button>
						              <!--<button class="btn btn-primary" id="demo">Next</button>-->
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
                 
<script>
$(document).ready(function(){
    /*$("#tractor").click(function(){
        
        $("#tracctor_details").show();
        $("#trailer_details").hide();
    });
    $("#trailer").click(function(){
        $("#trailer_details").show();
        $("#tracctor_details").hide();
    });*/
    $('#sub').click(function() {
      var radio=$('input[name="gender"]:checked').val();
      
      
      if(radio==1)
      {
        var one=$('#one').val();
      var two=$('#two').val();
      var three=$('#three').val();
      var four=$('#four').val();
      var five=$('#five').val();
      var six=$('#six').val();
      var seven=$('#seven').val();
          var file = $('#file1').val();
        var exts = ['doc','docx','pdf','xlsx','xls','png','gif','jpeg'];
        // first check if file field has any value
        if ( file ) {
          // split file name at dot
          var get_ext = file.split('.');
          // reverse name to check extension
          get_ext = get_ext.reverse();
          // check file type is valid as given in 'exts' array
          if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1){
            //alert( 'Allowed extension!' );
            //return false;
          
          } else {
            alert( 'Invalid file!' );
            return false;
          }
        }  
      }
      else
      {
            var file = $('#file2').val();
          var exts = ['doc','docx','pdf','xlsx','xls','png','gif','jpeg'];
          // first check if file field has any value
          if ( file ) {
            // split file name at dot
            var get_ext = file.split('.');
            // reverse name to check extension
            get_ext = get_ext.reverse();
            // check file type is valid as given in 'exts' array
            if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
              //alert( 'Allowed extension!' );
              //return false;
            } else {
              alert( 'Invalid file!' );
              return false;
            }
          } 
      }
      
    });
});

</script>            
        