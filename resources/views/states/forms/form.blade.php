{!! APFrmErrHelp::showErrorsNotice($errors) !!}
<div class="form-body">
    <div class="form-group row">
        {!! Form::label('name', 'State Abbrivation', ['class' => 'bold']) !!}                    
        {!! Form::text('StateAbbreviation', isset($data) ? $data->StateAbbreviation : null, array('class'=>'form-control', 'id'=>'StateAbbreviation', 'placeholder'=>'State Abbrivation')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'StateAbbreviation') !!}
    </div>
    <div class="form-group row">
        {!! Form::label('name', 'State Name', ['class' => 'bold']) !!}                    
        {!! Form::text('StateName', isset($data) ? $data->StateName : null, array('class'=>'form-control', 'id'=>'StateName', 'placeholder'=>'State Abbrivation')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'StateName') !!}
    </div>
    <div class="form-group row">
        {!! Form::label('name', 'Country', ['class' => 'bold']) !!}                    
        {!! Form::text('Country', isset($data) ? $data->Country : null, array('class'=>'form-control', 'id'=>'Country', 'placeholder'=>'State Abbrivation')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'Country') !!}
    </div>
    <div class="form-actions">
        {!! Form::button('Submit <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>
