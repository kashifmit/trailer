<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipmentModel extends Model
{
    protected $table = 'equipment';
    public $timestamps = false;
    protected $guarded = ['TrailerSerialNo'];

    public function eTrackingsystem()
    {
    	return $this->hasMany('App\TrackingSystemModel', 'ETrackId', 'etrack_id');
    }

    public function registrationData()
    {
        return $this->hasMany('App\RegistrationModel', 'TrailerSerialNo', 'TrailerSerialNo');
    }

    public function filesData()
    {
        return $this->hasMany('App\TrailerFilesModel', 'TrailerSerialNo', 'TrailerSerialNo');
    }

    public function equipmentTracking()
    {
        return $this->hasMany('App\EquipmentTrackingModel', 'TrailerSerialNo', 'TrailerSerialNo');
    }

    public function getTrackingsystem($field = '')
    {
        $eTrackingsystem = $this->eTrackingsystem()->first();
        if (null === $eTrackingsystem) {
            $eTrackingsystem = $this->eTrackingsystem()->first();
        }
        if (null !== $eTrackingsystem) {
            if (!empty($field))
                return $eTrackingsystem->$field;
            else
                return $eTrackingsystem;
        }
    }

    public function manufacturers($value='')
    {
    	return $this->hasMany('App\ManufacturerModel', 'MakeId', 'ManufacturerId');
    }

    public function getManufacturers($field = '')
    {
        $manufacturers = $this->manufacturers()->first();
        if (null === $manufacturers) {
            $manufacturers = $this->manufacturers()->first();
        }
        if (null !== $manufacturers) {
            if (!empty($field))
                return $manufacturers->$field;
            else
                return $manufacturers;
        }
    }
}
