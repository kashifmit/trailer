<div class="nav-tabs-wrap sticky">
  <ul class="nav nav-tabs">
    <li><a class="checkClass" data-toggle="tab" href="#home_details">Home</a></li>
    <li class="active"><a class="checkClass" data-toggle="tab" href="#trailer_details">Detail</a></li>
    <li><a class="checkClass trailer_documents" data-toggle="tab" href="#trailer_documents">Documents</a></li>
    <li><a class="checkClass" data-toggle="tab" href="#trailer_locations">Locations</a></li>
    <li><a class="checkClass" data-toggle="tab" href="#trailer_financials">Financials</a></li>
  </ul>
</div>

{!! APFrmErrHelp::showErrorsNotice($errors) !!}

  <div class="tab-content">
    @if(isset($data))
        <header class="heading mb-0">
          <h3 class="title">
            Trailer Record - {{$data->TrailerSerialNo}}
          </h3>
        </header>
    @endif 

    <div id="home_details" class="tab-pane fade">
        @include('trailers.forms.includes.trailer_home')
    </div>
  	<div id="trailer_details" class="tab-pane fade show in active">
  		@include('trailers.forms.includes.trailer_details')
  	</div>
  	<div id="trailer_documents" class="tab-pane fade">
  		@if(Route::currentRouteName() == 'create.trailer')
        @include('trailers.forms.includes.search_documents')
      @else
        @include('trailers.forms.includes.trailer_document_view')
      @endif  
  	</div>
  	<div id="trailer_locations" class="tab-pane fade">
  		@include('trailers.forms.includes.trailer_locations')
  	</div>
  	<div id="trailer_financials" class="tab-pane fade">
  		@include('trailers.forms.includes.trailer_financials')
  	</div>
  </div>
  

