 @include('header2')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
            @foreach($sitedata as $data)
              <div class="title_left">
              <h3>{{$data->SiteName}}</h3>
              </div>
            @endforeach

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
                    <h2>Equipments Details</h2>
                   <!-- <demo>{{Session::get('userId')}}</demo>-->
                    <ul class="nav navbar-right panel_toolbox">
                     <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>-->
                    
                    </ul>
                    <div class="clearfix"></div>
                  </div>
<script type="text/javascript">
 function addOrganization()
 {
     location.href='{{url("/addEquipment")}}';
 }
</script>
                  <div class="x_content">
                   <!-- <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p>-->
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Equipment Type</th>
                          <th>Action</th>
                          </tr>
                      </thead>


                      <tbody>
                        
                        <tr>
                          <td>Trailer</td>
                          <td><a href="{{url('/TrailerDetails')}}">View</a></td>
                        </tr>
                        <tr>
                          <td>Tractor</td>
                          <td><a href="{{url('/TractorDetails')}}">View</a></td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              
                  
                </div>
              </div>

             
            </div>
          </div>
        </div>
          
        </div>