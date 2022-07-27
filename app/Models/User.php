<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Claim;

class User extends Model
{
    use HasFactory;


    public function calims(){
    	return $this->hasMany(Claim::class,'claim_user');
    }


    public function getAvatarAttribute($value) {
    	if ($value) {
    		return asset('user/images'.$value);
    	} else {
    		return asset('user/images/no-image.png'.$value);
    	}
    }

}
