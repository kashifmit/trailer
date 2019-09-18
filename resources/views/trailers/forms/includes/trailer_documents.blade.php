<div class="trailer-contents">

	<div class="row">
		<div class="col-md-12 text-left">
			<h3>
			Equipment Documents - Upload New Document
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-3">
			{!! Form::hidden('DocType[]', 'inspection_document') !!}
			{!! Form::file('FileName[]', null, array('id'=>'inspection_document')) !!}
			
		</div>
		<div class="form-group col-md-3">
			{!! Form::hidden('DocType[]', 'fhwa') !!}
			{!! Form::file('FileName[]', null, array('id'=>'fhwa')) !!}
			
		</div>
		<div class="form-group col-md-3">
			{!! Form::hidden('DocType[]', 'registration') !!}
			{!! Form::file('FileName[]', null, array('id'=>'registration')) !!}
			
		</div>
		<div class="form-group col-md-3">
			{!! Form::hidden('DocType[]', 'tracking_installation_sheet') !!}
			{!! Form::file('FileName[]', null,array('id'=>'tracking_installation_sheet')) !!}
		</div>
	</div>
	@if(isset($data) && count($data->filesData) > 0)
		@include('trailers.forms.includes.trailer_doc_table_view')
	@endif

</div>

