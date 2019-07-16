<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class TrailerCategory extends Model
{
    use Notifiable;
    protected $table='trailer_category';
    public $timestamp = 'false';
    public $primarykey='TrailerCategoryId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TrailerTypeCategoryName',
    ];
}
