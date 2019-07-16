@include('header2')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Create Equipment</h3>
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
                @foreach($Trailer_data as $Trailer_data)
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
                      
                      
                      
                      
                      
                      <div id="tracctor_details">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tractor Type<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="t_type">
                        @foreach($tractor_type as $t_type)
                            <option value="{{$t_type->TractorTypeId}}">{{$t_type->TractorTypeName}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <!--<div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Serial<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="organization_name"  class="form-control col-md-7 col-xs-12">
                          <input type="hidden" id="first-name" name="UserId" class="serial"  value="{{Session::get('userId')}}">
                        </div>
                      </div>-->
                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Manufacture Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" >
                        <select class="form-control" name="t_manu">
                        @foreach($tractor_manu as $t_manu)
                            
                                <option value="{{$t_manu->ManuFacturerID}}">{{$t_manu->ManuName}}</option>
                            
                        @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Condition Status<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="t_con">
                        @foreach($CStatus as $status)
                            
                                <option value="{{$status->ConditionStatusId}}">{{$status->ConditionType}}</option>
                            
                        @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">LastInsepctionDate<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" name="lastdate" class="form-control" value="{{$Trailer_data->LastInspectionDate}}"/>
                        </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Name<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="site">
                          @foreach($site_data1 as $data)
                              
                                  <option value="{{$data->SiteId}}">{{$data->SiteName}}</option>
                            
                        @endforeach
                          </select>
                        </div>
                      </div>
                      <!--<div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Owner Info<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                Yes:<input style="margin-left:10px;" type="radio" class="flat" id="yes" name="info"  value="Y" /> 
                                No:<input style="margin-left:10px;" type="radio" class="flat" id="no" name="info"  value="N" />
                          </div>
                      </div>-->
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
                          <input type="text" name="Make" class="form-control" value="{{$Trailer_data->Make}}"/>  
                          </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Plate No.<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="Plate" class="form-control" value="{{$Trailer_data->PlateNo}}"/>
                          </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Class<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="Class" class="form-control" value="{{$Trailer_data->Class}}"/>
                          </div>
                      </div>
                      
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ExpireDate<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" name="ExpireDate" class="form-control" value="{{$Trailer_data->ExpireDate}}"/>
                          </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TitleNo<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="TitleNo" class="form-control" value="{{$Trailer_data->TitleNo}}"/>
                          </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">RegistrationDate<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" name="RegistrationDate" class="form-control" value="{{$Trailer_data->RegistrationDate}}"/>
                          </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">StateAbbreviation<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="StateAbbreviation">
                          @foreach($state1 as $state)
                              
                                  <option value="{{$state->StateAbbreviation}}">{{$state->StateName}}</option>
                            
                          @endforeach
                          </select>
                          </div>
                      </div>
                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Moodel Year<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="Model">
                          @foreach($year1 as $year)
                              
                                  <option value="{{$year->ModelYear}}">{{$year->ModelYear}}</option>
                            
                          @endforeach
                          </select>
                          </div>
                      </div>

                      <div class="form-group" >
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Document Upload<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="Document" class="form-control">
                          </div>
                      </div>
                      </div>
                      <div class="ln_solid"></div>
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
            @endforeach
     

           
          </div>
        </div>
          </div>
       
        