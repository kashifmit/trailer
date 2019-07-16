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

Route::get('/','Controller@login');
Route::get('/Organization', 'Controller@Organization');
Route::get('/Deleteorg/{organizationId}', 'Controller@Deleteorg');
Route::get('/Editeorg/{organizationId}', 'Controller@Editeorg');
Route::post('/updateOrg', 'Controller@updateOrg');
Route::get('/addOrganization', function () {
    return view('addOrganization');
});

Route::post('/insert_dashboard','Controller@insert_dashboard');
Route::get('/login','Controller@Login');
Route::post('/checkUser','Controller@checkUser');
Route::post('/createUser','Controller@createUser');

Route::get('/addInvite/{organizationId}','Controller@addInvite');
Route::post('/addUser','Controller@addUser');
Route::get('acceptInvite/{Email}/{orgId}','Controller@acceptInvite');
Route::post('createTeamManager','Controller@createTeamManager');

Route::get('/home','Controller@home');
Route::get('/home1','Controller@home1');
Route::get('/home2','Controller@home2');
Route::get('/addSite','Site@addSite');
Route::post('/insert_Site','Site@insert_Site');
Route::get('/Site','Site@Site');
Route::get('/addSiteInvite/{SiteId}','Site@addSiteInvite');
Route::post('/addSiteUser','Site@addSiteUser');
Route::get('acceptSiteInvite/{Email}/{orgId}','Site@acceptSiteInvite');
Route::post('createTeamManager1','Site@createTeamManager');
Route::get('/Deletesite/{SiteId}', 'Site@Deletesite');
Route::get('/Editesite/{SiteId}', 'Site@Editesite');
Route::post('/updateSite', 'Site@updateSite');

Route::get('/Insert_trailerEquipment', 'TrailerManager@InsertEquipment');
Route::get('/Insert_tractorEquipment', 'TrailerManager@InsertEquipment1');
Route::post('/InsertEquipmentdetails', 'TrailerManager@InsertEquipmentdetails');
Route::get('/TrailerDetails', 'TrailerManager@TrailerDetails');
Route::get('/TractorDetails', 'TrailerManager@TractorDetails');
Route::get('/get_allEquipmentData/{TrailerDetailId}', 'TrailerManager@get_allEquipmentData');
Route::get('/editDetails_tractor/{Id}', 'TrailerManager@editDetails_tractor');
Route::get('/deleteDetails_tractor/{Id}', 'TrailerManager@deleteDetails_tractor');
Route::post('/tractroEditReg', 'TrailerManager@tractroEditReg');
Route::post('/tractor_EditInsdate', 'TrailerManager@tractor_EditInsdate');
Route::post('/tractor_EditSite', 'TrailerManager@tractor_EditSite');
Route::post('/TrailerEditReg', 'TrailerManager@TrailerEditReg');
Route::post('/Trailer_EditInsdate', 'TrailerManager@Trailer_EditInsdate');
Route::post('/Trailer_EditSite', 'TrailerManager@Trailer_EditSite');
Route::get('/deleteEquipment/{Id}', 'TrailerManager@deleteEquipment');
Route::get('/deleteEquipment1/{Id}', 'TrailerManager@deleteEquipment1');

Route::get('/getSitedata/{Id}', 'TrailerManager@getSitedata');


Route::get('/send', function()
    { Mail::send('test', ['name'=>'ashish','text'=>'hi'], function($message) 
        { $message->to('ashish.mobilefirst@gmail.com', 'Ashish'); 
            $message->subject('Welcome!'); 
            $message->from('ashish.mobilefirst@gmail.com','Ashishkumar'); 
        });
    });
