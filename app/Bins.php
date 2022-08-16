<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bins extends Model
{
    protected $fillable = [
        'bin', 'brand', 'issuer', 'type', 'category', 'country_name'
    ];
}
