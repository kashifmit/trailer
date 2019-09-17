{!! APFrmErrHelp::showErrorsNotice($errors) !!}
<div class="form-body">
    @if(!isset($data))
    
    <h5 class="title mb-4">{{ __('Account Email / Username and Password') }}</h5>

    <div class="form-group row mb-5 {!! APFrmErrHelp::hasError($errors, 'email') !!}">
        {!! Form::label('email', 'Email Address', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
        <div class="col-md-4">
            {!! Form::text('email', isset($data) ? $data->email : null, array('class'=>'form-control form-control-radius', 'id'=>'email', 'placeholder'=>'Email Address')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'email') !!}
        </div>
        <!-- <div class="col-md-4">
            <button type="button" class="btn btn-primary">Save Email</button>
        </div> -->
    </div>
    @endif

    <header class="heading">
        <h5 class="title">{{ __('Personal Information') }}</h5>
    </header>

    <div class="form-group row {!! APFrmErrHelp::hasError($errors, 'name') !!}">
        {!! Form::label('name', 'First Name', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
        <div class="col-md-4">
            {!! Form::text('name', isset($data) ? $data->name : null, array('class'=>'form-control form-control-radius', 'id'=>'name', 'placeholder'=>'First Name')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'name') !!}
        </div>
    </div>
    <div class="form-group row {!! APFrmErrHelp::hasError($errors, 'last_name') !!}">
        {!! Form::label('last_name', 'Last Name', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
        <div class="col-md-4">
            {!! Form::text('last_name', isset($data) ? $data->last_name : null, array('class'=>'form-control form-control-radius', 'id'=>'last_name', 'placeholder'=>'Last name')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'last_name') !!}
        </div>
    </div>

    <div class="form-group row {!! APFrmErrHelp::hasError($errors, 'organization') !!}">
        {!! Form::label('organization', 'Organization', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
        <div class="col-md-4">
            {!! Form::select('organization', ['' => 'Select Organization']+$organizations, isset($data) ? $data->organization_id : null, array('class'=>'form-control form-control-radius selectable-box', 'id'=>'organization')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'organization') !!}
        </div>
    </div>
    <div class="form-group row mb-5 {!! APFrmErrHelp::hasError($errors, 'role') !!}">
        {!! Form::label('role', 'Role', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
        <div class="col-md-4">
            {!! Form::select('role', ['' => 'Select Role']+$roles, isset($data) ? $data->Role_id : null, array('class'=>'form-control form-control-radius selectable-box', 'id'=>'role')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'role') !!}
        </div>
        <!-- <div class="col-md-4">
            <button type="button" class="btn btn-primary">Save Personal Information</button>
        </div> -->
    </div>

    <header class="heading">
        <h5 class="title">{{ __('Password Update') }}</h5>
    </header>

    <div class="form-group row {!! APFrmErrHelp::hasError($errors, 'password') !!}">
        {!! Form::label('password', 'Password', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
        <div class="col-md-4">
            {!! Form::password('password', array('required', 'class'=>'form-control form-control-radius', 'placeholder'=>'Password')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'Password') !!}
        </div>
    </div>
    <div class="form-group row {!! APFrmErrHelp::hasError($errors, 'confirm_password') !!}">
        {!! Form::label('confirm_password', 'Confirm Password', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
        <div class="col-md-4">
            {!! Form::password('confirm_password', array('required', 'class'=>'form-control form-control-radius', 'placeholder'=>'Confirm Password')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'confirm_password') !!}
        </div>
        <div class="col-md-4">
            {!! Form::button('Save', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
        </div>
    </div>
    
</div>
