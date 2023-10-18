<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setdeposit extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'amount',
        'start_date',
        'end_date',
        'status'
    ];

    public function payments()
    {
        return $this->hasMany(Pay::class)->where('addmember_id');
        
    }

    public function member()
    {
        return $this->hasMany(Addmember::class);
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
