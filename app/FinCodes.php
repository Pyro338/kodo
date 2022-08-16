<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinCodes extends Model
{
    protected $fillable = [
        'title', 'code'
    ];
}
