{!! APFrmErrHelp::showErrorsNotice($errors) !!}
<div class="form-body">
    <div class="form-group row">
        {!! Form::label('name', 'Manufacturer', ['class' => 'bold']) !!}                    
        {!! Form::text('MakeName', isset($data) ? $data->MakeName : null, array('class'=>'form-control', 'id'=>'MakeName', 'placeholder'=>'Manufacturer')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'MakeName') !!}
    </div>
    <div class="form-actions">
        {!! Form::button('Submit <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>
