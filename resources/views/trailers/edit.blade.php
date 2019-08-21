@extends('layouts.app')

@section('content')
<style>
.image-button {
    color: white;
    background-color: green;
    font-weight: bold;
}
</style>
    @include('flash::message')
    <div class="card">
        <div class="card-header">{{ __('Edit Trailer') }}</div>
        <div class="card-body">
            {!! Form::open(array('method' => 'put', 'route' => array('update.trailer', $data->TrailerSerialNo), 'class' => 'form', 'files'=>true)) !!}
            {!! Form::hidden('TrailerSerialNo', $data->TrailerSerialNo) !!}
                @include('trailers.forms.form')
                <div class="form-actions">
                    {!! Form::button('Update <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
                </div>    
            {!! Form::close() !!}
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function(){
      var date_input=$('.date-picker');
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);

      $(document).on('change', '#SiteId', function() {
        $.post("{{ route('trailer.owners') }}", 
            {
                SiteId: $(this).val(), 
                _method: 'POST', 
                _token: '{{ csrf_token() }}'
            })
            .done(function (response) {
                console.log(response.Owner);
                if (response.success == 1) {
                    $("#Owner").val(response.Owner);
                    $("#business").val(response.business);
                } else {
                    console.log("not found");
                }
            });
      });
    });
</script>    
@endsection
