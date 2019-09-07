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

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('area', function (Builder $builder) {
            $builder->addSelect(DB::raw('id, X(`location`) as x, Y(`location`) as y, user_id, created_at, updated_at'));
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
    //     return $this->addSelect(DB::raw('id, X(`location`) as x, Y(`location`) as y'));
    // }
}
