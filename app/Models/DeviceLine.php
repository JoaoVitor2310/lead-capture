<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceLine extends Model
{

    protected $fillable = [
        'device_type_id',
        'name',
        'slug',
        'description',
        'year',
        'order',
        'active',
    ];

    public function type()
    {
        return $this->belongsTo(DeviceType::class, 'device_type_id');
    }

    public function models()
    {
        return $this->hasMany(DeviceModel::class);
    }
}
