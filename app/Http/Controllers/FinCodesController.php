<?php
namespace App\Http\Controllers;
ini_set('max_execution_time', 9999999);

use App\FinCodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FinCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fin_codes = FinCodes::all();
        return view(
            'fin_codes',
            [
                'fin_codes' => $fin_codes,
            ]
        );
    }

    public static function getFinCodes()
    {
        FinCodes::truncate();
        $strings = [];
        $list = Storage::get('financial/financial.list');

        if ($list) {
            $strings = explode("~", $list);
        }

        foreach($strings as $string){
            if(trim($string) != ''){
                $fin_title = trim(explode('|', $string)[0]);
                if(isset(explode('|', $string)[1])){
                    $fin_codes = explode(',',explode('|', $string)[1]);
                    for($i = 0; $i < count($fin_codes); $i++){
                        $fin_code = str_replace('...', '3', $fin_codes[$i]);
                        echo('code: '.$fin_code.' title: '.$fin_title.'<br/>');
                        $new_fin_code = new FinCodes;
                        $new_fin_code->title = $fin_title;
                        $new_fin_code->code = $fin_code;
                        $new_fin_code->save();
                    }
                }
            }
        }
    }
}
