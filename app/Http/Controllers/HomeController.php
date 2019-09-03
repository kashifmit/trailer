<?php

namespace App\Http\Controllers;
use Hash;
use File;
use ImgUploader;
use Auth;
use DB;
use Input;
use Redirect;
use Mapper;
use Carbon\Carbon;
use App\User;
use App\EquipmentModel;
use App\TrailerRentedViaModel;
use App\RentalModel;
use App\Helpers\DataArrayHelper;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $allData = DataArrayHelper::getfinancials('', $request);
        
        $mapData = DataArrayHelper::trailerTracking();
        if (count($mapData)) {
            Mapper::map($mapData[0]->Latitude, $mapData[0]->Longitude, ['marker' => false]);
            foreach ($mapData as $key => $value) {
                Mapper::marker($value->Latitude, $value->Longitude, ['symbol' => 'marker', 'scale' => 1000]);
            }    
        } else {
            Mapper::map(38.19788, -85.87415);
        }
        return view('home')
        ->with('allData', $allData)
        ->with('locations', DataArrayHelper::getSites())
        ->with('business', DataArrayHelper::businessList());
    }

    public function updateProfile(Request $request)
    {

        $validate = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'organization' => 'required',
            'role' => 'required',
        ]);
        if (!empty($request->input('password')) && ($request->input('password') != $request->input('c_password')) ) {
            flash('Password and confirm password must be same')->error();
            return Redirect::route('edit.profile');
        }
            
        try {
            $userdata = User::findOrFail(Auth::user()->id);
            $userdata->name = $request->input('name');
            $userdata->last_name = $request->input('last_name');
            $userdata->organization_id = $request->input('organization');
            $userdata->Role_id = $request->input('role');
            if (!empty($request->input('password'))) {
                $userdata->password = Hash::make($request->input('password'));
            }
            $userdata->save();
            flash('Profile Updated Successfully')->success();
            return Redirect::route('edit.profile');
        } catch(QueryException $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function createUser()
    {
        return view('users.add')
        ->with('organizations', DataArrayHelper::getOrganizations())
        ->with('roles', DataArrayHelper::getRoles());
    }

    public function storeUser(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'email' => 'required|email|unique:users',
            'organization' => 'required',
            'role' => 'required',
        ]);
        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->last_name = $request->input('last_name');
            $user->password = Hash::make($request->input('password'));
            $user->email = $request->input('email');
            $user->organization_id = $request->input('organization');
            $user->Role_id = $request->input('role');
            $user->save();
            flash('User has been created successfully!')->success();
            return Redirect::route('create.user');
        } catch(QueryException $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function usersList(Request $request)
    {
        $data = User::with(['organizations', 'roles']);

        if (!empty($request->query('name'))) {
              $data = $data->where('name','like', "%{$request->query('name')}%");
            }
        if (!empty($request->query('last_name'))) {
              $data = $data->where('last_name','like', "%{$request->query('last_name')}%");
            }
        if (!empty($request->query('email'))) {
              $data = $data->where('email','like', "%{$request->query('email')}%");
            }
        if (!empty($request->query('organization'))) {
              $data = $data->where('organization_id','like', "%{$request->query('organization')}%");
            }
        if (!empty($request->query('role'))) {
              $data = $data->where('Role_id','like', "%{$request->query('role')}%");
            }                
        $data = $data->paginate(20);
        return view('users.list')
        ->with('Alldata', $data)
        ->with('organizations', DataArrayHelper::getOrganizations())
        ->with('roles', DataArrayHelper::getRoles());
    }

    public function editUser($id)
    {
        $userData = User::findOrFail($id);
        return view('users.edit')
        ->with('data', $userData)
        ->with('organizations', DataArrayHelper::getOrganizations())
        ->with('roles', DataArrayHelper::getRoles());
    }

    public function updateUser($id, Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'organization' => 'required',
            'role' => 'required',
        ]);
        try {
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->last_name = $request->input('last_name');
            $user->password = Hash::make($request->input('password'));
            $user->organization_id = $request->input('organization');
            $user->Role_id = $request->input('role');
            $user->save();
            flash('User has been updated successfully!')->success();
            return Redirect::route('edit.user', $id);
        } catch(QueryException $e) {
            return back()->withError($e->getMessage());
        }
    }
}
