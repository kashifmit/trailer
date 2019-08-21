{!! APFrmErrHelp::showErrorsNotice($errors) !!}
<div class="form-body">
    <div class="form-group row">
        {!! Form::label('name', 'Model', ['class' => 'bold']) !!}                    
        {!! Form::text('ModelYear', isset($data) ? $data->ModelYear : null, array('class'=>'form-control', 'id'=>'ModelYear', 'placeholder'=>'Model')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'email') !!}
    </div>
    <div class="form-actions">
        {!! Form::button('Submit <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>
