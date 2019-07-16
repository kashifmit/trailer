<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Sitemodel extends Model
{
    //
    use Notifiable;
    protected $table='site';
    public $timestamp = 'false';
    public $primarykey='Siteid';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site_unique_id','SiteName','StreetNo','StreetName','SuiteNo','City','StateAbbreviation','PostalCode','OrganizationId','userId','hide',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
