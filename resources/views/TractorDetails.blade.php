@include('header2')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              <h3><!-- <small>Details</small>--></h3>
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
                  <div class="x_title">
                    <h2><i class="fa fa-align-left"></i>Tractor<small>Details</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button onclick="addOrganization()" type="submit" class="btn btn-success"><i class="fa fa-plus-square-o"></i></button>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    

                    <!-- start accordion -->
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach($Trailer_data as $data)
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne" class="anchors" data-toggle="collapse" data-parent="#accordion" href="#{{$data->TractorDetailId}}" num="{{$data->TractorDetailId}}"    aria-controls="collapseOne">
                          <h4 class="panel-title">{{$data->TractorTypeName}}</h4>
                        </a>
                        <a style="float:right;margin-top: -40px;" href='{{url("/deleteEquipment/{$data->VehicleId}")}}' onclick="if (!confirm('Are you sure?')) { return false }"><button  type="submit" class="btn btn-danger"><i class="fa fa-close"></i></button></a>
                       
                        <div id="{{$data->TractorDetailId}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                       
                          <div class="x_panel">
                        <div class="x_content">


                              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                  <li role="presentation" class="active"><a href="#tab_content1{{$data->TractorDetailId}}" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Maintenance</a>
                                  </li>
                                  <li role="presentation" class=""><a href="#tab_content2{{$data->TractorDetailId}}" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Maintenance Requests</a>
                                  </li>
                                  <li role="presentation" class=""><a href="#tab_content3{{$data->TractorDetailId}}" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Registration</a>
                                  </li>
                                  <li role="presentation" class=""><a href="#tab_content4{{$data->TractorDetailId}}" id="ins-tab" role="tab" data-toggle="tab" aria-expanded="true">DOT Inspection</a>
                                  </li>
                                  <li role="presentation" class=""><a href="#tab_content5{{$data->TractorDetailId}}" role="tab" id="own-tab" data-toggle="tab" aria-expanded="false">Ownership Details</a>
                                  </li>
                                  <li role="presentation" class=""><a href="#tab_content6{{$data->TractorDetailId}}" role="tab" id="loc-tab2" data-toggle="tab" aria-expanded="false">Location</a>
                                  </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1{{$data->TractorDetailId}}" aria-labelledby="home-tab">
                                  <div class="panel-body">
                                      <table class="table table-bordered">
                                        <tbody>
                                          <tr>
                                            <th scope="row">InvoiceNo</th>
                                            <th scope="row">Qty</th>
                                            <th scope="row">ServiceDecription</th>
                                            <th scope="row">ChargeAmt</th>
                                            <th scope="row" colspan="2">Document</th>
                                            
                                            
                                          </tr>
                                          <tr>
                                            <td>{{$data->InvoiceNo}}</td>
                                            <td>{{$data->Qty}}</td>
                                            <td>{{$data->ServiceDecription}}</td>
                                            <td>{{$data->ChargeAmt}}</td>
                                            <td><input type="file" id="file_call" /></td><td><input type="submit" value="Upload document"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                          </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content2{{$data->TractorDetailId}}" aria-labelledby="profile-tab">
                                  <div class="panel-body">
                                      <table class="table table-bordered">
                                        <tbody>
                                          <tr>
                                            <th scope="row">Date</th>
                                            <th scope="row">Service</th>
                                            <!--<th scope="row" colspan="2">Document</th>-->
                                            
                                          </tr>
                                          <tr>
                                            <td>16/01/2019</td>
                                            <td>All types of service</td>
                                            <!--<td><input type="file" /></td><td><input type="submit" value="Upload document"></td>-->
                                          </tr>
                                        </tbody>
                                      </table>
                                  </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content3{{$data->TractorDetailId}}" aria-labelledby="profile-tab">
                                  <div class="panel-body">
                                    <form method="post" id="{{$data->TractorDetailId}}reg_form" action="{{url('/tractroEditReg')}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{$data->VehicleId}}" name="VehicleId"/>

                                      <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th scope="row">Make</th>
                                            <td id="{{$data->TractorDetailId}}label">{{$data->Make}}</td><td id="{{$data->TractorDetailId}}text" style="display:none;"><input type="text" id="{{$data->TractorDetailId}}Make" name="Make" value="{{$data->Make}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">PlateNo</th>
                                            <td id="{{$data->TractorDetailId}}label1">{{$data->PlateNo}}</td><td id="{{$data->TractorDetailId}}text1" style="display:none;"><input type="text" id="{{$data->TractorDetailId}}PlateNo" name="PlateNo" value="{{$data->PlateNo}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">Class</th>
                                            <td id="{{$data->TractorDetailId}}label2">{{$data->Class}}</td><td id="{{$data->TractorDetailId}}text2" style="display:none;"><input type="text" id="{{$data->TractorDetailId}}Class" name="Class" value="{{$data->Class}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">TitleNo</th>
                                            <td id="{{$data->TractorDetailId}}label3">{{$data->TitleNo}}</td><td id="{{$data->TractorDetailId}}text3" style="display:none;"><input type="text" id="{{$data->TractorDetailId}}TitleNo" name="TitleNo" value="{{$data->TitleNo}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">RegistrationDate</th>
                                            <td id="{{$data->TractorDetailId}}label4">{{$data->RegistrationDate}}</td><td id="{{$data->TractorDetailId}}text4" style="display:none;"><input type="date" id="{{$data->TractorDetailId}}RegistrationDate" name="RegistrationDate" value="{{$data->RegistrationDate}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">ExpireDate</th>
                                            <td id="{{$data->TractorDetailId}}label5">{{$data->ExpireDate}}</td><td id="{{$data->TractorDetailId}}text5" style="display:none;"><input type="date" id="{{$data->TractorDetailId}}ExpireDate" name="ExpireDate" value="{{$data->ExpireDate}}" /></td>
                                                                                                                      
                                          </tr>
                                          <tr>
                                            <th scope="row">ModelYear</th>
                                            <td id="{{$data->TractorDetailId}}label6">{{$data->ModelYear}}</td>
                                            <td id="{{$data->TractorDetailId}}text6" style="display:none;">
                                              <select id="{{$data->TractorDetailId}}ModelYear" name="ModelYear">
                                                <option value="{{$data->ModelYear}}">{{$data->ModelYear}}</option>
                                                @foreach($model as $model1)
                                                <option value="{{$model1->ModelYear}}">{{$model1->ModelYear}}</option>
                                                @endforeach
                                            </td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">StateAbbreviation</th>
                                            <td id="{{$data->TractorDetailId}}label7">{{$data->StateAbbreviation}}</td>
                                            <td id="{{$data->TractorDetailId}}text7" style="display:none;">
                                            <select id="{{$data->TractorDetailId}}StateAbbreviation" name="StateAbbreviation">
                                                <option value="{{$data->StateAbbreviation}}">{{$data->StateAbbreviation}}</option>
                                                @foreach($state as $state1)
                                                <option value="{{$state1->StateAbbreviation}}">{{$state1->StateAbbreviation}}</option>
                                                @endforeach
                                            </td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row" colspan="2" align="center">
                                              <a id="{{$data->TractorDetailId}}edit" class="btn btn-primary">Edit</a>
                                              <button type="submit" id="{{$data->TractorDetailId}}save" class="btn btn-success" style="display:none">Save</button>
                                            </td>
                                            
                                          </tr>
                                        </tbody>
                                      </table>
                                     </form> 
                                  </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content4{{$data->TractorDetailId}}" aria-labelledby="ins-tab">
                                  <div class="panel-body">
                                  <form method="post" id="{{$data->TractorDetailId}}date_form" action="{{url('tractor_EditInsdate')}}">
                                  {{ csrf_field() }}
                                    <input type="hidden" name="TractorDetailId" value="{{$data->TractorDetailId}}"/>
                                      <table class="table table-bordered">
                                        <tbody>
                                          <tr>
                                            <th scope="row">DOT Inspection Date</th>
                                            <th scope="row" colspan="2">Document</th>
                                          </tr>
                                          <tr>
                                            <td id="{{$data->VehicleId}}label">{{$data->LastInspectionDate}}</td><td id="{{$data->VehicleId}}text" style="display:none;"><input type="date" id="{{$data->VehicleId}}Insdate" name="Insdate" value="{{$data->LastInspectionDate}}"/></td>
                                            <td><input type="file" /></td><td><input type="submit" value="Upload document"></td>
                                          </tr>
                                          <tr>
                                            <th scope="row" colspan="3" align="center">
                                              <a id="{{$data->VehicleId}}edit" class="btn btn-primary">Edit</a>
                                              <button type="submit" id="{{$data->VehicleId}}save" class="btn btn-success" style="display:none">Save</button>
                                            </td>
                                            
                                          </tr>
                                          
                                        </tbody>
                                      </table>
                                      </form>
                                  </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content5{{$data->TractorDetailId}}" aria-labelledby="own-tab">
                                  <div class="panel-body">
                                      <table class="table table-bordered">
                                        <tbody>
                                          <tr>
                                            <th scope="row">Ownership Info</th>
                                            <th scope="row" colspan="2">Document</th>
                                          </tr>
                                          <tr>
                                            <td>{{$data->Own_info}}</td>
                                            <td><input type="file" /></td><td><input type="submit" value="Upload document"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                  </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content6{{$data->TractorDetailId}}" aria-labelledby="loc-tab2">
                                  <div class="panel-body">
                                  <form method="post" id="{{$data->TractorDetailId}}site_form" action="{{url('tractor_EditSite')}}">
                                  {{ csrf_field() }}
                                    <input type="hidden" name="TractorDetailId" value="{{$data->TractorDetailId}}"/>
                                      <table class="table table-bordered">
                                        <tbody>
                                          <tr id="{{$data->TractorDetailId}}sitelabel">
                                            <th scope="row">Site Name</th>
                                            <td id="{{$data->TractorDetailId}}siteName123">{{$data->SiteName}}</td>
                                          </tr>
                                          <tr id="{{$data->TractorDetailId}}sitelabel2">
                                            <th scope="row">Address</th>
                                            <td id="{{$data->TractorDetailId}}siteAdd123">{{$data->SteetNo}},{{$data->StreetName}},{{$data->SuiteNo}},{{$data->City}},{{$data->PostalCode}}.</td>
                                          </tr>
                                          <tr id="{{$data->TractorDetailId}}sitetext" style="display:none;">
                                            <th scope="row">Site Name</th>
                                            <td>
                                              <Select id="{{$data->TractorDetailId}}sitename123" name="site">
                                                <option value="{{$data->SiteId}}">{{$data->SiteName}}</option>
                                                @foreach($site as $site1)
                                                <option value="{{$site1->SiteId}}">{{$site1->SiteName}}</option>
                                                @endforeach
                                              </select>
                                            </td>
                                            </td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row" colspan="2" align="center">
                                              <a id="{{$data->TractorDetailId}}siteedit" class="btn btn-primary">Edit</a>
                                              <button type="submit" id="{{$data->TractorDetailId}}sitesave" class="btn btn-success" style="display:none">Save</button>
                                            </td>
                                            
                                          </tr>
                                          
                                        </tbody>
                                      </table>
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
<script>
$('#{{$data->VehicleId}}save').click(function(e){
    e.preventDefault();
    console.log('click');
    $.ajax({
      url:"{{url('/tractor_EditInsdate')}}",
      method:"POST",
      data:$('#{{$data->TractorDetailId}}date_form').serialize(),
      dataType:"json",
      success:function(data)
      {

        alert('Your data Update Successfully')
      }
    });
    $('#{{$data->VehicleId}}label').html($('#{{$data->VehicleId}}Insdate').val());
    $('#{{$data->VehicleId}}label').show();
  $('#{{$data->VehicleId}}text').hide();
  $('#{{$data->VehicleId}}edit').show();
  $('#{{$data->VehicleId}}save').hide();
});
/* Edit Site Data */
$('#{{$data->TractorDetailId}}sitesave').click(function(e){
    e.preventDefault();
    console.log('click');
    $.ajax({
      url:"{{url('/tractor_EditSite')}}",
      method:"POST",
      data:$('#{{$data->TractorDetailId}}site_form').serialize(),
      dataType:"json",
      success:function(data)
      {

        alert('Your data Update Successfully')
      }
    });
    var id=$('#{{$data->TractorDetailId}}sitename123').val();
    $.get("{{url('/getSitedata')}}/"+id,function(data){
      console.log(data[0]);
    
    
    $('#{{$data->TractorDetailId}}sitelabel').show();
    $('#{{$data->TractorDetailId}}siteName123').html(data[0].SiteName);
    $('#{{$data->TractorDetailId}}sitelabel2').show();
    $('#{{$data->TractorDetailId}}siteAdd123').html(data[0].SteetNo+','+data[0].StreetName+','+data[0].SuiteNo+','+data[0].City+','+data[0].PostalCode);
  $('#{{$data->TractorDetailId}}sitetext').hide();
  $('#{{$data->TractorDetailId}}siteedit').show();
  $('#{{$data->TractorDetailId}}sitesave').hide();
});
});
/* Close Code */
/* Edit Registration Ajax Data */
$('#{{$data->TractorDetailId}}save').click(function(e){
    e.preventDefault();
    console.log('click');
    $.ajax({
      url:"{{url('/tractroEditReg')}}",
      method:"POST",
      data:$('#{{$data->TractorDetailId}}reg_form').serialize(),
      dataType:"json",
      success:function(data)
      {

        alert('Your data Update Successfully')
      }
    });
    $('#{{$data->TractorDetailId}}label').show();
    $('#{{$data->TractorDetailId}}label1').show();
    $('#{{$data->TractorDetailId}}label2').show();
    $('#{{$data->TractorDetailId}}label3').show();
    $('#{{$data->TractorDetailId}}label4').show();
    $('#{{$data->TractorDetailId}}label5').show();
    $('#{{$data->TractorDetailId}}label6').show();
    $('#{{$data->TractorDetailId}}label7').show();
  $('#{{$data->TractorDetailId}}label').html($('#{{$data->TractorDetailId}}Make').val());
  $('#{{$data->TractorDetailId}}text').hide();
  $('#{{$data->TractorDetailId}}label1').html($('#{{$data->TractorDetailId}}PlateNo').val());
  $('#{{$data->TractorDetailId}}text1').hide();
  $('#{{$data->TractorDetailId}}label2').html($('#{{$data->TractorDetailId}}Class').val());
  $('#{{$data->TractorDetailId}}text2').hide();
  $('#{{$data->TractorDetailId}}label3').html($('#{{$data->TractorDetailId}}TitleNo').val());
  $('#{{$data->TractorDetailId}}text3').hide();
  $('#{{$data->TractorDetailId}}label4').html($('#{{$data->TractorDetailId}}RegistrationDate').val());
  $('#{{$data->TractorDetailId}}text4').hide();
  $('#{{$data->TractorDetailId}}label5').html($('#{{$data->TractorDetailId}}ExpireDate').val());
  $('#{{$data->TractorDetailId}}text5').hide();
  $('#{{$data->TractorDetailId}}label6').html($('#{{$data->TractorDetailId}}ModelYear').val());
  $('#{{$data->TractorDetailId}}text6').hide();
  $('#{{$data->TractorDetailId}}label7').html($('#{{$data->TractorDetailId}}StateAbbreviation').val());
  $('#{{$data->TractorDetailId}}text7').hide();
  $('#{{$data->TractorDetailId}}edit').show();
  $('#{{$data->TractorDetailId}}save').hide();
});
/* Close Code */
$('#{{$data->TractorDetailId}}edit').click(function(){
  $('#{{$data->TractorDetailId}}label').hide();
  $('#{{$data->TractorDetailId}}text').show();
  $('#{{$data->TractorDetailId}}label1').hide();
  $('#{{$data->TractorDetailId}}text1').show();
  $('#{{$data->TractorDetailId}}label2').hide();
  $('#{{$data->TractorDetailId}}text2').show();
  $('#{{$data->TractorDetailId}}label3').hide();
  $('#{{$data->TractorDetailId}}text3').show();
  $('#{{$data->TractorDetailId}}label4').hide();
  $('#{{$data->TractorDetailId}}text4').show();
  $('#{{$data->TractorDetailId}}label5').hide();
  $('#{{$data->TractorDetailId}}text5').show();
  $('#{{$data->TractorDetailId}}label6').hide();
  $('#{{$data->TractorDetailId}}text6').show();
  $('#{{$data->TractorDetailId}}label7').hide();
  $('#{{$data->TractorDetailId}}text7').show();
  $('#{{$data->TractorDetailId}}edit').hide();
  $('#{{$data->TractorDetailId}}save').show();
});

$('#{{$data->VehicleId}}edit').click(function (){
  $('#{{$data->VehicleId}}label').hide();
  $('#{{$data->VehicleId}}text').show();
  $('#{{$data->VehicleId}}edit').hide();
  $('#{{$data->VehicleId}}save').show();
});
$('#{{$data->TractorDetailId}}siteedit').click(function (){
  $('#{{$data->TractorDetailId}}sitelabel').hide();
  $('#{{$data->TractorDetailId}}sitelabel2').hide();
  $('#{{$data->TractorDetailId}}sitetext').show();
  $('#{{$data->TractorDetailId}}siteedit').hide();
  $('#{{$data->TractorDetailId}}sitesave').show();
});

</script>
                    @endforeach
</div>
                    </div>
                    <!-- end of accordion -->


                  </div>
                </div>
              </div>
               <!-- <div class="x_panel">
                  <div class="x_title">
                    <h2>Equipments</h2>
                    <demo>{{Session::get('userId')}}</demo>
                    <ul class="nav navbar-right panel_toolbox">
                  
                      <li><button onclick="addOrganization()" type="submit" class="btn btn-success"><i class="fa fa-plus-square-o"></i></button>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>-->
<script type="text/javascript">
 function addOrganization()
 {
     location.href='{{url("/Insert_tractorEquipment")}}';
 }
</script>
                 
                </div>
              </div>

              
                  
                </div>
              </div>

             
            </div>
          </div>
        </div>
          
        </div>
 
<script>

/*$('a').click(function (){
    
    var id = $(this).attr('num');
    console.log(id);
var settings = {
       "async": true,
       "crossDomain": true,
       "url": "http://localhost:8000/get_allEquipmentData/"+id,
       "method": "GET"
     }
     

     $.ajax(settings).done(function (response) {
       console.log(response[0]);
       //var json = JSON.parse(response);
       //console.log(json[0].ChargeAmt);
       var json =response[0];
       $("#ChargeAmt").html(json.ChargeAmt);
       $("#Qty").html(json.Qty);
       $("#ServiceDecription").html(json.ServiceDecription);
       $("#InvoiceNo").html(json.InvoiceNo);
       $("#Make").html(json.Make);
       $("#PlateNo").html(json.PlateNo);
       $("#Class").html(json.Class);
       $("#ExpireDate").html(json.ExpireDate);
       $("#TitleNo").html(json.TitleNo);
       $("#RegistrationDate").html(json.RegistrationDate);
       $("#StateAbbreviation").html(json.StateAbbreviation);
       $("#Document").html(json.Document);
       $("#ModelYear").html(json.ModelYear);  
    });
});*/
$('#file_call').click(function(){
  console.log('called_file');
});
  </script>