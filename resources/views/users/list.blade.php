@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 pull-left">{{ __('Users') }}</div>
            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-3 pull-right">
                <a href="{{route('create.user')}}" class="btn btn-xs btn-success">
                    <i class="glyphicon glyphicon-plus"></i>
                    Add New User
                </a> 
            </div>
        </div>
    </div>

    <div class="card-body">
        {!! Form::open(array('method' => 'GET', 'route' => 'users.list', 'class' => 'form', 'files'=>true)) !!}
        <div class="row">
            <div class="col-md-2">
                <input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="First Name" value="{{\Request::get('name')}}">
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="last_name" id="last_name" autocomplete="off" placeholder="Last Name" value="{{\Request::get('last_name')}}">
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="email" id="email" autocomplete="off" placeholder="email" value="{{\Request::get('email')}}">
            </div>
            <div class="col-md-2">
                {!! Form::select('organization', ['' => 'Select Organization']+$organizations, \Request::get('organization') ? \Request::get('organization') : null, array('class'=>'form-control', 'id'=>'organization')) !!}
            </div>
            <div class="col-md-2">
                {!! Form::select('role', ['' => 'Select Role']+$roles, \Request::get('role') ? \Request::get('role') : null, array('class'=>'form-control', 'id'=>'role')) !!}
            </div>
            <div class="col-md-2">
                {!! Form::button('Find <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
            </div>
        </div>
        {!! Form::close() !!} 
        <div class="row">&nbsp;</div>
        <div class="table-container">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Organization</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Alldata as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->last_name}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{isset($data->organizations) ? $data->organizations->OrgName : "--"}}</td>
                            <td>{{isset($data->roles) ? $data->roles->Role_name : "--"}}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{route('edit.user', ['id' => $data->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($Alldata)
                <div class="pull-right">{{$Alldata->links()}}</div>
            @endif
        </div>
    </div>
</div>
@endsection

    

