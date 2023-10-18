<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dairy extends Model
{
    use HasFactory;
    protected $fillable = [
        'date','Item','quantity','buying_price','selling_price','expendicture','receive_amount'
    ];

    /*
    public function dairy()
    {
        $dairies = Dairy::get();
        return $dairies;
    }
    public function total_buying()
    {
        if($this->dairy)
        {
            return $this->dairy->map(function ($i){
                return $i->quantity * $i->buying_price;
            })->sum();
        }
    } */
}
