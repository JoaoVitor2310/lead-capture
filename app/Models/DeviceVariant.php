<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceVariant extends Model
{

    protected $fillable = [
        'name',
        'description',
        'device_id',
        'storage_capacity',
        'color',
    ];
    
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->device->name} {$this->storage_capacity} {$this->color}";
    }
}
