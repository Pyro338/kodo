<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisations extends Model
{
    protected $fillable = [
        'okopf_code', 'okopf_name', 'name', 'ogrn', 'inn', 'kpp', 'ogrn_date', 'ur_address_region_code', 'ur_address_name', 'fact_address_region_code',
        'fact_address_name', 'okved_code', 'okved_name'
    ];
}
