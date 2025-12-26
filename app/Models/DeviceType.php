<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'order',
        'active',
    ];
    
    public function lines()
    {
        return $this->hasMany(DeviceLine::class);
    }
}
