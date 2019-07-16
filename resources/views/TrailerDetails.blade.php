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
                    <h2><i class="fa fa-align-left"></i>Trailer<small>Details</small></h2>
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
                        <a class="panel-heading" role="tab" id="headingOne" class="anchors" data-toggle="collapse" data-parent="#accordion" href="#{{$data->TrailerDetailId}}" num="{{$data->TrailerDetailId}}"    aria-controls="collapseOne">
                          <h4 class="panel-title">{{$data->TypeName}}</h4>
                        </a>
                        <a style="float:right;margin-top: -40px;" href='{{url("/deleteEquipment1/{$data->VehicleId}")}}' onclick="if (!confirm('Are you sure?')) { return false }"><button  type="submit" class="btn btn-danger"><i class="fa fa-close"></i></button></a>
                       
                        <div id="{{$data->TrailerDetailId}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                       
                          <div class="x_panel">
                        <div class="x_content">


                              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                  <li role="presentation" class="active"><a href="#tab_content1{{$data->TrailerDetailId}}" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Maintenance</a>
                                  </li>
                                  <li role="presentation" class=""><a href="#tab_content2{{$data->TrailerDetailId}}" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Maintenance Requests</a>
                                  </li>
                                  <li role="presentation" class=""><a href="#tab_content3{{$data->TrailerDetailId}}" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Registration</a>
                                  </li>
                                  <li role="presentation" class=""><a href="#tab_content4{{$data->TrailerDetailId}}" id="ins-tab" role="tab" data-toggle="tab" aria-expanded="true">DOT Inspection</a>
                                  </li>
                                  <li role="presentation" class=""><a href="#tab_content5{{$data->TrailerDetailId}}" role="tab" id="own-tab" data-toggle="tab" aria-expanded="false">Ownership Details</a>
                                  </li>
                                  <li role="presentation" class=""><a href="#tab_content6{{$data->TrailerDetailId}}" role="tab" id="loc-tab2" data-toggle="tab" aria-expanded="false">Location</a>
                                  </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1{{$data->TrailerDetailId}}" aria-{{$data->TrailerDetailId}}labelledby="home-tab">
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
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content2{{$data->TrailerDetailId}}" aria-{{$data->TrailerDetailId}}labelledby="profile-tab">
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
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content3{{$data->TrailerDetailId}}" aria-{{$data->TrailerDetailId}}labelledby="profile-tab">
                                  <div class="panel-body">
                                    <form method="post" id="{{$data->TrailerDetailId}}reg_form" action="{{url('/TrailerEditReg')}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{$data->VehicleId}}" name="VehicleId"/>

                                      <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th scope="row">Make</th>
                                            <td id="{{$data->TrailerDetailId}}label">{{$data->Make}}</td><td id="{{$data->TrailerDetailId}}text" style="display:none;"><input type="text" id="{{$data->TrailerDetailId}}Make" name="Make" value="{{$data->Make}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">PlateNo</th>
                                            <td id="{{$data->TrailerDetailId}}label1">{{$data->PlateNo}}</td><td id="{{$data->TrailerDetailId}}text1" style="display:none;"><input type="text" id="{{$data->TrailerDetailId}}PlateNo" name="PlateNo" value="{{$data->PlateNo}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">Class</th>
                                            <td id="{{$data->TrailerDetailId}}label2">{{$data->Class}}</td><td id="{{$data->TrailerDetailId}}text2" style="display:none;"><input type="text" id="{{$data->TrailerDetailId}}Class" name="Class" value="{{$data->Class}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">TitleNo</th>
                                            <td id="{{$data->TrailerDetailId}}label3">{{$data->TitleNo}}</td><td id="{{$data->TrailerDetailId}}text3" style="display:none;"><input type="text" id="{{$data->TrailerDetailId}}TitleNo" name="TitleNo" value="{{$data->TitleNo}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">RegistrationDate</th>
                                            <td id="{{$data->TrailerDetailId}}label4">{{$data->RegistrationDate}}</td><td id="{{$data->TrailerDetailId}}text4" style="display:none;"><input type="date" id="{{$data->TrailerDetailId}}RegistrationDate" name="RegistrationDate" value="{{$data->RegistrationDate}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">ExpireDate</th>
                                            <td id="{{$data->TrailerDetailId}}label5">{{$data->ExpireDate}}</td><td id="{{$data->TrailerDetailId}}text5" style="display:none;"><input type="date" id="{{$data->TrailerDetailId}}ExpireDate" name="ExpireDate" value="{{$data->ExpireDate}}" /></td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">ModelYear</th>
                                            <td id="{{$data->TrailerDetailId}}label6">{{$data->ModelYear}}</td>
                                            <td id="{{$data->TrailerDetailId}}text6" style="display:none;">
                                              <select id="{{$data->TrailerDetailId}}ModelYear" name="ModelYear">
                                                <option value="{{$data->ModelYear}}">{{$data->ModelYear}}</option>
                                                @foreach($model as $model1)
                                                <option value="{{$model1->ModelYear}}">{{$model1->ModelYear}}</option>
                                                @endforeach
                                            </td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row">StateAbbreviation</th>
                                            <td id="{{$data->TrailerDetailId}}label7">{{$data->StateAbbreviation}}</td>
                                            <td id="{{$data->TrailerDetailId}}text7" style="display:none;">
                                            <select id="{{$data->TrailerDetailId}}StateAbbreviation" name="StateAbbreviation">
                                                <option value="{{$data->StateAbbreviation}}">{{$data->StateAbbreviation}}</option>
                                                @foreach($state as $state1)
                                                <option value="{{$state1->StateAbbreviation}}">{{$state1->StateAbbreviation}}</option>
                                                @endforeach
                                            </td>
                                            
                                          </tr>
                                          <tr>
                                            <th scope="row" colspan="2" align="center">
                                              <a id="{{$data->TrailerDetailId}}edit" class="btn btn-primary">Edit</a>
                                              <button type="submit" id="{{$data->TrailerDetailId}}save" class="btn btn-success" style="display:none">Save</button>
                                            </td>
                                            
                                          </tr>
                                        </tbody>
                                      </table>
                                     </form> 
                                  </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content4{{$data->TrailerDetailId}}" aria-{{$data->TrailerDetailId}}labelledby="ins-tab">
                                  <div class="panel-body">
                                  <form method="post" id="{{$data->TrailerDetailId}}date_form" action="{{url('Trailer_EditInsdate')}}">
                                  {{ csrf_field() }}
                                    <input type="hidden" name="TrailerSerialNo" value="{{$data->TrailerDetailId}}"/>
                                      <table class="table table-bordered">
                                        <tbody>
                                          <tr>
                                            <th scope="row">DOT Inspection Date</th>
                                            <td id="{{$data->VehicleId}}label">{{$data->LastInsepctionDate}}</td><td id="{{$data->VehicleId}}text" style="display:none;"><input type="date" id="{{$data->VehicleId}}Insdate" name="Insdate" value="{{$data->LastInsepctionDate}}"/></td>
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
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content5{{$data->TrailerDetailId}}" aria-{{$data->TrailerDetailId}}labelledby="own-tab">
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
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content6{{$data->TrailerDetailId}}" aria-{{$data->TrailerDetailId}}labelledby="loc-tab2">
                                  <div class="panel-body">
                                  <form method="post" id="{{$data->TrailerDetailId}}site_form" action="{{url('Trailer_EditSite')}}">
                                  {{ csrf_field() }}
                                    <input type="hidden" name="TrailerSerialNo" value="{{$data->TrailerDetailId}}"/>
                                      <table class="table table-bordered">
                                        <tbody>
                                          <tr id="{{$data->TrailerDetailId}}sitelabel">
                                            <th scope="row">Site Name</th>
                                            <td id="{{$data->TrailerDetailId}}siteName123">{{$data->SiteName}}</td>
                                          </tr>
                                          <tr id="{{$data->TrailerDetailId}}sitelabel2">
                                            <th scope="row">Address</th>
                                            <td id="{{$data->TrailerDetailId}}siteAdd123">{{$data->SteetNo}},{{$data->StreetName}},{{$data->SuiteNo}},{{$data->City}},{{$data->PostalCode}}.</td>
                                          </tr>
                                          <tr id="{{$data->TrailerDetailId}}sitetext" style="display:none;">
                                            <th scope="row">Site Name</th>
                                            <td>
                                              <Select id="{{$data->TrailerDetailId}}sitename123" name="site">
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
                                              <a id="{{$data->TrailerDetailId}}siteedit" class="btn btn-primary">Edit</a>
                                              <button type="submit" id="{{$data->TrailerDetailId}}sitesave" class="btn btn-success" style="display:none">Save</button>
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
<!--<script>
$('#{{$data->TrailerDetailId}}edit').click(function(){
  $('#{{$data->TrailerDetailId}}label').hide();
  $('#{{$data->TrailerDetailId}}text').show();
  $('#{{$data->TrailerDetailId}}label1').hide();
  $('#{{$data->TrailerDetailId}}text1').show();
  $('#{{$data->TrailerDetailId}}label2').hide();
  $('#{{$data->TrailerDetailId}}text2').show();
  $('#{{$data->TrailerDetailId}}label3').hide();
  $('#{{$data->TrailerDetailId}}text3').show();
  $('#{{$data->TrailerDetailId}}label4').hide();
  $('#{{$data->TrailerDetailId}}text4').show();
  $('#{{$data->TrailerDetailId}}label5').hide();
  $('#{{$data->TrailerDetailId}}text5').show();
  $('#{{$data->TrailerDetailId}}label6').hide();
  $('#{{$data->TrailerDetailId}}text6').show();
  $('#{{$data->TrailerDetailId}}label7').hide();
  $('#{{$data->TrailerDetailId}}text7').show();
  $('#{{$data->TrailerDetailId}}edit').hide();
  $('#{{$data->TrailerDetailId}}save').show();
});

$('#{{$data->VehicleId}}edit').click(function (){
  $('#{{$data->VehicleId}}label').hide();
  $('#{{$data->VehicleId}}text').show();
  $('#{{$data->VehicleId}}edit').hide();
  $('#{{$data->VehicleId}}save').show();
});
$('#{{$data->TrailerDetailId}}edit1').click(function (){
  console.log('called');
  $('#{{$data->TrailerDetailId}}name').hide();
  $('#{{$data->TrailerDetailId}}add').hide();
  $('#{{$data->TrailerDetailId}}site1').show();
  $('#{{$data->TrailerDetailId}}edit1').hide();
  $('#{{$data->TrailerDetailId}}save1').show();
});
</script>-->
<script>
$('#{{$data->VehicleId}}save').click(function(e){
    e.preventDefault();
    console.log('click');
    $.ajax({
      url:"{{url('/Trailer_EditInsdate')}}",
      method:"POST",
      data:$('#{{$data->TrailerDetailId}}date_form').serialize(),
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
$('#{{$data->TrailerDetailId}}sitesave').click(function(e){
    e.preventDefault();
    console.log('click');
    $.ajax({
      url:"{{url('/Trailer_EditSite')}}",
      method:"POST",
      data:$('#{{$data->TrailerDetailId}}site_form').serialize(),
      dataType:"json",
      success:function(data)
      {

        alert('Your data Update Successfully')
      }
    });
    var id=$('#{{$data->TrailerDetailId}}sitename123').val();
    $.get("{{url('/getSitedata')}}/"+id,function(data){
      console.log(data[0]);
    
    
    $('#{{$data->TrailerDetailId}}sitelabel').show();
    $('#{{$data->TrailerDetailId}}siteName123').html(data[0].SiteName);
    $('#{{$data->TrailerDetailId}}sitelabel2').show();
    $('#{{$data->TrailerDetailId}}siteAdd123').html(data[0].SteetNo+','+data[0].StreetName+','+data[0].SuiteNo+','+data[0].City+','+data[0].PostalCode);
  $('#{{$data->TrailerDetailId}}sitetext').hide();
  $('#{{$data->TrailerDetailId}}siteedit').show();
  $('#{{$data->TrailerDetailId}}sitesave').hide();
});
});
/* Close Code */
/* Edit Registration Ajax Data */
$('#{{$data->TrailerDetailId}}save').click(function(e){
    e.preventDefault();
    console.log('click');
    $.ajax({
      url:"{{url('/TrailerEditReg')}}",
      method:"POST",
      data:$('#{{$data->TrailerDetailId}}reg_form').serialize(),
      dataType:"json",
      success:function(data)
      {

        alert('Your data Update Successfully')
      }
    });
    $('#{{$data->TrailerDetailId}}label').show();
    $('#{{$data->TrailerDetailId}}label1').show();
    $('#{{$data->TrailerDetailId}}label2').show();
    $('#{{$data->TrailerDetailId}}label3').show();
    $('#{{$data->TrailerDetailId}}label4').show();
    $('#{{$data->TrailerDetailId}}label5').show();
    $('#{{$data->TrailerDetailId}}label6').show();
    $('#{{$data->TrailerDetailId}}label7').show();
  $('#{{$data->TrailerDetailId}}label').html($('#{{$data->TrailerDetailId}}Make').val());
  $('#{{$data->TrailerDetailId}}text').hide();
  $('#{{$data->TrailerDetailId}}label1').html($('#{{$data->TrailerDetailId}}PlateNo').val());
  $('#{{$data->TrailerDetailId}}text1').hide();
  $('#{{$data->TrailerDetailId}}label2').html($('#{{$data->TrailerDetailId}}Class').val());
  $('#{{$data->TrailerDetailId}}text2').hide();
  $('#{{$data->TrailerDetailId}}label3').html($('#{{$data->TrailerDetailId}}TitleNo').val());
  $('#{{$data->TrailerDetailId}}text3').hide();
  $('#{{$data->TrailerDetailId}}label4').html($('#{{$data->TrailerDetailId}}RegistrationDate').val());
  $('#{{$data->TrailerDetailId}}text4').hide();
  $('#{{$data->TrailerDetailId}}label5').html($('#{{$data->TrailerDetailId}}ExpireDate').val());
  $('#{{$data->TrailerDetailId}}text5').hide();
  $('#{{$data->TrailerDetailId}}label6').html($('#{{$data->TrailerDetailId}}ModelYear').val());
  $('#{{$data->TrailerDetailId}}text6').hide();
  $('#{{$data->TrailerDetailId}}label7').html($('#{{$data->TrailerDetailId}}StateAbbreviation').val());
  $('#{{$data->TrailerDetailId}}text7').hide();
  $('#{{$data->TrailerDetailId}}edit').show();
  $('#{{$data->TrailerDetailId}}save').hide();
});
/* Close Code */
$('#{{$data->TrailerDetailId}}edit').click(function(){
  $('#{{$data->TrailerDetailId}}label').hide();
  $('#{{$data->TrailerDetailId}}text').show();
  $('#{{$data->TrailerDetailId}}label1').hide();
  $('#{{$data->TrailerDetailId}}text1').show();
  $('#{{$data->TrailerDetailId}}label2').hide();
  $('#{{$data->TrailerDetailId}}text2').show();
  $('#{{$data->TrailerDetailId}}label3').hide();
  $('#{{$data->TrailerDetailId}}text3').show();
  $('#{{$data->TrailerDetailId}}label4').hide();
  $('#{{$data->TrailerDetailId}}text4').show();
  $('#{{$data->TrailerDetailId}}label5').hide();
  $('#{{$data->TrailerDetailId}}text5').show();
  $('#{{$data->TrailerDetailId}}label6').hide();
  $('#{{$data->TrailerDetailId}}text6').show();
  $('#{{$data->TrailerDetailId}}label7').hide();
  $('#{{$data->TrailerDetailId}}text7').show();
  $('#{{$data->TrailerDetailId}}edit').hide();
  $('#{{$data->TrailerDetailId}}save').show();
});

$('#{{$data->VehicleId}}edit').click(function (){
  $('#{{$data->VehicleId}}label').hide();
  $('#{{$data->VehicleId}}text').show();
  $('#{{$data->VehicleId}}edit').hide();
  $('#{{$data->VehicleId}}save').show();
});
$('#{{$data->TrailerDetailId}}siteedit').click(function (){
  $('#{{$data->TrailerDetailId}}sitelabel').hide();
  $('#{{$data->TrailerDetailId}}sitelabel2').hide();
  $('#{{$data->TrailerDetailId}}sitetext').show();
  $('#{{$data->TrailerDetailId}}siteedit').hide();
  $('#{{$data->TrailerDetailId}}sitesave').show();
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
     location.href='{{url("/Insert_trailerEquipment")}}';
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