@extends('layouts.app')

@section('content')
@include('flash::message')
<div class="page">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success" id="alert-success" style="display: none;"></div>
                <header class="heading">
                    <div class="h3 title mb-2">{{ __('Account Information') }}</div>
                    <h5 class="title">{{ __('Account Email / Username and Password') }}</h5>
                </header>

                <div class="content">
                    {!! Form::open(array('class' => 'form', 'files'=>true, 'id' => 'profile_form')) !!}
                        <div class="form-body">
                            <div class="form-group row mb-5">
                                {!! Form::label('email', 'Email Address', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-4">
                                    {!! Form::text('email', Auth::user()->email, array('class'=>'form-control email-class form-control-radius', 'id'=>'email', 'placeholder'=>'Email Address')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'email') !!}
                                    <span class="text-danger" id="email_span" 
                                        style="display: none"></span>
                                </div>
                                <div class="col-md-4">
                                    {!! Form::button('Save Email', array('class'=>'btn btn-primary save-email', 'type'=>'button')) !!}
                                </div>
                            </div>


                            <header class="heading">
                                <h5 class="title">{{ __('Personal Information') }}</h5>
                            </header>

                            <div class="form-group row">
                                {!! Form::label('name', 'First Name', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-4">
                                    {!! Form::text('name', Auth::user()->name, array('class'=>'form-control name-class form-control-radius', 'id'=>'name', 'placeholder'=>'Name')) !!}
                                    <span class="text-danger" id="name_span" 
                                        style="display: none"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('last_name', 'Last Name', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-4">
                                    {!! Form::text('last_name', Auth::user()->last_name, array('class'=>'form-control last_name-class form-control-radius', 'id'=>'last_name', 'placeholder'=>'Last Name')) !!}
                                    <span class="text-danger" id="last_name_span" 
                                        style="display: none"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('organization', 'Organization', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-4">
                                    {!! Form::select('organization', ['' => 'Select Organization']+App\Helpers\DataArrayHelper::getOrganizations(), Auth::user()->organization_id, array('class'=>'form-control organization-class form-control-radius', 'id'=>'organization')) !!}
                                    <span class="text-danger" id="organization_span" 
                                        style="display: none"></span>
                                </div>
                                <div class="col-md-4">
                                    {!! Form::button('Update Personal Information', array('class'=>'btn btn-primary save-personal-info', 'type'=>'button')) !!}
                                </div>
                            </div>

                            <header class="heading">
                                <h5 class="title">{{ __('Password Update') }}</h5>
                            </header>

                            <div class="form-group row">
                                {!! Form::label('old_password', 'Old Password', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-4">
                                    <input type="password" name="old_password" id="old_password" class="form-control password-class form-control-radius" placeholder="Old Password" autocomplete="off">
                                    <span class="text-danger" id="old_password_span" 
                                        style="display: none"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('password', 'New Password', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-4">
                                    <input type="password" name="password" id="password" class="form-control password-class form-control-radius" placeholder="New Password" autocomplete="off">
                                    <span class="text-danger" id="password_span" 
                                        style="display: none"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('c_password', 'Confirm Password', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-4">
                                    <input type="password" name="c_password" id="c_password" class="form-control c_password-class form-control-radius" placeholder="Confirm Password">
                                    <span class="text-danger" id="c_password_span" 
                                        style="display: none"></span>
                                </div>
                                <div class="col-md-4">
                                    {!! Form::button('Update Password ', array('class'=>'btn btn-primary save-password', 'type'=>'button')) !!}
                                </div>
                            </div>

                        </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#old_password").val("");
    });
    $(document).on('click', '.save-email', function(){
        var url = "/update-email";
        var formData = $("#profile_form").serialize();
        ajaxCall(url, formData); 
    });
    $(document).on('click', '.save-personal-info', function(){
        var url = "/update-personal-info";
        var formData = $("#profile_form").serialize();
        ajaxCall(url, formData); 
    });
    $(document).on('click', '.save-password', function(){
        var url = "/update-password";
        var formData = $("#profile_form").serialize();
        ajaxCall(url, formData); 
    });
    function ajaxCall(url, formData) {
        $.ajax({
            url: url,
            method: "put",
            data: formData  
        }).done(function(response) {
            if (response.success) {
                $("#alert-success").html(response.message).show();
                $('html, body').animate({
                    scrollTop: $("#alert-success").offset().top
                }, 500);
                setTimeout(function() {
                    $("#alert-success").html('').hide();
                },3000);
            }
            else {
                var errors = response.errors;
                for (var key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        $("."+key+"-class").addClass('is-invalid');
                        $("#"+key+"_span").show().html(errors[key]);
                        setTimeout(function(){ 
                            $("."+key+"-class").removeClass('is-invalid');
                            $('.text-danger').html('').hide(); 
                        }, 3000);
                    }
                }
            }
        });
    }
</script>
@endsection

    

