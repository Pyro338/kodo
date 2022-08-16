<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'phone', 'password', 'passport_series', 'passport_number', 'passport_first_name',
        'passport_second_name', 'passport_third_name', 'passport_place_issue', 'passport_date_issue', 'passport_code_issue',
        'passport_birth_date', 'passport_birth_place', 'passport_registration', 'passport_sex', 'organisation_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function updateEncrypted($user, $request){
        $encrypted_array = [];
        foreach($request as $key => $value){
            if($key == 'passport_series' || $key == 'passport_number' || $key == 'passport_first_name'
                || $key == 'passport_second_name' || $key == 'passport_third_name' || $key == 'passport_place_issue'
                || $key == 'passport_code_issue' || $key == 'passport_birth_place' || $key == 'passport_registration'
                || $key == 'passport_sex'){
                $encrypted_array[$key] = Crypt::encryptString($value);
            }else{
                $encrypted_array[$key] = $value;
            }
        }
        $user->update($encrypted_array);
    }
}
