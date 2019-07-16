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
                                  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1{{$data->TractorDetailId}}" aria-{{$data->TractorSerialNo}}labelledby="home-tab">
                                  <div class="panel-body">
                                      <table class="table table-bordered">
                                        <tbody>
                                          <tr>
                                            <th scope="row">InvoiceNo</th>
                                            <td>{{$data->InvoiceNo}}</td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">Qty</th>
                                            <td>{{$data->Qty}}</td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">ServiceDecription</th>
                                            <td>{{$data->ServiceDecription}}</td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">ChargeAmt</th>
                                            <td>{{$data->ChargeAmt}}</td>
                                            
                                          </tr>
                                        </tbody>
                                      </table>
                          </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content2{{$data->TractorDetailId}}" aria-{{$data->TractorSerialNo}}labelledby="profile-tab">
                                  <div class="panel-body">
                                      <table class="table table-bordered">
                                        <tbody>
                                          <tr>
                                            <th scope="row">Date</th>
                                            <td>16/01/2019</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Service</th>
                                            <td>All types of service</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                  </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content3{{$data->TractorDetailId}}" aria-{{$data->TractorSerialNo}}labelledby="profile-tab">
                                  <div class="panel-body">
                                    <form method="post" action="{{url('/tractroEditReg')}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{$data->VehicleId}}" name="VehicleId"/>

                                      <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th scope="row">Make</th>
                                            <td id="{{$data->TractorSerialNo}}label">{{$data->Make}}</td><td id="{{$data->TractorSerialNo}}text" style="display:none;"><input type="text" name="Make" value="{{$data->Make}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">PlateNo</th>
                                            <td id="{{$data->TractorSerialNo}}label1">{{$data->PlateNo}}</td><td id="{{$data->TractorSerialNo}}text1" style="display:none;"><input type="text" name="PlateNo" value="{{$data->PlateNo}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">Class</th>
                                            <td id="{{$data->TractorSerialNo}}label2">{{$data->Class}}</td><td id="{{$data->TractorSerialNo}}text2" style="display:none;"><input type="text" name="Class" value="{{$data->Class}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">TitleNo</th>
                                            <td id="{{$data->TractorSerialNo}}label3">{{$data->TitleNo}}</td><td id="{{$data->TractorSerialNo}}text3" style="display:none;"><input type="text" name="TitleNo" value="{{$data->TitleNo}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">RegistrationDate</th>
                                            <td id="{{$data->TractorSerialNo}}label4">{{$data->RegistrationDate}}</td><td id="{{$data->TractorSerialNo}}text4" style="display:none;"><input type="date" name="RegistrationDate" value="{{$data->RegistrationDate}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">ExpireDate</th>
                                            <td id="{{$data->TractorSerialNo}}label5">{{$data->ExpireDate}}</td><td id="{{$data->TractorSerialNo}}text5" style="display:none;"><input type="date" name="ExpireDate" value="{{$data->ExpireDate}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">ModelYear</th>
                                            <td id="{{$data->TractorSerialNo}}label6">{{$data->ModelYear}}</td>
                                            <td id="{{$data->TractorSerialNo}}text6" style="display:none;">
                                              <select name="ModelYear">
                                                <option value="{{$data->ModelYear}}">{{$data->ModelYear}}</option>
                                                @foreach($model as $model1)
                                                <option value="{{$model1->ModelYear}}">{{$model1->ModelYear}}</option>
                                                @endforeach
                                            </td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">StateAbbreviation</th>
                                            <td id="{{$data->TractorSerialNo}}label7">{{$data->StateAbbreviation}}</td>
                                            <td id="{{$data->TractorSerialNo}}text7" style="display:none;">
                                            <select name="StateAbbreviation">
                                                <option value="{{$data->StateAbbreviation}}">{{$data->StateAbbreviation}}</option>
                                                @foreach($state as $state1)
                                                <option value="{{$state1->StateAbbreviation}}">{{$state1->StateAbbreviation}}</option>
                                                @endforeach
                                            </td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row" colspan="2" align="center">
                                              <a id="{{$data->TractorSerialNo}}edit" class="btn btn-primary">Edit</a>
                                              <button type="submit" id="{{$data->TractorSerialNo}}save" class="btn btn-success" style="display:none">Save</button>
                                            </td>
                                            
                                          </tr>
                                        </tbody>
                                      </table>
                                     </form> 
                                  </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content4{{$data->TractorDetailId}}" aria-{{$data->TractorSerialNo}}labelledby="ins-tab">
                                  <div class="panel-body">
                                  <form method="post" id="date_form" action="{{url('tractor_EditInsdate')}}">
                                  {{ csrf_field() }}
                                    <input type="hidden" name="TractorSerialNo" value="{{$data->TractorSerialNo}}"/>
                                      <table class="table table-bordered">
                                        <tbody>
                                          <tr>
                                            <th scope="row">DOT Inspection Date</th>
                                            <td id="{{$data->VehicleId}}label">{{$data->LastInspectionDate}}</td><td id="{{$data->VehicleId}}text" style="display:none;"><input type="date" name="Insdate" value="{{$data->LastInspectionDate}}"/></td>
                                          </tr>
                                          <tr>
                                            <th scope="row" colspan="2" align="center">
                                              <a id="{{$data->VehicleId}}edit" class="btn btn-primary">Edit</a>
                                              <button type="submit" id="{{$data->VehicleId}}save" class="btn btn-success" style="display:none">Save</button>
                                            </td>
                                            
                                          </tr>
                                          
                                        </tbody>
                                      </table>
                                      </form>
                                  </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content5{{$data->TractorDetailId}}" aria-{{$data->TractorSerialNo}}labelledby="own-tab">
                                  <div class="panel-body">
                                      <table class="table table-bordered">
                                        <tbody>
                                          <tr>
                                            <th scope="row">Ownership Info</th>
                                            <td>{{$data->Own_info}}</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                  </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content6{{$data->TractorDetailId}}" aria-{{$data->TractorSerialNo}}labelledby="loc-tab2">
                                  <div class="panel-body">
                                  <form method="post" action="{{url('tractor_EditSite')}}">
                                  {{ csrf_field() }}
                                    <input type="hidden" name="TractorSerialNo" value="{{$data->TractorSerialNo}}"/>
                                      <table class="table table-bordered">
                                        <tbody>
                                          <tr id="{{$data->SiteId}}label">
                                            <th scope="row">Site Name</th>
                                            <td>{{$data->SiteName}}</td>
                                          </tr>
                                          <tr id="{{$data->SiteId}}label2">
                                            <th scope="row">Address</th>
                                            <td>{{$data->SteetNo}},{{$data->StreetName}},{{$data->SuiteNo}},{{$data->City}},{{$data->PostalCode}}.</td>
                                          </tr>
                                          <tr id="{{$data->SiteId}}text" style="display:none;">
                                            <th scope="row">Site Name</th>
                                            <td>
                                              <Select name="site">
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
                                              <a id="{{$data->SiteId}}edit" class="btn btn-primary">Edit</a>
                                              <button type="submit" id="{{$data->SiteId}}save" class="btn btn-success" style="display:none">Save</button>
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
      data:$('#date_form').serialize(),
      dataType:"json",
      success:function(data)
      {
        alert('Your data Update Successfully')
      }
    });
    $('#{{$data->VehicleId}}label').show();
  $('#{{$data->VehicleId}}text').hide();
  $('#{{$data->VehicleId}}edit').show();
  $('#{{$data->VehicleId}}save').hide();
});
$('#{{$data->TractorSerialNo}}edit').click(function(){
  $('#{{$data->TractorSerialNo}}label').hide();
  $('#{{$data->TractorSerialNo}}text').show();
  $('#{{$data->TractorSerialNo}}label1').hide();
  $('#{{$data->TractorSerialNo}}text1').show();
  $('#{{$data->TractorSerialNo}}label2').hide();
  $('#{{$data->TractorSerialNo}}text2').show();
  $('#{{$data->TractorSerialNo}}label3').hide();
  $('#{{$data->TractorSerialNo}}text3').show();
  $('#{{$data->TractorSerialNo}}label4').hide();
  $('#{{$data->TractorSerialNo}}text4').show();
  $('#{{$data->TractorSerialNo}}label5').hide();
  $('#{{$data->TractorSerialNo}}text5').show();
  $('#{{$data->TractorSerialNo}}label6').hide();
  $('#{{$data->TractorSerialNo}}text6').show();
  $('#{{$data->TractorSerialNo}}label7').hide();
  $('#{{$data->TractorSerialNo}}text7').show();
  $('#{{$data->TractorSerialNo}}edit').hide();
  $('#{{$data->TractorSerialNo}}save').show();
});

$('#{{$data->VehicleId}}edit').click(function (){
  $('#{{$data->VehicleId}}label').hide();
  $('#{{$data->VehicleId}}text').show();
  $('#{{$data->VehicleId}}edit').hide();
  $('#{{$data->VehicleId}}save').show();
});
$('#{{$data->SiteId}}edit').click(function (){
  $('#{{$data->SiteId}}label').hide();
  $('#{{$data->SiteId}}label2').hide();
  $('#{{$data->SiteId}}text').show();
  $('#{{$data->SiteId}}edit').hide();
  $('#{{$data->SiteId}}save').show();
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
     location.href='{{url("/addEquipment")}}';
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
  </script>