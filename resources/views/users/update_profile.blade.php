@extends('layouts.app')

@section('content')
@include('flash::message')
<div class="page">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <header class="heading">
                    <div class="h3 title mb-2">{{ __('Account Information') }}</div>
                    <h5 class="title">{{ __('Account Email / Username and Password') }}</h5>
                </header>

                <div class="content">
                    {!! Form::open(array('method' => 'put', 'route' => array('update.profile'), 'class' => 'form', 'files'=>true)) !!}
                    {!! Form::hidden('id', Auth::user()->id) !!}
                        <div class="form-body">
                            <div class="form-group row mb-5">
                                {!! Form::label('email', 'Email Address', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-4">
                                    {!! Form::text('email', Auth::user()->email, array('class'=>'form-control form-control-radius', 'id'=>'email', 'placeholder'=>'Email Address', 'readonly' => true)) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'email') !!}
                                </div>
                                <!-- <div class="col-md-4">
                                    <button type="button" class="btn btn-primary">Save Email</button>
                                </div> -->
                            </div>


                            <header class="heading">
                                <h5 class="title">{{ __('Personal Information') }}</h5>
                            </header>

                            <div class="form-group row">
                                {!! Form::label('name', 'First Name', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-4">
                                    {!! Form::text('name', Auth::user()->name, array('class'=>'form-control form-control-radius', 'id'=>'name', 'placeholder'=>'Name')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'name') !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('last_name', 'Last Name', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-4">
                                    {!! Form::text('last_name', Auth::user()->last_name, array('class'=>'form-control form-control-radius', 'id'=>'last_name', 'placeholder'=>'Last Name')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'last_name') !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('organization', 'Organization', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-4">
                                    {!! Form::select('organization', ['' => 'Select Organization']+App\Helpers\DataArrayHelper::getOrganizations(), Auth::user()->organization_id, array('class'=>'form-control form-control-radius', 'id'=>'organization')) !!}
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                {!! Form::label('Role', 'Role', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-4">
                                    {!! Form::select('role', ['' => 'Select Role']+App\Helpers\DataArrayHelper::getRoles(), Auth::user()->Role_id, array('class'=>'form-control form-control-radius', 'id'=>'role')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'role') !!}
                                </div>
                                <!-- <div class="col-md-4">
                                    <button type="button" class="btn btn-primary">Update Personal Information</button>
                                </div> -->
                            </div>

                            <header class="heading">
                                <h5 class="title">{{ __('Password Update') }}</h5>
                            </header>

                            <div class="form-group row">
                                {!! Form::label('password', 'New Password', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-4">
                                    <input type="password" name="password" id="password" class="form-control form-control-radius" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('c_password', 'Confirm Password', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-4">
                                    <input type="password" name="c_password" id="c_password" class="form-control form-control-radius" placeholder="Confirm Password">
                                </div>
                                <div class="col-md-4">
                                    {!! Form::button('Update ', array('class'=>'btn btn-primary', 'type'=>'submit')) !!}
                                </div>
                            </div>

                        </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
</div>
@endsection

    

