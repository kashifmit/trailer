<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class TrailerType extends Model
{
    use Notifiable;
    protected $table='trailer_type';
    public $timestamp = 'false';
    public $primarykey='TrailerTypeId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TypeName','TrailerCategoryId',
    ];
}
