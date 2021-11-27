<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Short extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'short', 'title', 'hint'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
