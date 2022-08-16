<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionCodes extends Model
{
    protected $fillable = [
        'name', 'code', 'gibdd', 'okato', 'gost'
    ];
}
