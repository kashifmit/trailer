<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sitemodel;
use App\User;
use Hash;
use Session;
use App\State;
use Mail;
use App\siteinvitation;
use Illuminate\Support\Facades\DB;
class Site extends Controller
{
    //
    public function insert_Site(Request $request)
    {

        $uid=Session::get('userId');
        $query1=DB::table('user')->join('org_invitation','user.email','org_invitation.Email')->where('userId',$uid)->get();

        foreach($query1 as $data)
        {
            $orgid=$data->orgId;
        } 
        
        $site=new Sitemodel();
        $org_name=$request->input('organization_name');
        $string=Hash::make($org_name);
        $result = str_replace('/','',$string);
        $result = str_replace('.','',$result);
        $result = str_replace('$','',$result);
        $result=stripslashes($result);
        $site->site_unique_id=$result;
        $site->SiteName=$request->input('site_name');
        $site->SteetNo=$request->input('street_no');
        $site->StreetName=$request->input('street_name');
        $site->SuiteNo=$request->input('suite_name');
        $site->City =$request->input('city');
        $site->StateAbbreviation=$request->input('state');
        $site->PostalCode=$request->input('postal_code');
        $site->OrganizationId=$orgid;
        $site->userId=$uid;
        $site->hide=1;
        $site->save();
        return redirect('/home1');
        $data=array(
            'site_name'=>$request->input('site_name'),
            'street_no'=>$request->input('street_no'),
            'street_name'=>$request->input('street_name'),
            'suite_name'=>$request->input('suite_name'),
            'city'=>$request->input('city'),
            'StateAbbreviation'=>$request->input('state'),
            'postal_code'=>$request->input('postal_code'),
            'UserId'=>$request->input('UserId'),
        );
        
    }
    public function Site()
    {
        $Organization=Sitemodel::all();
        //return $Organization;
        $query=DB::table('site')->where('userId',$id)->get();
                //return $query;
                Session::put('userId', $id);
        return view('site',['getData'=>$query]);
    }
    public function addSite()
    {
        $state=State::all();
        return view('addSite',['state'=>$state]);
    }
    public function addSiteInvite($SiteId)
    {
        $user1 = DB::table('site')->where('site_unique_id',$SiteId)->get();
        return view('addSiteInvite',['SiteId'=>$SiteId,'org'=>$user1]);
    }
    public function addSiteUser(Request $request)
    {
        $Orginvitation=new siteinvitation();
        $Orginvitation->SiteId=$request->input('orgId');
        $Orginvitation->Email=$request->input('userEmail');
        $Orginvitation->status=0;
        
        $email=$request->input('userEmail');
        $id=$request->input('orgId');
        $data=array(
            'Email'=>$email,
            'SiteId'=>$id,
            
        );
        $user = DB::table('site_invitation')->where($data)->get();
        $count=count($user);
        //return View('test',['data'=>$data]);
        /*if($count==0)
        {*/
            
            $Orginvitation->save();
            return redirect("/acceptSiteInvite"."/".$email."/".$id);
            /*Mail::send('test',['data'=>$id,'email'=>$email],function($message) use ($data){
                //return $message;
                $message->to($data['Email'])->subject('Invitation For Trailer Manager');
                //$message->from('ashish.mobilefirst@gmail.com','Ashishkumar');
            });
            echo "Basic Email Sent. Check your inbox."; 
            return back();
            */
            //exit();
                
            //return redirect('/Site');
            ///echo "<a href='localhost:8000/acceptSiteInvite/".$email."/".$id."' target='_blank'>Invite</a>";
            //echo "<script>alert('send mail');</script>";
            // exit();
        /*}
        else{
            return back()->with('error','All Ready Available');
        }*/
        
        
       
    }
    public function acceptSiteInvite($Email,$orgId)
    {
        $data=array(
            'Email'=>$Email,
            'SiteId'=>$orgId,
            
        );
        $user1 = DB::table('site')->where('site_unique_id',$orgId)->get();
        $user = DB::table('site_invitation')->where($data)->get();
        return view('addTeamManager1',['data'=>$user,'org'=>$user1]);
        

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
        $org_invitation=new siteinvitation();
        $data=array(
            'status'=>1,
        );
        $inviteId=$request->input('inviteId');
        //return $inviteId;
        
        $user->name=$request->input('name');
        $user->Role_id=3;
        $user->email=$request->input('email');
        $password=$request->input('password');
        $user->password=Hash::make($password);
        $user->save();
        $org_invitation::where('invitationId',$inviteId)->update($data);  
        
        return redirect('/login');

    }

    public function Deletesite($organizationId)
    {
        //return $organizationId;
        $data=array(
            'hide'=>0
        );
        $Organization=DB::table('site')->where('SiteId',$organizationId)->update($data);
        //$Organization=DB::table('site')->where('SiteId',$organizationId)->delete();
        return redirect('/home1');
    }

    public function Editesite($organizationId)
    {
        //return $organizationId;
        $Organization=DB::table('site')->where('SiteId',$organizationId)->get();
        return view('editSite',['data'=>$Organization]);
    }
    public function updateSite(Request $request)
    {
        
        $site_name=$request->input('site_name');
        $street_no=$request->input('street_no');
        $street_name=$request->input('street_name');
        $suite_name=$request->input('suite_name');
        $city=$request->input('city');
        $state=$request->input('state');
        $postal_code=$request->input('postal_code');
        $UserId=$request->input('UserId');
        $data=array(
            'SiteName'=>$site_name,
            'SteetNo'=>$street_no,
            'StreetName'=>$street_name,
            'SuiteNo'=>$suite_name,
            'City'=>$city,
            'StateAbbreviation'=>$state,
            'PostalCode'=>$postal_code
        );
        $Organization=DB::table('site')->where('SiteId',$UserId)->update($data);
        return redirect('/home1');
    }
    

}
