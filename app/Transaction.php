<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'travel_packages_id','users_id','additional_visa','transaction_total','transaction_status'
    ];

    protected $hidden = [

    ];

    public function Details(){
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }

    public function Travel_Package(){
        return $this->belongsTo(TravelPackage::class, 'travel_packages_id', 'id');
    }

    public function User(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
