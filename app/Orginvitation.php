<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Orginvitation extends Model
{
    //
    use Notifiable;
    protected $table='org_invitation';
    public $timestamp = 'false';
    public $primarykey='invitationId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgId','Email','status',
    ];

}
