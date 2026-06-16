<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    'vendor_type_id',
    'business_type_id',
    'category_name',
    'image',
    'status'
];

public function vendorType()
{
    return $this->belongsTo(VendorType::class, 'vendor_type_id');
}

public function businessType()
{
    return $this->belongsTo(BusinessType::class, 'business_type_id');
}

public function subCategories()
{
    return $this->hasMany(SubCategory::class, 'category_id');
}

public function products()
{
    return $this->hasMany(Product::class, 'category_id');
}
}
