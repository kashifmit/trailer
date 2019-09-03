<ul class="nav nav-tabs">
    <li class="active"><a class="checkClass" data-toggle="tab" href="#trailer_details">Detail</a></li>
    <li><a class="checkClass" data-toggle="tab" href="#trailer_documents">Documents</a></li>
    <li><a class="checkClass" data-toggle="tab" href="#trailer_locations">Locations</a></li>
    <li><a class="checkClass" data-toggle="tab" href="#trailer_financials">Financials</a></li>
  </ul>
{!! APFrmErrHelp::showErrorsNotice($errors) !!}
 @if(isset($data))
 <div class="row">&nbsp;</div>
 <div class="row">&nbsp;</div>
  <div class="row">
    <div class="col-md-12">
      <strong style="font-size: 20px;">Trailer Record - {{$data->TrailerSerialNo}}</strong>
    </div>
  </div>
 @endif 
  <div class="tab-content">
  	<div id="trailer_details" class="tab-pane fade show in active">
  		@include('trailers.forms.includes.trailer_details')
  	</div>
  	<div id="trailer_documents" class="tab-pane fade">
  		@include('trailers.forms.includes.trailer_documents')
  	</div>
  	<div id="trailer_locations" class="tab-pane fade">
  		@include('trailers.forms.includes.trailer_locations')
  	</div>
  	<div id="trailer_financials" class="tab-pane fade">
  		@include('trailers.forms.includes.trailer_financials')
  	</div>
  </div>

