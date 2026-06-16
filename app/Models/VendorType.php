<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorType extends Model
{
    protected $fillable = [
    'vendor_name',
    'image',
    'status'
];
}
