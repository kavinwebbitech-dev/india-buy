<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use HasFactory;

    // protected $fillable = [

    //     'user_id',
    //     'vendor_type_id',
    //     'business_id',
    //     'company_name',
    //     'company_logo',
    //     'about_us',
    //     'year_established',
    //     'country',
    //     'state',
    //     'city',
    //     'address',
    //     'phone',
    //     'email',
    //     'gst_no',
    //     'otp',
    //     'otp_expired_at',
    //     'status',
    //     'email_verify',
    //     'email_verify_at',
    //     'password',
    // ];


        protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function vendorType()
{
    return $this->belongsTo(VendorType::class, 'vendor_type_id');
}

public function businessType()
{
    return $this->belongsTo(BusinessType::class, 'business_id');
}

public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}

public function subCategory()
{
    return $this->belongsTo(SubCategory::class, 'sub_category_id');
}

public function products()
{
    return $this->hasMany(Product::class, 'vendor_id');
}

}