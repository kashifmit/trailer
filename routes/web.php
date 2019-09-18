<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	/**
	*	organization routes
	**/
	Route::get('/add-organization', 'OrganizationController@addOrganization')->name('add.organization');
	Route::post('/store-organization', 'OrganizationController@storeOrganization')->name('store.organization');
	Route::get('/organization-list', 'OrganizationController@index')->name('organization.list');
	Route::get('/fetch-organization-list', 'OrganizationController@fetchOrganization')->name('fetch.organization.list');
	Route::get('edit-organization/{id}', 'OrganizationController@editOrganization')->name('edit.organization');
	Route::put('update-organization/{id}', 'OrganizationController@updateOrganization')->name('update.organization');
	Route::post('delete-organization', 'OrganizationController@deleteOrganization')->name('delete.organization');
	/**
	*	Model Year routes
	**/
	Route::get('/add-model', 'ModelYearController@addOrModel')->name('add.model');
	Route::post('/store-model', 'ModelYearController@storeModel')->name('store.model');
	Route::get('/model-years', 'ModelYearController@index')->name('model.years');
	Route::get('/fetch-model-years', 'ModelYearController@fetchModelYears')->name('fetch.model.years');
	Route::get('edit-model-year/{ModelYear}', 'ModelYearController@editModel')->name('edit.model.year');
	Route::put('update-model/{model_year}', 'OrganizationController@updatemodel')->name('update.model');
	Route::post('delete-model', 'OrganizationController@deleteModel')->name('delete.model');
	/**
	*	Manufacturers routes
	**/
	Route::get('/manufacturer-list', 'ManufacturerController@index')->name('manufacturer.list');
	Route::get('/fetch-manufacturers', 'ManufacturerController@fetchmanfacturers')->name('fetch.manufacturers');
	Route::get('/add-manufacturer', 'ManufacturerController@addManufacturer')->name('add.manufacturer');
	Route::post('/store-manufacturer', 'ManufacturerController@storeManufacturer')->name('store.manufacturer');
	Route::get('/edit-manufacturer/{ManufacturerId}', 'ManufacturerController@editManufacturer')->name('edit.manufacturer');
	Route::put('update-manufacturer/{ManufacturerId}', 'ManufacturerController@updatemanufacturer')->name('update.manufacturer');
	Route::post('delete-manufacturer', 'OrganizationController@deleteManufacturer')->name('delete.manufacturer');
	/**
	*	Conditions status routes
	**/
	Route::get('/condition-list', 'ConditionController@index')->name('condition.list');
	Route::get('/fetch-conditions', 'ConditionController@fetchConditions')->name('fetch.conditions');
	Route::get('/add-condition', 'ConditionController@addCondition')->name('add.condition');
	Route::post('/store-condition', 'ConditionController@storeCondition')->name('store.condition');
	Route::get('/edit-condtion/{ConditionStatusId}', 'ConditionController@editCondtion')->name('edit.condtion');
	Route::put('update-condition/{ConditionStatusId}', 'ConditionController@updateCondition')->name('update.condition');
	Route::post('delete-condition', 'OrganizationController@deleteCondition')->name('delete.condition');
	
	/**
	*	State routes
	**/
	Route::get('/state-list', 'StateController@index')->name('state.list');
	Route::get('/fetch-states', 'StateController@fetchStates')->name('fetch.states');
	Route::get('/add-state', 'StateController@addState')->name('add.state');
	Route::post('/store-state', 'StateController@storeState')->name('store.state');
	Route::get('/edit-state/{StateAbbreviation}', 'StateController@editState')->name('edit.state');
	Route::put('update-state/{StateAbbreviation}', 'StateController@updateState')->name('update.state');
	Route::post('delete-state', 'StateController@deleteState')->name('delete.state');
	/**
	*	Site routes
	**/
	Route::get('/site-list', 'SiteController@index')->name('site.list');
	Route::get('/fetch-site-list', 'SiteController@fetchSite')->name('fetch.site.list');
	Route::get('/edit-site/{id}', 'SiteController@editSite')->name('edit.site');
	/**
	*	User routes
	**/
	Route::get('/view-profile', function () {
		return view('users.index');
	})->name('view.profile');
	Route::get('/edit-profile', function() {
		return view('users.update_profile');
	})->name('edit.profile');
	Route::put('/update-profile', 'HomeController@updateProfile')->name('update.profile');
	Route::put('/update-email', 'HomeController@updateEmail')->name('update.email');
	Route::put('/update-personal-info', 'HomeController@updateInfo')->name('update.personal.info');
	Route::put('/update-password', 'HomeController@updatePassword')->name('update.password');
	Route::get('/users-list', 'HomeController@usersList')->name('users.list');
	Route::get('create-user', 'HomeController@createUser')->name('create.user');
	Route::post('store-user', 'HomeController@storeUser')->name('store.user');
	Route::get('edit-user/{id}', 'HomeController@editUser')->name('edit.user');
	Route::put('update-user/{id}', 'HomeController@updateUser')->name('update.user');
	/**
	*	Size routes
	**/
	Route::get('/size-list', 'SizeController@index')->name('size.list');
	Route::get('/fetch-sizes', 'SizeController@fetchSizes')->name('fetch.sizes');
	Route::get('/create-size', 'SizeController@createSize')->name('create.size');
	Route::post('/store-size', 'SizeController@storeSize')->name('store.size');
	Route::get('/edit-size/{}', 'SizeController@storeSize')->name('store.size');
	/**
	*	Trailer Routes
	**/
	Route::get('/trailers-list', 'TrailerController@index')->name('trailer.list');
	Route::get('/trailer-data', 'TrailerController@trailerData')->name('trailer.data');
	Route::get('/create-trailor', 'TrailerController@createtriler')->name('create.trailer');
	Route::post('/store-trailor', 'TrailerController@storetriler')->name('store.trailer');
	Route::get('/edit-trailor/{TrailerSerialNo}', 'TrailerController@editTrailer')->name('edit.trailer');
	Route::put('update-trailer/{TrailerSerialNo}', 'TrailerController@updateTrailer')->name('update.trailer');
	Route::get('download-file/{id}', 'TrailerController@dowLoadFile')->name('download.file');
	Route::post('/trailer-owners', 'TrailerController@trailerOwners')->name('trailer.owners');
	Route::get('/trailer-financials', 'TrailerController@trailerfinancilas')->name('trailer.financilas');
	Route::get('/view-trailor/{TrailerSerialNo}', 'TrailerController@viewTrailer')->name('view.trailer');
	Route::post('/download-trailer-location-csv', 'TrailerController@downloadTrailerLocationCsv')->name('download.trailer.location.csv');
	Route::get('/search-trailer-location', 'TrailerController@searchTrailerLocation')->name('search.trailer.location');
	Route::get('/trailer-location-table', 'TrailerController@trailerLocationTable')->name('trailer.location.table');
	Route::get('/search-trailer-docs', 'TrailerController@searchTrailerDocs')->name('search.trailer.docs');
	/**
	*	Inovices Routes
	**/
	Route::get('/invoice-list', 'InvoiceController@index')->name('invoice.list');
	Route::get('/create-invoice', 'InvoiceController@createInvoice')->name('create.invoice');
	Route::post('/store-invoice', 'InvoiceController@storeInvoice')->name('store.invoice');
	Route::post('/trailer-vendor', 'InvoiceController@trailerVendor')->name('trailer.vendor');
	Route::get('/edit-invoice/{InvoiceNo}', 'InvoiceController@getInovice')->name('edit.invoice');
	Route::put('/update-invoice/{InvoiceNo}', 'InvoiceController@updateInvoice')->name('update.invoice');
	Route::get('/invoice-success/{InvoiceNo}/{TrailerSerialNo}', 'InvoiceController@invoiceSuccess')->name('invoice.success');
	Route::get('/add-line-item/{InvoiceNo}', 'InvoiceController@addLineItem')->name('add.line.item');
	Route::get('/create-line-item/{InvoiceNo}', 'InvoiceController@createLineItem')->name('create.line.item');
	Route::post('store-inline-item/{InvoiceNo}', 'InvoiceController@storeInlineInvoiceItem')->name('store.inline.item');
	Route::get('export-headCSV', 'InvoiceController@exportHeadCSV')->name('export.headCSV');
	Route::get('export-lineCSV', 'InvoiceController@exportLineCSV')->name('export.lineCSV');
	Route::get('/edit-invoice-line/{InvoiceNo}', 'InvoiceController@editInvoiceLine')->name('edit.invoice.line');
	Route::put('update-invoice-line/{InvoiceNo}', 'InvoiceController@updateInvoiceLine')->name('update.invoice.line');
	/**
	*	Customer Routes
	**/
	Route::get('/customers-list', 'CustomerController@index')->name('customer.list');
	Route::get('/export-customers', 'CustomerController@exportCustomer')->name('export.customers');
	Route::get('/export-DTA', 'CustomerController@exportDTA')->name('export.dta');

});

