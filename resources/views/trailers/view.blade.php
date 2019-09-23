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
    <div class="page">
        <div class="content">
            <ul class="nav nav-tabs sticky">
              <li><a class="checkClass" data-toggle="tab" href="#home_details">Home</a></li>
              <li class="active">
                <a class="checkClass" data-toggle="tab" href="#trailer_details">
                  Detail
                </a>
              </li>
              <li>
                <a class="checkClass" data-toggle="tab" href="#trailer_documents">
                  Documents
                </a>
              </li>
              <li>
                <a class="checkClass" data-toggle="tab" href="#trailer_locations">
                  Locations
                </a>
              </li>
              <li>
                <a class="checkClass" data-toggle="tab" href="#trailer_financials">
                  Financials
                </a>
              </li>
            </ul>
            
            <div class="tab-content">

              <header class="heading mb-0">
                <h3 class="title">
                  Trailer Record - {{$data->TrailerSerialNo}}
                </h3>
              </header>

                <div id="home_details" class="tab-pane fade">
                    @include('trailers.forms.includes.trailer_home')
                </div>
                <div id="trailer_details" class="tab-pane fade show in active">
                   @include('trailers.forms.includes.trailer_view')
                </div>
                <div id="trailer_documents" class="tab-pane fade">
                    @include('trailers.forms.includes.trailer_document_view')
                </div>
                <div id="trailer_locations" class="tab-pane fade">
                    @include('trailers.forms.includes.trailer_locations')
                </div>
                <div id="trailer_financials" class="tab-pane fade">
                    @include('trailers.forms.includes.trailer_financials')
                </div>
          </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function(){
      $(document).on('click', '.edit-class', function() {
        $("#edit_trailer").submit();
      });
      $(document).on('click', '.search-by-trailer-number', function () {
        var formData = $("#search-by-trailer-number").serialize();
        searchTrailer(formData);
      });
      $(document).on('click', '.search-by-vin-number', function () {
        var formData = $("#search-by-vin-number").serialize();
        searchTrailer(formData);
      });
      $(document).on('click', '.search-by-tracking-id', function () {
        var formData = $("#search-by-tracking-id").serialize();
        searchTrailer(formData);
      });
      $(document).on('click', '.search-by-business-location', function () {
        var formData = $("#search-by-business-location").serialize();
        searchTrailer(formData);
      });
    });
</script> 
@endsection
