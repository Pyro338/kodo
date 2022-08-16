<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terrorists extends Model
{
    protected $fillable = [
        'surname', 'name', 'thirdname', 'birthdate', 'birthplace'
    ];
}
