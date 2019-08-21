{!! APFrmErrHelp::showErrorsNotice($errors) !!}
<div class="form-body">
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'name') !!}">
        {!! Form::label('name', 'First Name', ['class' => 'bold']) !!}
        {!! Form::text('name', isset($data) ? $data->name : null, array('class'=>'form-control', 'id'=>'name', 'placeholder'=>'First Name')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'name') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'last_name') !!}">
        {!! Form::label('last_name', 'Last Name', ['class' => 'bold']) !!}
        {!! Form::text('last_name', isset($data) ? $data->last_name : null, array('class'=>'form-control', 'id'=>'last_name', 'placeholder'=>'Last name')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'last_name') !!}
    </div>
    @if(!isset($data))
	<div class="form-group {!! APFrmErrHelp::hasError($errors, 'email') !!}">
        {!! Form::label('email', 'Email Address', ['class' => 'bold']) !!}
        {!! Form::text('email', null, array('class'=>'form-control', 'id'=>'email', 'placeholder'=>'Email Address')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'email') !!}
    </div>
    @endif
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'password') !!}">
        {!! Form::label('password', 'Password', ['class' => 'bold']) !!}
        {!! Form::password('password', array('required', 'class'=>'form-control', 'placeholder'=>'Password')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'Password') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'confirm_password') !!}">
        {!! Form::label('confirm_password', 'Confirm Password', ['class' => 'bold']) !!}
        {!! Form::password('confirm_password', array('required', 'class'=>'form-control', 'placeholder'=>'Confirm Password')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'confirm_password') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'organization') !!}">
        {!! Form::label('organization', 'Organization', ['class' => 'bold']) !!}                    
        {!! Form::select('organization', ['' => 'Select Organization']+$organizations, isset($data) ? $data->organization_id : null, array('class'=>'form-control', 'id'=>'organization')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'organization') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'role') !!}">
        {!! Form::label('role', 'Role', ['class' => 'bold']) !!}                    
        {!! Form::select('role', ['' => 'Select Role']+$roles, isset($data) ? $data->Role_id : null, array('class'=>'form-control', 'id'=>'role')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'role') !!}                                       
    </div>
    <div class="form-actions">
        {!! Form::button('Submit <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>
