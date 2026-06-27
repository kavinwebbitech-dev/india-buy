<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Quotation extends Model
{
    //
    use HasFactory;
    protected $guarded = [];
    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class, 'enquiry_id');
    }
}
