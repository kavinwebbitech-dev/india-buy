<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    //
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'enquiry_id');
    }

    public function latestMessage()
    {
        return $this->hasOne(Message::class, 'enquiry_id')->latestOfMany();
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
