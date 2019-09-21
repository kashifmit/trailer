<div class="trailer-contents">
    
    <header class="heading">
        <h3 class="title">Search For a Trailer</h3>
    </header>

    <div class="mb-5">
        {!! Form::open(array('method' => 'GET', 'route' => 'trailer.list', 'class' => 'form', 'files'=>true, 'id' => 'search-by-trailer-number')) !!}
        <div class="form-group row mb-0">
            <label for="TrailerSerialNo" class="col-md-3 col-form-label text-md-right">{{ __('Enter Trailer Number') }}</label>
            <div class="col-md-3">
                <div class="form-control-wrap search">
                    <input type="text" class="form-control form-control-radius" name="TrailerSerialNo" id="TrailerSerialNo" autocomplete="off" placeholder="Trailer Number" value="{{\Request::get('TrailerSerialNo')}}">
                </div>
            </div>
            <div class="col-md-3">
                {!! Form::button('Find', array('class'=>'search-by-trailer-number btn btn-min-md btn-primary', 'type'=> Route::currentRouteName() == 'trailer.list' ? 'submit' : 'button')) !!}
            </div>
        </div>
        {!! Form::hidden('search', 'search') !!}
        {!! Form::close() !!}
        <div class="mt-4 mb-4">Or</div>
        {!! Form::open(array('method' => 'GET', 'route' => 'trailer.list', 'class' => 'form', 'files'=>true, 'id' => 'search-by-vin-number')) !!}
        <div class="form-group row mb-0">
            <label for="VehicleId_VIN" class="col-md-3 col-form-label text-md-right">{{ __('Enter VIN Number') }}</label>
            <div class="col-md-3">
                <div class="form-control-wrap search">
                    <input type="text" class="form-control form-control-radius" name="VehicleId_VIN" id="VehicleId_VIN" autocomplete="off" placeholder="VIN Number" value="{{\Request::get('VehicleId_VIN')}}">
                </div>
            </div>
            <div class="col-md-3">
            {!! Form::button('Find', array('class'=>'search-by-vin-number btn btn-min-md btn-primary', 'type'=> Route::currentRouteName() == 'trailer.list' ? 'submit' : 'button')) !!}
            </div>
        </div>
        {!! Form::hidden('search', 'search') !!}
        {!! Form::close() !!}
        <div class="mt-4 mb-4">Or</div>
        {!! Form::open(array('method' => 'GET', 'route' => 'trailer.list', 'class' => 'form', 'files'=>true, 'id' => 'search-by-tracking-id')) !!}
        <div class="form-group row mb-0">
            <label for="TrackingId" class="col-md-3 col-form-label text-md-right">{{ __('Tracking Number') }}</label>
            <div class="col-md-3">
                <div class="form-control-wrap search">
                    <input type="text" class="form-control form-control-radius" name="TrackingId" id="TrackingId" autocomplete="off" placeholder="Tracking Number" value="{{\Request::get('TrackingId')}}">
                </div>
            </div>
            <div class="col-md-3">
            {!! Form::button('Find', array('class'=>'search-by-tracking-id btn btn-min-md btn-primary', 'type'=> Route::currentRouteName() == 'trailer.list' ? 'submit' : 'button')) !!}
            </div>
        </div>
        {!! Form::hidden('search', 'search') !!}
        {!! Form::close() !!}
        <header class="heading mt-5">
            <h3 class="title">Search For a Trailer by Location & Business</h3>
        </header>
        {!! Form::open(array('method' => 'GET', 'route' => 'trailer.list', 'class' => 'form', 'files'=>true, 'id' => 'search-trailer')) !!}
        <div class="form-group row mb-5">
            <div class="col-md-4">
                {!! Form::select('business', ['' => '--All business System--']+$business, \Request::get('business') ? \Request::get('business') : null, array('class'=>'form-control form-control-radius', 'id'=>'business')) !!}
            </div>
            <div class="col-md-4">
                {!! Form::select('SiteId', ['' => '--All Locations--']+$locations, \Request::get('SiteId') ? \Request::get('SiteId') : null, array('class'=>'form-control form-control-radius', 'id'=>'SiteId')) !!}
            </div>
            <div class="col-md-4">
                {!! Form::button('Find', array('class'=>'search-by-business-location btn btn-min-md btn-primary', 'type'=> Route::currentRouteName() == 'trailer.list' ? 'submit' : 'button')) !!}
            </div>
        </div>
        {!! Form::hidden('search', 'search') !!}
        {!! Form::close() !!}
    </div>
    <input type="hidden" name="search" value="search">
        <span id="home_data_table">
            @include('trailers.forms.includes.home_data_table')
        </span>
</div>