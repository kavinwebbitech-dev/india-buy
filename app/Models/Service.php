<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // protected $fillable = [

    //     'service_name',
    //     'category',
    //     'subcategory',
    //     'short_description',
    //     'long_description',
    //     'price_type',

    //     'service_state',
    //     'service_city',

    //     'datasheet',
    //     'service_img',

    //     'feature',
    //     'available_days',

    //     'opening_time',
    //     'closing_time',

    //     'vendor_id',
    //     'vendor_type_id',

    //     'status',
    // ];
    protected $guarded = [];

    protected $casts = [

        'feature' => 'array',
        'available_days' => 'array',
        'service_img' => 'array',
    ];


    // CATEGORY
    public function categoryData()
    {
        return $this->belongsTo(Category::class, 'category');
    }

    // SUB CATEGORY
    public function subCategoryData()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory');
    }

    // VENDOR
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
    public function businessType()
    {
        return $this->belongsTo(BusinessType::class,'business_type_id');
    }

}