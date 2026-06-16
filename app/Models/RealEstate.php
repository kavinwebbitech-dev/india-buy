<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    use HasFactory;

    protected $table = 'real_estates';

    // protected $fillable = [

    //     'vendor_id',

    //     'vendor_type_id',

    //     'category_id',

    //     'sub_category_id',

    //     'property_title',

    //     'property_type',

    //     'property_for',

    //     'descripction',

    //     'state',

    //     'city',

    //     'address',

    //     'landmark',

    //     'specification',

    //     'features',

    //     'proerty_image',

    //     'datasheet',

    //     'status',

    // ];
    protected $guarded = [];


    protected $casts = [

        'specification' => 'array',

        'features' => 'array',

        'proerty_image' => 'array',

        'datasheet' => 'array',

    ];


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // VENDOR
    public function vendor()
    {
        return $this->belongsTo(
            Vendor::class,
            'vendor_id'
        );
    }


    // CATEGORY
    public function categoryData()
    {
        return $this->belongsTo(
            Category::class,
            'category_id'
        );
    }


    // SUB CATEGORY
    public function subCategoryData()
    {
        return $this->belongsTo(
            SubCategory::class,
            'sub_category_id'
        );
    }


    // VENDOR TYPE
    public function vendorType()
    {
        return $this->belongsTo(
            BusinessType::class,
            'vendor_type_id'
        );
    }
}