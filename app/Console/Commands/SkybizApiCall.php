<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SkyBizTrackingModel;
use App\SkyBizErrorLogModel;
use Ixudra\Curl\Facades\Curl;

class SkybizApiCall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'track:trailer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call to skybiz api to get all the trailers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
            $response = Curl::to('https://xml.skybitz.com:9443/QueryPositions?assetid=ALL&customer=MauserXmL&password=XmL467&version=1.0&sortby=1')->get();
            $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
            $json = json_encode($xml);
            $dataArray = json_decode($json,TRUE);
            if ($dataArray['error'] == 0) {
                // SkyBizTrackingModel::truncate();
                foreach ($dataArray['gls'] as $key => $value) {
                    if (isset($value['latitude']) && isset($value['longitude']) &&
                        isset($value['mtsn']) && (isset($value['landmark']) && isset($value['landmark']['geoname'])) && 
                            ( isset($value['landmark']) && isset($value['landmark']['state']) ) &&
                            ( isset($value['landmark']) && isset($value['landmark']['country']) ) &&
                            ( isset($value['landmark']) && isset($value['landmark']['distance']) ) &&
                            isset($value['battery']) &&
                            ( isset($value['serial']) && isset($value['serial']['serialdata']) ) &&
                            isset($value['time'])

                        ) {
                        $checkdata = SkyBizTrackingModel::where('TrailerNo', $value['assetid'])->count();
                        if ($checkdata >= 90) {
                            SkyBizTrackingModel::where('TrailerNo', $value['assetid'])->delete();
                        } else {
                            $skyBizData = new SkyBizTrackingModel();
                            $skyBizData->TrailerNo = isset($value['assetid']) ? $value['assetid'] : NULL;
                            $skyBizData->TrailerUnitNo = isset($value['mtsn']) ? $value['mtsn'] : NULL;
                            $skyBizData->Latitude = isset($value['latitude']) ? $value['latitude'] : NULL;
                            $skyBizData->Longitude = isset($value['longitude']) ? $value['longitude'] : NULL;
                            $skyBizData->Longitude = isset($value['longitude']) ? $value['longitude'] : NULL;
                            $skyBizData->ClosestLandMark = isset($value['landmark']) && isset($value['landmark']['geoname']) ? $value['landmark']['geoname'] : NULL;
                            $skyBizData->State = isset($value['landmark']) && isset($value['landmark']['state']) ? $value['landmark']['state'] : NULL;
                            $skyBizData->Country = isset($value['landmark']) && isset($value['landmark']['country']) ? $value['landmark']['country'] : NULL;
                            $skyBizData->DistanceFromLandmark = isset($value['landmark']) && isset($value['landmark']['distance']) ? $value['landmark']['distance'] : NULL;
                            $skyBizData->BatteryStatus = isset($value['battery']) ? $value['battery'] : NULL;
                            $skyBizData->Motion_status = isset($value['serial']) && isset($value['serial']['serialdata']) ? $value['serial']['serialdata'] : NULL;
                            $skyBizData->track_date_time = isset($value['time']) ? date('Y-m-d h:i:s', strtotime($value['time'])) : NULL;
                            $skyBizData->save();
                        }
                        
                    }
                }    
            }
        } catch(\Exception $e) {
            $errorLog = new SkyBizErrorLogModel();
            $errorLog->error_detail = $e->getMessage();
            $errorLog->save();
            \Artisan::call('track:trailer');
            dd($e->getMessage());
        }
        
    }
}
