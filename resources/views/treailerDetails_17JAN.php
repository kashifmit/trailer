@include('header2')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              <h3>Trailer Manager<!-- <small>Details</small>--></h3>
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
                        <div class="x_title">
                                <ul class="nav navbar-right panel_toolbox">
                                  <li><a href='{{url("/editDetails_tractor/{$data->TrailerSerialNo}")}}'><button onclick="addOrganization()" type="submit" class="btn btn-primary"><i class="fa fa-edit"></i></button></a></li>
                                  <li><a href='{{url("/deleteDetails_tractor/{$data->TrailerSerialNo}")}}' onclick="if (!confirm('Are you sure?')) { return false }"><button  type="submit" class="btn btn-danger"><i class="fa fa-close"></i></button></a></li>
                                </ul>
                                <div class="clearfix"></div>
                              </div>
                        <div id="{{$data->TrailerDetailId}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                              <!-- <div class="x_title">
                              <h2><i class="fa fa-bars"></i> Vertical Tabs <small>Float left</small></h2>
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

                                <div class="col-xs-3">
                                  <!-- required for floating -->
                                  <!-- Nav tabs -->
                                  <ul class="nav nav-tabs tabs-left">
                                    <li class="active"><a href="#home{{$data->TrailerDetailId}}" num="{{$data->TrailerDetailId}}" data-toggle="tab">Maintenance</a>
                                    </li>
                                    <li><a href="#profile{{$data->TrailerDetailId}}" num="{{$data->TrailerDetailId}}" data-toggle="tab">Maintenance Requests</a>
                                    </li>
                                    <li><a href="#messages{{$data->TrailerDetailId}}" num="{{$data->TrailerDetailId}}" data-toggle="tab">Registration</a>
                                    </li>
                                    <li><a href="#settings{{$data->TrailerDetailId}}" num="{{$data->TrailerDetailId}}" data-toggle="tab">DOT Inspection</a>
                                    </li>
                                    <li><a href="#Ownership{{$data->TrailerDetailId}}" num="{{$data->TrailerDetailId}}" data-toggle="tab">Ownership Details</a>
                                    </li>
                                    <li><a href="#Location{{$data->TrailerDetailId}}" num="{{$data->TrailerDetailId}}" data-toggle="tab">Location</a>
                                    </li>
                                  </ul>
                                </div>

                                <div class="col-xs-9">
                                  <!-- Tab panes -->
                                  <div class="tab-content">
                                    <div class="tab-pane active" id="home{{$data->TrailerDetailId}}">
                                    <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                              <th>InvoiceNo</th>
                                              <th>Qty </th>
                                              <th>ServiceDecription</th>
                                              <th>ChargeAmt</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th scope="row">{{$data->InvoiceNo}}</th>
                                              <td >{{$data->Qty}}</td>
                                              <td>{{$data->ServiceDecription}}</td>
                                              <td>{{$data->ChargeAmt}}</td>
                                            </tr>
                                          </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="profile{{$data->TrailerDetailId}}">
                                    <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                              <th>Request</th>
                                              <th>12/12/2018</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th scope="row">Service Description</th>
                                              <td>All Service</td>
                                            </tr>
                                          </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="messages{{$data->TrailerDetailId}}">
                                    <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                              <th>Make</th>
                                              <th>PlateNo </th>
                                              <th>Class</th>
                                              <th>ExpireDate</th>
                                              <th>TitleNo</th>
                                              <th>RegistrationDate </th>
                                              <th>StateAbbreviation</th>
                                              <th>Document</th>
                                              <th>ModelYear</th>
                                              
                                            </tr>
                                          </thead>
                                          <tbody>
                                          <tr>
                                              <th scope="row">{{$data->Make}}</th>
                                              <td >{{$data->PlateNo}}</td>
                                              <td>{{$data->Class}}</td>
                                              <td>{{$data->ExpireDate}}</td>
                                              <th>{{$data->TitleNo}}</th>
                                              <td >{{$data->RegistrationDate}}</td>
                                              <td>{{$data->StateAbbreviation}}</td>
                                              <td>{{$data->Document}}</td>
                                              <th>{{$data->ModelYear}}</th>
                                              
                                            </tr>
                                          </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="settings{{$data->TrailerDetailId}}">
                                    <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                              <th>InvoiceNo</th>
                                              <th>Qty </th>
                                              <th>ServiceDecription</th>
                                              <th>ChargeAmt</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th scope="row">1</th>
                                              <td>Mark</td>
                                              <td>Otto</td>
                                              <td>@mdo</td>
                                            </tr>
                                          </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="Ownership{{$data->TrailerDetailId}}">
                                    <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                              <th>Owner Info</th>
                                              <th>No</th>
                                              
                                            </tr>
                                          </thead>
                                          
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="Location{{$data->TrailerDetailId}}">
                                    <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                              <th>Assign</th>
                                              <th>No </th>
                                              
                                            </tr>
                                          </thead>
                                        </table>
                                    </div>
                                  </div>
                                </div>

                                <div class="clearfix"></div>

                              </div>
                            </div>
                      </div>
                        </div>
                      </div>

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
                  <!--<div class="x_content">
                   <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Trailer Type</th>
                          <th>Manufacture Name</th>
                          <th>Suspension Name</th>
                          <th>Condition Status</th>
                          </tr>
                      </thead>


                      <tbody>
                        @foreach($Trailer_data as $data)
                        <tr>
                         
                          <td>{{$data->TypeName}}</td>
                          <td>{{$data->ManuName}}</td>
                          <td>{{$data->SuspensionName}}</td>
                          <td>{{$data->ConditionType}}</td>
                          </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>-->
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