<?php
namespace App\Http\Controllers;
ini_set('max_execution_time', 9999999);

use App\RegionCodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegionCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $region_codes = RegionCodes::all();
        return view(
            'region_codes',
            [
                'regions' => $region_codes,
            ]
        );
    }

    public static function getRegionCodes()
    {
        RegionCodes::truncate();
        $strings = [];
        $list = Storage::get('regions/regions.list');

        if ($list) {
            $strings = explode("~", $list);
        }

        foreach($strings as $string){
            if(trim($string) != ''){
                $fin_name = trim(explode('|', $string)[0]);
                $fin_code = trim(explode('|', $string)[1]);
                $fin_gibdd = trim(explode('|', $string)[2]);
                $fin_okato = trim(explode('|', $string)[3]);
                $fin_gost = trim(explode('|', $string)[4]);
                $new_region = new RegionCodes;
                $new_region->name = $fin_name;
                $new_region->code = $fin_code;
                $new_region->gibdd = $fin_gibdd;
                $new_region->okato = $fin_okato;
                $new_region->gost = $fin_gost;
                $new_region->save();
                var_dump($new_region);
            }
        }
    }
}
