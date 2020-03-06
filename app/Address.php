<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'postal_code',
        'location',
        'city_id',
        'is_public',
        'user_id',
        'notes',
    ];
    // protected $appends = ['location'];
    protected $hidden = ['location'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('coordinates', function (Builder $builder) {
            $builder->select()->addSelect(DB::raw('X(`location`) as x, Y(`location`) as y'));
        });
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    // public function getLocationAttribute()
    // {
    //     return $this->select()->addSelect(DB::raw('X(`location`) as x, Y(`location`) as y'));
    // }
}
