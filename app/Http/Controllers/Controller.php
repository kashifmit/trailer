<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Mail;
use App\Sitemodel;
use App\Orginvitation;
use App\Organization;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function Login()
    {
        return view('login');
    }

    public function createUser(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|alphaNum|min:6'
        ]);
        $user=new User();
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $password=$request->input('password');
        $user->password=Hash::make($password);
        $user->save();
        return redirect('/login');
    }
    public function Organization()
    {
        $Organization=Organization::all();
        //return $Organization;
        return view('Organization',['getData'=>$Organization]);
    }
    public function home()
    {
        $Organization=Organization::all();
        //return $Organization;
        return view('home',['getData'=>$Organization]);
    }
    public function home1()
    {
        $id=Session::get('userId');
        //return $id;
        $data=DB::table('user')->where('userId',$id)->get();
         //   return $data;
         $array=array(
             'userId'=>$id,
             'hide'=>1
         );
        $query=DB::table('site')->where($array)->get();
        //return $query;
        $count=count($query);
        if($count != 0)
        {
            foreach($query as $data)
            {
                $org_id=$data->OrganizationId;
            }
            $query1=DB::table('organization')->where('organizationId',$org_id)->get(); 
        }
        else{
            
            foreach($data as $data)
            {
                $email=$data->email;
            }
            //return $email; 
            $query1=DB::table('organization')->join('org_invitation','organization.organizationId','=','org_invitation.orgId')->where('org_invitation.Email',$email)->get();
            //return $query1;
        }   
        
        return view('site',['getData'=>$query,'org'=>$query1]);
        $Organization=Organization::all();
        //return $Organization;
        //return view('home1',['getData'=>$query]);
    }
    public function home2()
    {
        $uid=Session::get('userId');
        $data=DB::table('user')->join('site_invitation','user.email','=','site_invitation.Email')->join('site','site_invitation.SiteId','=','site.site_unique_id')->where('user.userId',$uid)->get();
        //$Organization=Organization::all();
        //return $data;
        return view('home2',['sitedata'=>$data]);
    }

    
    public function insert_dashboard(Request $request)
    {
        $Organization=new Organization();
        $org_name=$request->input('organization_name');
        $string=Hash::make($org_name);
        $result = str_replace('/','',$string);
        $result=stripslashes($result);
        $Organization->organizationId=$result;
        $Organization->userId=Session::get('userId');
        $Organization->organizationName=$request->input('organization_name');
        $Organization->save();
        return redirect('Organization');
        
        
    }
    
    public function checkUser(Request $request){
        $userEmail=$request->input('email');
        $user_data=array(
            'email'=>$request->input('email'),
            'password'=>$request->input('password')
        );
        //return $user_data;
        //$role_id=0;
        if(Auth::attempt($user_data))
        {
            $id = Auth::user()->userId;
            //return $id;
            $query=DB::table('user')->where('userId',$id)->get();
            //return $query;
            foreach($query as $query)
            {
                $role_id=$query->Role_id;
            }
            if($role_id==1)
            {
                Session::put('userId', $id);
                //return $id;
                return redirect('/home');
            }
            elseif($role_id==2)
            {
                //$query=DB::table('site')->where('userId',$id)->get();
                //return $query;
                //Session::put('userId', $id);//return $id;
                //return view('site',['getData'=>$query]);
                Session::put('userId', $id);
                //return $id;
                return redirect('/home1');
            }
            elseif($role_id==3)
            {
                Session::put('userId', $id);//return $id;
                return redirect('/home2');
            }
            
        }
        else{
            //return redirect('/login');
            return back()->with('error','wrnog credential');
        }
    }
    public function addInvite($organizationId)
    {
        return view('addInvite',['organizationId'=>$organizationId]);
    }
    public function addUser(Request $request)
    {
        $Orginvitation=new Orginvitation();
        $Orginvitation->orgId=$request->input('orgId');
        $Orginvitation->Email=$request->input('userEmail');
        $Orginvitation->status=0;
        
        $email=$request->input('userEmail');
        $id=$request->input('orgId');
        $data=array(
            'Email'=>$email,
            'orgId'=>$id,
            
        );
        $user = DB::table('org_invitation')->where($data)->get();
        $count=count($user);
        
        $Orginvitation->save();
        //return redirect("/acceptInvite"."/".$email."/".$id);
        //echo "<a href='localhost:8000/acceptInvite/".$email."/".$id."' target='_blank'>Invite</a>";
            Mail::send('sendOrg',['data'=>$id,'email'=>$email],function($message) use ($data){
                //return $message;
                $message->to($data['Email'])->subject('Invitation For Trailer Manager');
                //$message->from('ashish.mobilefirst@gmail.com','Ashishkumar');
            });
            //echo "Basic Email Sent. Check your inbox."; 
            return back();
        /*if($count==0)
        {
            $to_name = 'ashish';
            $to_email = 'ashish.mak96@gmail.com';
            $data = array('name'=>"Test", "body" => "Test mail");
    
            Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                        ->subject(' Web Testing Mail');
                $message->from('FROM_EMAIL_ADDRESS','Artisans Web');
            });
            $Orginvitation->save();
            //echo "<a href='localhost:8000/acceptInvite/".$email."/".$id."' target='_blank'>Invite</a>";
            //exit();
        }
        else{
            return back()->with('error','All Ready Available');
        }
        */
        
       
    }

    public function acceptInvite($Email,$orgId)
    {
        $data=array(
            'Email'=>$Email,
            'orgId'=>$orgId,
            
        );
        $user = DB::table('org_invitation')->where($data)->get();
        $user1 = DB::table('organization')->where('organizationId',$orgId)->get();
        
        return view('addTeamManager',['data'=>$user,'org'=>$user1]);
        

    }

    public function createTeamManager(Request $request)
    {
        //return "ok";
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email'
           
        ]);
        //return $request->input('email');
        $user=new User();
        $org_invitation=new Orginvitation();
        $data=array(
            'status'=>1,
        );
        $inviteId=$request->input('inviteId');
        //return $inviteId;
        
        $user->name=$request->input('name');
        $user->Role_id=2;
        $user->email=$request->input('email');
        $password=$request->input('password');
        $user->password=Hash::make($password);
        $user->save();
        $org_invitation::where('invitationId',$inviteId)->update($data);  
        
        return redirect('/login');

    }

    public function Deleteorg($organizationId)
    {
        $Organization=DB::table('organization')->where('organizationId',$organizationId)->delete();
        return redirect('Organization');
    }

    public function Editeorg($organizationId)
    {
        $Organization=DB::table('organization')->where('organizationId',$organizationId)->get();
        return view('editOrganization',['data'=>$Organization]);
    }
    public function updateOrg(Request $request)
    {
        $name=$request->input('organization_name');
        $id=$request->input('organizationId');
        $data=array(
            'organizationName'=>$name
        );
        $Organization=DB::table('organization')->where('organizationId',$id)->update($data);
        return redirect('Organization');
    }
    
}
