@include('header1')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Organization Admin <small>Details</small></h3>
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
                    <h2>Create Organization</h2>
                   
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
                      <li><button onclick="addOrganization()" type="submit" class="btn btn-success"><i class="fa fa-plus-square-o"></i></button>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
<script type="text/javascript">
 function addOrganization()
 {
     location.href='{{url("/addOrganization")}}';
 }
</script>
                  <!--<div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <tr class="headings">
                          <th class="column-title">SiteId</th>
                          <th class="column-title">SiteName</th>
                          <th class="column-title">SteetNo</th>
                          <th class="column-title">StreetName</th>
                          <th class="column-title">SuiteNo</th>
                          <th class="column-title">City</th>
                          <th class="column-title">State</th>
                          <th class="column-title">Invite</th>
                          </tr>
                      </thead>


                      <tbody>
                        @foreach($getData->all() as $data)
                        
                         <tr class="even pointer">
                          <td>{{$data->SiteId}}</td>
                          <td>{{$data->SiteName}}</td>
                          <td>{{$data->SteetNo}}</td>
                          <td>{{$data->StreetName}}</td>
                          <td>{{$data->SuiteNo}}</td>
                          <td>{{$data->City}}</td>
                          <td>{{$data->State}}</td>
                          <td><a href='{{url("/addSiteInvite/{$data->SiteId}")}}'>Invite</a></td>
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