{!! APFrmErrHelp::showErrorsNotice($errors) !!}
<div class="form-body">
    <div class="form-group row">
        {!! Form::label('name', 'Organization Name', ['class' => 'bold']) !!}                    
        {!! Form::text('OrgName', isset($data) ? $data->OrgName : null, array('class'=>'form-control', 'id'=>'OrgName', 'placeholder'=>'Organization Name')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'email') !!}
    </div>
    <div class="form-actions">
        {!! Form::button('Submit <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>
