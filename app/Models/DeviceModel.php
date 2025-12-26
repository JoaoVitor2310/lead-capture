<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceModel extends Model
{
    protected $fillable = [
        'device_model_id',
        'storage',
        'color',
        'color_hex',
        'trade_in_value',
        'sale_price',
        'available_for_trade',
        'available_for_sale',
        'active',
    ];

    public function model()
    {
        return $this->belongsTo(DeviceModel::class, 'device_model_id');
    }

    // public function line()
    // {
    //     return $this->through('model', 'line');
    // }

    // public function type()
    // {
    //     return $this->through('model', 'line', 'type');
    // }
}
