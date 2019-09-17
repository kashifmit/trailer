
@if(Route::currentRouteName() == 'trailer.list')
{!! Form::open(array('method' => 'get', 'route' => 'search.trailer.location', 'class' => 'form', 'files'=>true, 'id' => 'search_trailer_location')) !!}
<div class="trailer-contents">
    <header class="heading">
        <h3 class="title">Search For a Trailer</h3>
    </header>

    <div class="mb-5">
        <div class="form-group row">
            <label for="TrailerSerialNo" class="col-md-3 col-form-label text-md-right">{{ __('Trailer Number') }}</label>
            <div class="col-md-3">
                <div class="form-control-wrap">
                    {!! Form::select('TrailerNo', ['' => '--Select Trailer No--']+$getTrailers, null, array('class'=>'form-control selectable-box form-control-radius', 'id'=>'TrailerNo')) !!}
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="VehicleId_VIN" class="col-md-3 col-form-label text-md-right">{{ __('Tracking Unit Id') }}</label>
            <div class="col-md-3">
                <div class="form-control-wrap">
                    
                    {!! Form::select('TrailerUnitNo', ['' => '--Tracking Unit Id--']+$getTrackingUnits, null, array('class'=>'form-control form-control-radius selectable-box', 'id'=>'TrailerUnitNo')) !!}
                </div>
            </div>
        </div>

        <div class="form-group row mb-5">
        	<label for="VehicleId_VIN" class="col-md-3 col-form-label text-md-right">{{ __('Location Name') }}</label>
            <div class="col-md-3">
            	 {!! Form::select('SiteId', ['' => '--All Locations--']+$locations, null, array('class'=>'form-control form-control-radius selectable-box', 'id'=>'SiteId')) !!}
            </div>
        </div>
    </div>

    <header class="heading">
        <h3 class="title">Select Query Type:</h3>
    </header>

    <h5 class="mb-3">Show Latest Position</h5>

    <div class="form-controls">
    	{!! Form::button('Display Map', array('class'=>'btn display-map btn-min-md btn-primary submit-class', 'type'=>'button', 'id' => 'display-map')) !!}

    	{!! Form::button('Display Table', array('class'=>'btn display-table btn-min-md btn-primary submit-class', 'type'=>'button', 'id' => 'display-table')) !!}
    </div>
</div>
{!! Form::close() !!}
@endif

<div class="row justify-content-md-center">
    <div class="col-md-10">
        <div class="map-block"  id="map-block">
            {!! Mapper::render() !!}
        </div>
    </div>
</div>

<div id="trailer_locaton_table">
    @include('trailers.forms.includes.location_table')
</div>

