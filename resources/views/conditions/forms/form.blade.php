{!! APFrmErrHelp::showErrorsNotice($errors) !!}
<div class="form-body">
    <div class="form-group row">
        {!! Form::label('name', 'Condition Type', ['class' => 'bold']) !!}                    
        {!! Form::text('ConditionType', isset($data) ? $data->ConditionType : null, array('class'=>'form-control', 'id'=>'ConditionType', 'placeholder'=>'Condition Type')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'ConditionType') !!}
    </div>
    <div class="form-actions">
        {!! Form::button('Submit <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>
