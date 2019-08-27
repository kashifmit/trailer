<div class="row">&nbsp;</div>
{!! Form::open(array('method' => 'GET', 'class' => 'form', 'files'=>true, 'id' => 'financialForm')) !!}
<div class="row">
	<div class="col-md-4">
		{!! Form::select('business_financial', ['' => 'Select Business']+$business, null, array('class'=>'form-control form-submit', 'id'=>'business_financial')) !!}
	</div>
	<div class="col-md-4">
		{!! Form::select('SiteId_financial', ['' => 'Select Location']+$locations, null, array('class'=>'form-control form-submit', 'id'=>'SiteId_financial')) !!}
	</div>
	<div class="col-md-4">
		{!! Form::select('TrailerSerialNo_financial', ['' => 'Select Trailer Number']+$getTrailers, null, array('class'=>'form-control form-submit', 'id'=>'TrailerSerialNo_financial')) !!}
	</div>
</div>
{!! Form::close() !!}
<div class="row">&nbsp;</div>
<div id="get_financial_data">
	@include('trailers.forms.includes.financilas_data')
</div>