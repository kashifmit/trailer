<?php

namespace App\Exports;

use App\SkyBizTrackingModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportTrailerTrackingCSV implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    public function __construct($id)
    {
        $this->id = $id; 
    }
    public function collection()
    {
        // \DB::enableQueryLog();
    	$data = SkyBizTrackingModel::select('id', 'TrailerNo', 'TrailerUnitNo', 'Latitude', 'Longitude', 'ClosestLandMark', 'State', 'Country', 'DistanceFromLandmark', 'BatteryStatus', 'Motion_status', 'track_date_time');
        if (!empty($this->id)){
           $data = $data->whereIn('id', $this->id);

        }
        $data = $data->get();
        // dd(\DB::getQueryLog());
        return $data;
    }


    public function headings(): array
    {
        return [
            'Map Id',
            'Trailer No',
            'Trailer unit No',
            'Latitude',
            'Longitude',
            'Closest LandMark',
            'State',
            'Country',
            'Distance From Land Mark',
            'Battery Status',
            'Motion',
            'Time'
        ];
    }
}
