<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $fillable = [

    //     'vendor_id',
    //     'vendor_type_id',
    //     'category_id',
    //     'sub_category_id',
    //     'product_name',
    //     'brand',
    //     'model_number',
    //     'short_description',
    //     'key_value',
    //     'product_details',
    //     'specification',
    //     'image',
    //     'data_sheet',
    //     'status',

    // ];
    protected $guarded = [];

    protected $casts = [

        'key_value'       => 'array',
        'product_details' => 'array',
        'specification'   => 'array',
        'image'           => 'array',
         'data_sheet'           => 'array',

    ];


    public function categoryData()
{
    return $this->belongsTo(
        Category::class,
        'category_id'
    );
}

public function subCategoryData()
{
    return $this->belongsTo(
        SubCategory::class,
        'sub_category_id'
    );
}



public function vendor()
{
    return $this->belongsTo(Vendor::class, 'vendor_id');
}

}