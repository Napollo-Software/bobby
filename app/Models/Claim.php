<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{

    public function user_details(){
        return $this->belongsTo(User::class,'claim_user' , 'id');
    }

    use HasFactory;
    protected $fillabel = [
    	'claim_title',
    	'expense_date',
    	'claim_description',
    	'claim_category',
    	'claim_amount',
    	'claim_bill_attachment',
    	'payment_method',
    	'claim_status',
    	'claim_user'
    ];
}
