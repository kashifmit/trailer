<input type="hidden" id="enable_document" value="search_documents">
<header class="heading mb-0">
    <h3 class="title">Search For Documents By Trailer</h3>
</header>
<div class="trailer-contents">
{!! Form::open(array('method' => 'get', 'route' => 'search.trailer.docs', 'class' => 'form', 'files'=>true, 'id' => 'search_trailer_docs')) !!}
    <div class="mb-5">
        <div class="form-group row mb-0">
            <label for="TrailerSerialNo" class="col-xl-3 col-form-label text-xl-right">{{ __('Enter Trailer Number') }}</label>
            <div class="col-md-6 col-lg-5 col-xl-3">
                <div class="form-control-wrap search">
                    <input type="text" class="form-control form-control-radius mb-2 mb-md-0" name="TrailerSerialNo" id="TrailerSerialNo_docs" autocomplete="off" placeholder="Trailer Number">
                </div>
            </div>
            <div class="col-md-6 col-lg-5 col-xl-3">
                <input type="button" value="Find" class="find-docs btn btn-min-md btn-primary">
            </div>
        </div>

        <div class="mt-4 mb-4">Or</div>

        <div class="form-group row mb-0">
            <label for="VehicleId_VIN" class="col-xl-3 col-form-label text-xl-right">{{ __('Enter VIN Number') }}</label>
            <div class="col-md-6 col-lg-5 col-xl-3">
                <div class="form-control-wrap search">
                    <input type="text" class="form-control form-control-radius mb-2 mb-md-0" name="VehicleId_VIN" id="VehicleId_VIN_docs" autocomplete="off" placeholder="VIN Number">
                </div>
            </div>
            <div class="col-md-6 col-lg-5 col-xl-3">
                <input type="button" value="Find" class="find-docs btn btn-min-md btn-primary">
            </div>
        </div>

        <div class="mt-4 mb-4">Or</div>

        <div class="form-group row mb-0">
            <label for="TrackingId" class="col-xl-3 col-form-label text-xl-right">{{ __('Tracking Number') }}</label>
            <div class="col-md-6 col-lg-5 col-xl-3">
                <div class="form-control-wrap search">
                    <input type="text" class="form-control form-control-radius mb-2 mb-md-0" name="TrackingId" id="TrackingId_docs" autocomplete="off" placeholder="Tracking Number">
                </div>
            </div>
            <div class="col-md-6 col-lg-5 col-xl-3">
                <input type="button" value="Find" class="find-docs btn btn-min-md btn-primary">
            </div>
        </div>

    </div>
{!! Form::close() !!}
        <span id="search_docs_data"></span>
</div>