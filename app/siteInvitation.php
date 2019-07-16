<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class siteInvitation extends Model
{
    //
    protected $table='site_invitation';
    public $timestamp = 'false';
    public $primarykey='invitationId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SiteId','Email','status',
    ];
}
