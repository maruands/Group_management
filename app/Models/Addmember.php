<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addmember extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'setdeposit_id',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Pay::class);
        
    }

    public function totalPayments()
    {
        if($this->payments)
        {
            return $this->payments->map(function ($i){
                return $i->amount;
            })->sum();
        }
        return 0;
    }
}
