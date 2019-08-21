<?php

namespace App\Http\Controllers;
use Hash;
use File;
use ImgUploader;
use Auth;
use DB;
use Input;
use Redirect;
use Carbon\Carbon;
use App\User;
use App\Helpers\DataArrayHelper;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use DataTables;

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
    public function index()
    {
        return view('home');
    }

    public function updateProfile(Request $request)
    {

        $validate = $request->validate([
            'name' => 'required',
        ]);
        if (!empty($request->input('password')) && ($request->input('password') != $request->input('c_password')) ) {
            flash('Password and confirm password must be same')->error();
            return Redirect::route('edit.profile');
        }
            
        try {
            $userdata = User::findOrFail(Auth::user()->id);
            $userdata->name = $request->input('name');
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

    public function usersList()
    {
        return view('users.list')->with('organizations', DataArrayHelper::getOrganizations())
        ->with('roles', DataArrayHelper::getRoles());
    }

    public function fetchUsers(Request $request)
    {
        $users = User::select([
                    'users.id',
                    'users.name',
                    'users.last_name',
                    'users.organization_id',
                    'users.email',
                    'users.Role_id',
        ]);
        return Datatables::of($users)
                ->filter(function ($query) use ($request) {
                    if ($request->has('name') && !empty($request->name)) {
                        $query->where('users.name', 'like', "%{$request->get('name')}%");
                    }
                    if ($request->has('last_name') && !empty($request->last_name)) {
                        $query->where('users.last_name', 'like', "%{$request->get('last_name')}%");
                    }
                    if ($request->has('organization') && !empty($request->organization)) {
                        $query->where('users.organization_id', 'like', "%{$request->get('organization')}%");
                    }
                    if ($request->has('email') && !empty($request->email)) {
                        $query->where('users.email', 'like', "%{$request->get('email')}%");
                    }
                    if ($request->has('role') && !empty($request->role)) {
                        $query->where('users.Role_id', 'like', "%{$request->get('role')}%");
                    }
                })
                ->addColumn('organization_id', function ($users) {
                    return $users->getOrganizationName('organizationName');
                })
                ->addColumn('Role_id', function ($users) {
                    return $users->getRoleName('Role_name');
                })
                ->addColumn('action', function ($users) {
                    
                    return '
        <div class="btn-group">
            <button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a href="' . route('edit.user', ['id' => $users->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                </li>
                
            </ul>
        </div>';                       
                // <li>
                //     <a href="javascript:void(0);" onclick="deleteUser(' . $users->id . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                // </li>
                })
                ->setRowId(function($users) {
                    return 'userDtRow' . $users->id;
                })
                ->make(true);
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
