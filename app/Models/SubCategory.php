<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_categories';

//     protected $fillable = [
//     'business_type_id',
//     'category_id',
//     'sub_category_name',
//     'status'
// ];
    protected $guarded = [];
    public function businessType()
{
    return $this->belongsTo(BusinessType::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}
}