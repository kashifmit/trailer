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
        <header class="heading space-between mb-2">
            <h3 class="title">
                {{ __('Trailers') }}
            </h3>
            <a href="{{route('create.trailer')}}" class="btn btn-primary">
                Add Trailer
            </a>
        </header>

        <div class="content">
            <ul class="nav nav-tabs">
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
            <div class="row">&nbsp;</div>
            <div class="row">
              <div class="col-md-9">&nbsp;</div>
              <div class="col-md-3">
                <a href="{{route('edit.trailer', $data->TrailerSerialNo)}}" class="btn btn-primary">Edit</a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <strong style="font-size: 20px;">Trailer Record - {{$data->TrailerSerialNo}}</strong>
              </div>
            </div>
            <div class="tab-content">
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
@endsection
