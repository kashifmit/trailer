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
                  
                  <div class="x_content" id="tractor">
                  
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
$(document).ready(function(){
  $.get("{{url('Get_data')}}",function(data)
    {
      $('#tractor').empty().html(data);
      //console.log(data);
    });
});
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