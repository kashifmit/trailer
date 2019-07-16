@include('header')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Organization <small>Details</small></h3>
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
                  <div class="x_content">
                   <!-- <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p>-->
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          
                          <th>Organization Name</th>
                          <th>Invite</th>
                          <th>Edit</th>
                         <!-- <th>Delete</th>-->
                          </tr>
                      </thead>


                      <tbody>
                        @foreach($getData->all() as $data)
                        <tr>
                          
                          <td>{{$data->organizationName}}</td>
                          <td><a href='{{url("/addInvite/{$data->organizationId}")}}'>Invite</a></td>
                          <td><a href='{{url("/Editeorg/{$data->organizationId}")}}'><button onclick="addOrganization()" type="submit" class="btn btn-primary"><i class="fa fa-edit"></i></button></a></td>
                         <!-- <td><a href='{{url("/Deleteorg/{$data->OrganizationId}")}}' onclick="if (!confirm('Are you sure?')) { return false }"><button  type="submit" class="btn btn-danger"><i class="fa fa-close"></i></button></a></td>-->
                          </tr>
                        @endforeach
                        
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
