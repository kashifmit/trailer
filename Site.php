<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sitemodel;
use App\User;
use Mail;
use Hash;
use App\siteInvitation;
use Illuminate\Support\Facades\DB;
class Site extends Controller
{
    //
    public function insert_Site(Request $request)
    {
        $site=new Sitemodel();
        $org_name=$request->input('organization_name');
        $string=Hash::make($org_name);
        $result = str_replace('/','',$string);
        $result=stripslashes($result);
        $site->SiteId=$result;
        $site->SiteName=$request->input('site_name');
        $site->SteetNo=$request->input('street_no');
        $site->StreetName=$request->input('street_name');
        $site->SuiteNo=$request->input('suite_name');
        $site->City =$request->input('city');
        $site->State=$request->input('state');
        $site->PostalCode=$request->input('postal_code');
        $site->OrganizationId=$request->input('UserId');
        $site->save();
        return redirect('/Site');
        $data=array(
            'site_name'=>$request->input('site_name'),
            'street_no'=>$request->input('street_no'),
            'street_name'=>$request->input('street_name'),
            'suite_name'=>$request->input('suite_name'),
            'city'=>$request->input('city'),
            'state'=>$request->input('state'),
            'postal_code'=>$request->input('postal_code'),
            'UserId'=>$request->input('UserId'),
        );
        
    }
    public function Site()
    {
        $Organization=Sitemodel::all();
        //return $Organization;
        return view('site',['getData'=>$Organization]);
    }
    public function addSiteInvite($SiteId)
    {
        return view('addSiteInvite',['SiteId'=>$SiteId]);
    }
    public function addSiteUser(Request $request)
    {
        $Orginvitation=new siteInvitation();
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
        
/*        if($count==0)
        {
            $Orginvitation->save();
            echo "<a href='localhost:8000/acceptSiteInvite/".$email."/".$id."' target='_blank'>Invite</a>";
            exit();
        }
        else{
            return back()->with('error','All Ready Available');
        }*/
	$Orginvitation->save();
        $data=array('name'=>'Ashish','body'=>'Tets mail'); 
	   Mail::send('site',$data,function($message){
                $message->to('ashish.mobilefirst@gmail.com','To ashish')->subject('Test Email');
                $message->from('ashish.mobilefirst@gmail.com','Ashishkumar');
            });
            return redirect('/Site');
        
        
       
    }
    public function acceptSiteInvite($Email,$orgId)
    {
        $data=array(
            'Email'=>$Email,
            'SiteId'=>$orgId,
            
        );
        $user = DB::table('site_invitation')->where($data)->get();
        return view('addTeamManager1',['data'=>$user]);
        

    }
    public function createTeamManager(Request $request)
    {
        //return "ok";
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|alphaNum|min:6'
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
        $Organization=DB::table('site')->where('SiteId',$organizationId)->delete();
        return redirect('/Site');
    }

    public function Editesite($organizationId)
    {
        return $organizationId;
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
            'State'=>$state,
            'PostalCode'=>$postal_code
        );
        $Organization=DB::table('site')->where('SiteId',$UserId)->update($data);
        return redirect('Site');
    }
    

}
