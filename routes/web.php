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

Route::get('user-verification/{token}', 'HomeController@verifyUSer')->name('user.verification');

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
	Route::get('not-allowed', 'HomeController@waitingForApproval')->name('not.allowed');
	Route::get('/home', 'HomeController@index')->middleware('IsUserVerified')->name('home');
	/**
	*	organization routes
	**/
	Route::get('/add-organization', 'OrganizationController@addOrganization')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('add.organization');
	Route::post('/store-organization', 'OrganizationController@storeOrganization')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('store.organization');
	Route::get('/organization-list', 'OrganizationController@index')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('organization.list');
	Route::get('/fetch-organization-list', 'OrganizationController@fetchOrganization')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('fetch.organization.list');
	Route::get('edit-organization/{id}', 'OrganizationController@editOrganization')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('edit.organization');
	Route::put('update-organization/{id}', 'OrganizationController@updateOrganization')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('update.organization');
	Route::post('delete-organization', 'OrganizationController@deleteOrganization')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('delete.organization');
	/**
	*	Model Year routes
	**/
	Route::get('/add-model', 'ModelYearController@addOrModel')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('add.model');
	Route::post('/store-model', 'ModelYearController@storeModel')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('store.model');
	Route::get('/model-years', 'ModelYearController@index')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('model.years');
	Route::get('/fetch-model-years', 'ModelYearController@fetchModelYears')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('fetch.model.years');
	Route::get('edit-model-year/{ModelYear}', 'ModelYearController@editModel')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('edit.model.year');
	Route::put('update-model/{model_year}', 'OrganizationController@updatemodel')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('update.model');
	Route::post('delete-model', 'OrganizationController@deleteModel')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('delete.model');
	/**
	*	Manufacturers routes
	**/
	Route::get('/manufacturer-list', 'ManufacturerController@index')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('manufacturer.list');
	Route::get('/fetch-manufacturers', 'ManufacturerController@fetchmanfacturers')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('fetch.manufacturers');
	Route::get('/add-manufacturer', 'ManufacturerController@addManufacturer')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('add.manufacturer');
	Route::post('/store-manufacturer', 'ManufacturerController@storeManufacturer')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('store.manufacturer');
	Route::get('/edit-manufacturer/{ManufacturerId}', 'ManufacturerController@editManufacturer')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('edit.manufacturer');
	Route::put('update-manufacturer/{ManufacturerId}', 'ManufacturerController@updatemanufacturer')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('update.manufacturer');
	Route::post('delete-manufacturer', 'OrganizationController@deleteManufacturer')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('delete.manufacturer');
	/**
	*	Conditions status routes
	**/
	Route::get('/condition-list', 'ConditionController@index')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('condition.list');
	Route::get('/fetch-conditions', 'ConditionController@fetchConditions')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('fetch.conditions');
	Route::get('/add-condition', 'ConditionController@addCondition')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('add.condition');
	Route::post('/store-condition', 'ConditionController@storeCondition')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('store.condition');
	Route::get('/edit-condtion/{ConditionStatusId}', 'ConditionController@editCondtion')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('edit.condtion');
	Route::put('update-condition/{ConditionStatusId}', 'ConditionController@updateCondition')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('update.condition');
	Route::post('delete-condition', 'OrganizationController@deleteCondition')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('delete.condition');
	
	/**
	*	State routes
	**/
	Route::get('/state-list', 'StateController@index')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('state.list');
	Route::get('/fetch-states', 'StateController@fetchStates')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('fetch.states');
	Route::get('/add-state', 'StateController@addState')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('add.state');
	Route::post('/store-state', 'StateController@storeState')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('store.state');
	Route::get('/edit-state/{StateAbbreviation}', 'StateController@editState')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('edit.state');
	Route::put('update-state/{StateAbbreviation}', 'StateController@updateState')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('update.state');
	Route::post('delete-state', 'StateController@deleteState')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('delete.state');
	/**
	*	Site routes
	**/
	Route::get('/site-list', 'SiteController@index')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('site.list');
	Route::get('/fetch-site-list', 'SiteController@fetchSite')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('fetch.site.list');
	Route::get('/edit-site/{id}', 'SiteController@editSite')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('edit.site');
	/**
	*	User routes
	**/
	Route::get('/view-profile', function () {
		return view('users.index');
	})->middleware('IsUserVerified')->middleware('IsUserVerified')->name('view.profile');
	Route::get('/edit-profile', function() {
		return view('users.update_profile');
	})->middleware('IsUserVerified')->middleware('IsUserVerified')->name('edit.profile');
	Route::put('/update-profile', 'HomeController@updateProfile')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('update.profile');
	Route::put('/update-email', 'HomeController@updateEmail')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('update.email');
	Route::put('/update-personal-info', 'HomeController@updateInfo')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('update.personal.info');
	Route::put('/update-password', 'HomeController@updatePassword')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('update.password');
	Route::get('/users-list', 'HomeController@usersList')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('users.list');
	Route::get('create-user', 'HomeController@createUser')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('create.user');
	Route::post('store-user', 'HomeController@storeUser')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('store.user');
	Route::get('edit-user/{id}', 'HomeController@editUser')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('edit.user');
	Route::put('update-user/{id}', 'HomeController@updateUser')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('update.user');
	/**
	*	Size routes
	**/
	Route::get('/size-list', 'SizeController@index')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('size.list');
	Route::get('/fetch-sizes', 'SizeController@fetchSizes')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('fetch.sizes');
	Route::get('/create-size', 'SizeController@createSize')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('create.size');
	Route::post('/store-size', 'SizeController@storeSize')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('store.size');
	Route::get('/edit-size/{}', 'SizeController@storeSize')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('store.size');
	/**
	*	Trailer Routes
	**/
	Route::get('/trailers-list', 'TrailerController@index')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('trailer.list');
	Route::get('/trailer-data', 'TrailerController@trailerData')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('trailer.data');
	Route::get('/create-trailor', 'TrailerController@createtriler')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('create.trailer');
	Route::post('/store-trailor', 'TrailerController@storetriler')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('store.trailer');
	Route::get('/edit-trailor/{TrailerSerialNo}', 'TrailerController@editTrailer')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('edit.trailer');
	Route::put('update-trailer/{TrailerSerialNo}', 'TrailerController@updateTrailer')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('update.trailer');
	Route::get('download-file/{id}', 'TrailerController@downLoadFile')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('download.file');
	Route::get('download-zip', 'TrailerController@downLoadZip')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('download.zip');
	Route::post('/trailer-owners', 'TrailerController@trailerOwners')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('trailer.owners');
	Route::get('/trailer-financials', 'TrailerController@trailerfinancilas')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('trailer.financilas');
	Route::get('/view-trailor/{TrailerSerialNo}', 'TrailerController@viewTrailer')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('view.trailer');
	Route::post('/download-trailer-location-csv', 'TrailerController@downloadTrailerLocationCsv')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('download.trailer.location.csv');
	Route::get('/search-trailer-location', 'TrailerController@searchTrailerLocation')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('search.trailer.location');
	Route::get('/trailer-location-table', 'TrailerController@trailerLocationTable')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('trailer.location.table');
	Route::get('/search-trailer-docs', 'TrailerController@searchTrailerDocs')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('search.trailer.docs');
	Route::get('/download-all-docs', 'TrailerController@downAllDocs')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('download.all.docs');
	Route::get('/search-docs-form', 'TrailerController@searchDocsForm')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('search.docs.form');
	Route::get('/upload-all-docs', 'TrailerController@uploadAllDocs')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('upload.all.docs');
	Route::post('/upload-documents', 'TrailerController@uploadNewDocuments')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('upload.documents');
	/**
	*	Inovices Routes
	**/
	Route::get('/invoice-list', 'InvoiceController@index')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('invoice.list');
	Route::get('/create-invoice/{id?}', 'InvoiceController@createInvoice')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('create.invoice');
	Route::post('/store-invoice', 'InvoiceController@storeInvoice')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('store.invoice');
	Route::post('/trailer-vendor', 'InvoiceController@trailerVendor')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('trailer.vendor');
	Route::get('/edit-invoice/{InvoiceNo}', 'InvoiceController@getInovice')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('edit.invoice');
	Route::put('/update-invoice/{InvoiceNo}', 'InvoiceController@updateInvoice')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('update.invoice');
	Route::get('/invoice-success/{InvoiceNo}/{TrailerSerialNo}', 'InvoiceController@invoiceSuccess')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('invoice.success');
	Route::get('/add-line-item/{InvoiceNo}', 'InvoiceController@addLineItem')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('add.line.item');
	Route::get('/create-line-item/{InvoiceNo}', 'InvoiceController@createLineItem')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('create.line.item');
	Route::post('store-inline-item/{InvoiceNo}', 'InvoiceController@storeInlineInvoiceItem')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('store.inline.item');
	Route::get('export-headCSV/{invoiceIds}', 'InvoiceController@exportHeadCSV')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('export.headCSV');
	Route::get('export-lineCSV/{invoiceIds}', 'InvoiceController@exportLineCSV')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('export.lineCSV');
	Route::get('/edit-invoice-line/{InvoiceNo}', 'InvoiceController@editInvoiceLine')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('edit.invoice.line');
	Route::put('update-invoice-line/{InvoiceNo}', 'InvoiceController@updateInvoiceLine')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('update.invoice.line');
	Route::get('download-invoice-file/{id}', 'InvoiceController@downLoadInvoiceFile')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('download.invoice.file');
	/**
	*	Customer Routes
	**/
	Route::get('/customers-list', 'CustomerController@index')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('customer.list');
	Route::get('/export-customers', 'CustomerController@exportCustomer')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('export.customers');
	Route::get('/export-DTA', 'CustomerController@exportDTA')->middleware('IsUserVerified')->middleware('IsUserVerified')->name('export.dta');

});

