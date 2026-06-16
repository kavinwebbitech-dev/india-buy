<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    use HasFactory;

    protected $table = 'business_types';

    protected $fillable = [
        'business_name',
        'vendor_type_id',
        'status'
    ];

    // Relation: BusinessType belongs to VendorType
    public function vendorType()
    {
        return $this->belongsTo(VendorType::class, 'vendor_type_id');
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'business_type_id');
    }
}