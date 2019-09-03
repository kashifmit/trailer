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
			<div class="fileinput fileinput-new" data-provides="fileinput">
				<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
					<img src="{{ asset('/') }}no-image.png" alt="" />
				</div>
				<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
				<div>
					<span class="btn default btn-file image-button">
						<span class="fileinput-new">
							Inspection Document 
						</span> 
					<span class="fileinput-exists"> Change </span>
					{!! Form::file('FileName[]', null, array('id'=>'inspection_document')) !!}
					</span> 
					<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">Remove</a>
				</div>
			</div>
		</div>
		<div class="form-group col-md-3">
			{!! Form::hidden('DocType[]', 'fhwa') !!}
			<div class="fileinput fileinput-new" data-provides="fileinput">
				<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
					<img src="{{ asset('/') }}no-image.png" alt="" />
				</div>
				<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
				<div>
					<span class="btn default btn-file image-button">
						<span class="fileinput-new">FHWA</span>
						<span class="fileinput-exists"> Change </span>
						{!! Form::file('FileName[]', null, array('id'=>'fhwa')) !!}
					</span>
					<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
				</div>
			</div>
		</div>
		<div class="form-group col-md-3">
			{!! Form::hidden('DocType[]', 'registration') !!}
			<div class="fileinput fileinput-new" data-provides="fileinput">
				<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
					<img src="{{ asset('/') }}no-image.png" alt="" />
				</div>
				<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
				<div>
					<span class="btn default btn-file image-button">
						<span class="fileinput-new">Registration </span>
						<span class="fileinput-exists"> Change </span>
						{!! Form::file('FileName[]', null, array('id'=>'registration')) !!}
					</span>
					<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
				</div>
			</div>
		</div>
		<div class="form-group col-md-3">
			{!! Form::hidden('DocType[]', 'tracking_installation_sheet') !!}
			<div class="fileinput fileinput-new" data-provides="fileinput">
				<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
					<img src="{{ asset('/') }}no-image.png" alt="" />
				</div>
				<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
				<div>
					<span class="btn default btn-file image-button">
						<span class="fileinput-new">Tracking Installation Sheet</span>
						<span class="fileinput-exists"> Change </span>
						{!! Form::file('FileName[]', null,array('id'=>'tracking_installation_sheet')) !!}
					</span>
					<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
				</div>
			</div>
		</div>
	</div>
	@if(isset($data) && count($data->filesData) > 0)
	<div class="row">
		@foreach($data->filesData as $fileData)
		<div class="col-md-3"><a href="{{route('download.file',$fileData->Id)}}">DownLoad {{str_replace("_", " ",$fileData->DocType)}}</a></div>
		{!! Form::hidden('Id[]', $fileData->Id) !!}
		@endforeach
	</div>
	@endif

</div>

