@extends('layouts.app')

@section('content')
<div class="page">
    <div class="row">
        <div class="col-xl-3">
            <header class="heading">
                <div class="h3 title">
                    {{ __('Users') }}
                </div>
            </header>

            <div class="form-block mb-5">
                {!! Form::open(array('method' => 'GET', 'route' => 'users.list', 'class' => 'form', 'files'=>true)) !!}
                <div class="form-group">
                    <input type="text" class="form-control form-control-radius" name="name" id="name" autocomplete="off" placeholder="First Name" value="{{\Request::get('name')}}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-radius" name="last_name" id="last_name" autocomplete="off" placeholder="Last Name" value="{{\Request::get('last_name')}}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-radius" name="email" id="email" autocomplete="off" placeholder="email" value="{{\Request::get('email')}}">
                </div>
                <div class="form-group">
                    {!! Form::select('organization', ['' => 'Select Organization']+$organizations, \Request::get('organization') ? \Request::get('organization') : null, array('class'=>'form-control form-control-radius', 'id'=>'organization')) !!}
                </div>
                <div class="form-group">
                    {!! Form::select('role', ['' => 'Select Role']+$roles, \Request::get('role') ? \Request::get('role') : null, array('class'=>'form-control form-control-radius', 'id'=>'role')) !!}
                </div>
                <div class="form-group">
                    {!! Form::button('Search User', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
        <div class="col-xl-9">
            <div class="mb-4 text-right">
                <a href="{{route('create.user')}}" class="btn btn-primary">
                    Add New User
                </a> 
            </div>

            <div class="table-responsive">
                <table class="table text-sm table-striped table-hover">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
                            <th>Organization</th>
                            <th>Role</th>
                            <th class="text-right">Action</th>
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
                                <td class="text-right">
                                    <a class="btn-action" href="{{route('edit.user', ['id' => $data->id])}}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($Alldata)
                <div class="mt-2">{{$Alldata->links()}}</div>
            @endif

        </div>
    </div>


    <div class="card-body">
        


    </div>
</div>
@endsection

    

