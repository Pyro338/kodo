<?php
namespace App\Http\Controllers;
ini_set('max_execution_time', 9999999);

use App\Okopf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OkopfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $okopf_codes = Okopf::orderBy('title', 'asc')->get();
        return view(
            'okopf',
            [
                'okopf_codes' => $okopf_codes,
            ]
        );
    }

    public static function getOkopf()
    {
        Okopf::truncate();
        $strings = [];
        $list = Storage::get('okopf/okopf.list');

        if ($list) {
            $strings = explode("~", $list);
        }

        foreach($strings as $string){
            if(trim($string) != ''){
                $okopf_title = trim(explode('|', $string)[0]);
                $okopf_code = str_replace(' ', '', trim(explode('|', $string)[1]));
                $new_okopf = new Okopf;
                $new_okopf->title = $okopf_title;
                $new_okopf->code = $okopf_code;
                $new_okopf->save();
                var_dump($new_okopf);
            }
        }
    }
}
