<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Sitemodel;
use App\User;
use Session;
use App\State;
use App\ModelYear;
use App\Suspension;
use App\ConditionStatus;
use App\Manufacturer;
use App\TrailerCategory;
use App\TrailerType;
use App\Registration;
use App\TrailerDetails;
use App\TractorManufacture;
use App\TractorType;
use App\Tractor;
use App\TractorDetails;
use App\Equipment;
use Hash;
use App\siteinvitation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;


class TrailerManager extends Controller
{
    //
    public function InsertEquipment()
    {
        $cate=TrailerCategory::all();
        $type=TrailerType::all();
        $type1=TractorType::all();
        $t_manu=TractorManufacture::all();
        $suspension=Suspension::all();
        $manufacture=Manufacturer::all();
        $cStatus=ConditionStatus::all();
        $state=State::all();
        $Year=ModelYear::all();
        $site=Sitemodel::all();
        return view('add_trailer',['site_data'=>$site,'site_data1'=>$site,'Equipment_data'=>$cate,'state'=>$state,'year'=>$Year,'state1'=>$state,'year1'=>$Year,'Trailer_type'=>$type,'suspension'=>$suspension,'manafacture'=>$manufacture,'CStatus'=>$cStatus,'tractor_type'=>$type1,'tractor_manu'=>$t_manu]);
    }
    public function InsertEquipment1()
    {
        $cate=TrailerCategory::all();
        $type=TrailerType::all();
        $type1=TractorType::all();
        $t_manu=TractorManufacture::all();
        $suspension=Suspension::all();
        $manufacture=Manufacturer::all();
        $cStatus=ConditionStatus::all();
        $state=State::all();
        $Year=ModelYear::all();
        $site=Sitemodel::all();
        return view('add_tractor',['site_data'=>$site,'site_data1'=>$site,'Equipment_data'=>$cate,'state'=>$state,'year'=>$Year,'state1'=>$state,'year1'=>$Year,'Trailer_type'=>$type,'suspension'=>$suspension,'manafacture'=>$manufacture,'CStatus'=>$cStatus,'tractor_type'=>$type1,'tractor_manu'=>$t_manu]);
    }

    public function InsertEquipmentdetails(Request $request)
    {   
        $uid=Session::get('userId');
        //return 'called';
        //return $request->input('LastInsepctionDate');
        $type=$request->input('gender');
        if($type==1)
        {
            //return '1';
            /*$file=$request->file('Document1');
                $filename = $file->getClientOriginalExtension();
                if($filename=='pdf' || $filename=='jpeg' || $filename=='png' || $filename=='doc')
                {
                    return 'called';
                }
                else
                {
                    return 'failed';
                }
             */   
            $data=array(
                'ManufacturerId'=>$request->input('manufacture'),
                'TrailerTypeId'=>$request->input('subcat'),
                'ConditionStatusId'=>$request->input('con_status'),
                'SuspensionId'=>$request->input('susspension')
            );
            //return $data;
            $Traierdetails=new TrailerDetails();
                $Traierdetails->ManufacturerId=$request->input('manufacture');
                $Traierdetails->TrailerTypeId=$request->input('subcat');
                $Traierdetails->ConditionStatusId=$request->input('con_status');
                $Traierdetails->SuspensionId=$request->input('susspension');
            $Traierdetails->save();
            $tid=$Traierdetails->id;
            $eid=uniqid($Traierdetails->id);
            //$eid=str_replace('$','',$eid);
            $equipment=new Equipment();
                $equipment->TrailerSerialNo=$eid;
                $equipment->LastInsepctionDate=$request->input('LastInsepctionDate');
                $equipment->SiteId=$request->input('site');
                $equipment->TrailerDetailId=$tid;
                $equipment->userId=$uid;
                //$equipment->TractorSerialNo=0 ;
                $equipment->ModelYear=$request->input('Model');
            $equipment->save();
            $id=$equipment->TrailerSerialNo;
            $registration= new Registration();
            $file=$request->file('Document1');
                $filename = $file->getClientOriginalName();
                $registration->Make=$request->input('Make1');
                $registration->PlateNo=$request->input('Plate1');
                $registration->Class=$request->input('Class1');
                $registration->Own_info=$request->input('info');
                $registration->ExpireDate=$request->input('ExpireDate1');
                $registration->TitleNo=$request->input('TitleNo1');
                $registration->RegistrationDate=$request->input('RegistrationDate1');
                $registration->StateAbbreviation=$request->input('StateAbbreviation1');
                $registration->Document=$filename;
                $registration->TrailerSerialNo=$id;
                //$registration->TractorSerialNo=$id;
                $registration->ModelYear=$request->input('Model1');
                $registration->save();
            
                //Storage::disk('s3')->put($filename,file_get_contents($file));
                $file->move(public_path('uploads'), $filename);

        
                
 
                //Storage::disk('s3')->put($filename, $file);

                
            
            return redirect('/TrailerDetails');

        }
        elseif($type==0)
        {
            
            $Tractordetails=new TractorDetails();
                $Tractordetails->ManuFacturerID=$request->input('t_manu');
                $Tractordetails->TractorTypeId=$request->input('t_type');
                $Tractordetails->ConditionStatusId=$request->input('t_con');
            $Tractordetails->save();
            $id=uniqid($Tractordetails->id);
            $tid=$Tractordetails->id;
            //return $request->input('lastdate');
            $Tractor=new Tractor();
                $Tractor->TractorSerialNo=$id;
                $Tractor->LastInspectionDate=$request->input('lastdate');
                $Tractor->SiteId=$request->input('site');
                $Tractor->TractordetailId=$tid;
                $Tractor->userId=$uid;
                //return $request->input('Model');
                $Tractor->ModelYear=$request->input('Model');
            $Tractor->save();
            $ttid=$Tractor->TractorSerialNo;

            $registration= new Registration();
            $file=$request->file('Document');
                $filename = $file->getClientOriginalName();
                $registration->Make=$request->input('Make');
                $registration->PlateNo=$request->input('Plate');
                $registration->Own_info=$request->input('info1');
                $registration->Class=$request->input('Class');
                $registration->ExpireDate=$request->input('ExpireDate');
                $registration->TitleNo=$request->input('TitleNo');
                $registration->RegistrationDate=$request->input('RegistrationDate');
                $registration->StateAbbreviation=$request->input('StateAbbreviation');
                $registration->Document=$filename;
                $registration->TractorSerialNo=$ttid;
                $registration->ModelYear=$request->input('Model');
                $registration->save();
                
            $file->move(public_path('uploads'), $filename);
            //Storage::disk('s3')->put($filename, fopen($request->file('Document'), 'r+'), 'public');
            return redirect('/TractorDetails');
            return $data;
        }
    }
    public function TractorDetails()
    {
        $uid=Session::get('userId');
        //$data=DB::table('TractorDetails')->join('tractor_type','TractorDetails.TractorDetailId','=','tractor_type.TractorTypeId')->join('tractor_manu','TractorDetails.ManuFacturerID','=','tractor_manu.ManuFacturerID')->join('condition_status','TractorDetails.ConditionStatusId','=','condition_status.ConditionStatusId')->join('registration1','TractorDetails.TractorDetailId','=','registration1.TractorSerialNo')->join('maintenance','TractorDetails.TractorDetailId','=','maintenance.TractorSerialNo')->get();
        //return $data;
        $state=State::all();
        $Year=ModelYear::all();
        $site=Sitemodel::all();
        $data=DB::table('tractor')->join('registration1','tractor.TractorSerialNo','=','registration1.TractorSerialNo')->join('TractorDetails','tractor.TractordetailId','=','TractorDetails.TractordetailId')->join('tractor_manu','TractorDetails.ManuFacturerID','=','tractor_manu.ManuFacturerID')->join('tractor_type','TractorDetails.TractorTypeId','=','tractor_type.TractorTypeId')->join('site','tractor.SiteId','=','site.SiteId')->join('condition_status','TractorDetails.ConditionStatusId','=','condition_status.ConditionStatusId')->leftjoin('maintenance','tractor.TractorSerialNo','=','maintenance.TractorSerialNo')->where('tractor.userId',$uid)->get();
        //return json_encode($data);
        return view('TractorDetails',['Trailer_data'=>$data,'site'=>$site,'state'=>$state,'model'=>$Year]);
       // $TractorDetails=array('Trailer_data'=>$data,'site'=>$site,'state'=>$state,'model'=>$Year);
        //return response($TractorDetails)
    }

    public function getSitedata(Request $request,$id)
    {
        //$data=DB::table('TractorDetails')->join('tractor_type','TractorDetails.TractorDetailId','=','tractor_type.TractorTypeId')->join('tractor_manu','TractorDetails.ManuFacturerID','=','tractor_manu.ManuFacturerID')->join('condition_status','TractorDetails.ConditionStatusId','=','condition_status.ConditionStatusId')->join('registration1','TractorDetails.TractorDetailId','=','registration1.TractorSerialNo')->join('maintenance','TractorDetails.TractorDetailId','=','maintenance.TractorSerialNo')->get();
        //return $data;
        $state=Sitemodel::where('siteid',$id)->get();
        $data=array(
            'site'=>$state
        );
        return response($state);
    }

    public function TrailerDetails()
    {   
        $uid=Session::get('userId');
        $state=State::all();
        $Year=ModelYear::all();
        $site=Sitemodel::all();
        //$data=DB::table('trailer_detail')->join('trailer_type','trailer_detail.TrailerTypeId','=','trailer_type.TrailerTypeId')->join('t_manufacturer','trailer_detail.ManufacturerId','=','t_manufacturer.ManufacturerId')->join('condition_status','trailer_detail.ConditionStatusId','=','condition_status.ConditionStatusId')->join('suspension','trailer_detail.SuspensionId','=','suspension.SuspensionId')->get();   
        $data=DB::table('equipment')->join('registration1','equipment.TrailerSerialNo','=','registration1.TrailerSerialNo')->join('trailer_detail','equipment.TrailerDetailId','=','trailer_detail.TrailerDetailId')->join('t_manufacturer','trailer_detail.ManufacturerId','=','t_manufacturer.ManufacturerId')->join('trailer_type','trailer_detail.TrailerTypeId','=','trailer_type.TrailerTypeId')->leftjoin('maintenance','equipment.TrailerSerialNo','=','maintenance.TrailerSerialNo')->join('site','equipment.SiteId','=','site.SiteId')->join('condition_status','trailer_detail.ConditionStatusId','=','condition_status.ConditionStatusId')->join('suspension','trailer_detail.SuspensionId','=','suspension.SuspensionId')->where('equipment.userId',$uid)->get();
        //return $data;
        return view('TrailerDetails',['Trailer_data'=>$data,'site'=>$site,'state'=>$state,'model'=>$Year]);
    }

    public function get_allEquipmentData($id)
    {
        $data=DB::table('trailer_detail')->join('trailer_type','trailer_detail.TrailerTypeId','=','trailer_type.TrailerTypeId')->join('t_manufacturer','trailer_detail.ManufacturerId','=','t_manufacturer.ManufacturerId')->join('condition_status','trailer_detail.ConditionStatusId','=','condition_status.ConditionStatusId')->join('suspension','trailer_detail.SuspensionId','=','suspension.SuspensionId')->join('registration1','trailer_detail.TrailerDetailId','=','registration1.TractorSerialNo')->join('maintenance','trailer_detail.TrailerDetailId','=','maintenance.TrailerSerialNo')->where('TrailerDetailId',$id)->get();
        return $data;
    }

    public function editDetails_tractor(Request $request,$id)
    {
        //return $id;
        $data=DB::table('tractor')->join('registration1','tractor.TractorSerialNo','=','registration1.TractorSerialNo')->join('TractorDetails','tractor.TractordetailId','=','TractorDetails.TractordetailId')->join('tractor_manu','TractorDetails.ManuFacturerID','=','tractor_manu.ManuFacturerID')->join('tractor_type','TractorDetails.TractorTypeId','=','tractor_type.TractorTypeId')->join('site','tractor.SiteId','=','site.SiteId')->join('condition_status','TractorDetails.ConditionStatusId','=','condition_status.ConditionStatusId')->leftjoin('maintenance','tractor.TractorSerialNo','=','maintenance.TractorSerialNo')->where('tractor.TractorSerialNo',$id)->get();
        //return json_encode($data);
        $cate=TrailerCategory::all();
        $type=TrailerType::all();
        $type1=TractorType::all();
        $t_manu=TractorManufacture::all();
        $suspension=Suspension::all();
        $manufacture=Manufacturer::all();
        $cStatus=ConditionStatus::all();
        $state=State::all();
        $Year=ModelYear::all();
        $site=Sitemodel::all();
        return view('editTractorDetails',['0'=>$data,'site_data'=>$site,'site_data1'=>$site,'Equipment_data'=>$cate,'state'=>$state,'year'=>$Year,'state1'=>$state,'year1'=>$Year,'Trailer_type'=>$type,'suspension'=>$suspension,'manafacture'=>$manufacture,'CStatus'=>$cStatus,'tractor_type'=>$type1,'tractor_manu'=>$t_manu]);
        //return view('editTractorDetails',['Trailer_data'=>$data]);
    }

    public function tractroEditReg(Request $request)
    {
        $id=$request->VehicleId;
        $data=array(
            'Make'=>$request->Make,
            'PlateNo'=>$request->PlateNo,
            'Class'=>$request->Class,
            'ExpireDate'=>$request->ExpireDate,
            'TitleNo'=>$request->TitleNo,
            'RegistrationDate'=>$request->RegistrationDate,
            'StateAbbreviation'=>$request->StateAbbreviation,
            'ModelYear'=>$request->ModelYear);
            //return $data;
            DB::table('registration1')->where('VehicleId',$id)->update($data);
            return redirect('/TractorDetails');

    }
    public function tractor_EditInsdate(Request $request)
    {
        
        $id=$request->TractorDetailId;
        $data=array(
            'LastInspectionDate'=>$request->Insdate);
            //return $data;
            DB::table('tractor')->where('TractorDetailId',$id)->update($data);
        //return redirect('/TractorDetails');
    }

    public function tractor_EditSite(Request $request)
    {
        
        $id=$request->TractorDetailId;
        $data=array(
            'SiteId'=>$request->site);
            //return $data;
            DB::table('tractor')->where('TractorDetailId',$id)->update($data);
            return redirect('/TractorDetails');
    }
    
    public function deleteEquipment(Request $request,$tid)
    {
        DB::table('registration1')->where('VehicleId',$tid)->delete();
        return redirect('/TractorDetails');
    }


    public function TrailerEditReg(Request $request)
    {
        $id=$request->VehicleId;
        $data=array(
            'Make'=>$request->Make,
            'PlateNo'=>$request->PlateNo,
            'Class'=>$request->Class,
            'ExpireDate'=>$request->ExpireDate,
            'TitleNo'=>$request->TitleNo,
            'RegistrationDate'=>$request->RegistrationDate,
            'StateAbbreviation'=>$request->StateAbbreviation,
            'ModelYear'=>$request->ModelYear);
            //return $data;
            DB::table('registration1')->where('VehicleId',$id)->update($data);
            return redirect('/TrailerDetails');

    }
    public function Trailer_EditInsdate(Request $request)
    {
        $id=$request->TrailerSerialNo;
        $data=array(
            'LastInsepctionDate'=>$request->Insdate);
            //return $data;
            DB::table('equipment')->where('TrailerDetailId',$id)->update($data);
            return redirect('/TrailerDetails');
    }

    public function Trailer_EditSite(Request $request)
    {
        $id=$request->TrailerSerialNo;
        $data=array(
            'SiteId'=>$request->site);
            //return $data;
            DB::table('equipment')->where('TrailerDetailId',$id)->update($data);
            return redirect('/TrailerDetails');
    }

    public function deleteEquipment1(Request $request,$tid)
    {
        DB::table('registration1')->where('VehicleId',$tid)->delete();
        return redirect('/TrailerDetails');
    }
    
    
}
