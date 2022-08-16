<?php
namespace App\Http\Controllers;
ini_set('max_execution_time', 9999999);

use App\Terrorists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TerroristsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terrorists = Terrorists::orderBy('surname', 'asc')->paginate(100);
        return view(
            'terrorists',
            [
                'terrorists' => $terrorists,
            ]
        );
    }

    public function terroristCheckAjax(Request $request){
        if($request->ter_thirdname){
            $result = Terrorists::where('surname', $request->ter_surname)
                ->where('name', $request->ter_name)
                ->where('thirdname', $request->ter_thirdname)
                ->get();
        }else{
            $result = Terrorists::where('surname', $request->ter_surname)
                ->where('name', $request->ter_name)
                ->get();
        }
        return($result);
    }

    public static function getTerrorists()
    {
        Terrorists::truncate();
        $strings = [];
        $list = Storage::get('terrorists/terrorists.list');

        if ($list) {
            $strings = explode(";", $list);
        }

        foreach($strings as $string){
            $t_id = explode('.',$string)[0];
            $t_info = str_replace($t_id.'. ', '', $string);
            $t_fullname = explode(',', $t_info)[0];
            $t_surname = explode(' ', $t_fullname)[0];
            $t_name = '';
            $t_thirdname = '';
            if(isset(explode(' ', $t_fullname)[1])){
                $t_name = str_replace('*', '', explode(' ', $t_fullname)[1]);
            }
            if(isset(explode(' ', $t_fullname)[2])){
                $t_thirdname = str_replace('*', '', explode(' ', $t_fullname)[2]);
            }
            $t_birthdate = '';
            $t_birthplace = '';
            if(isset(explode(',', $t_info)[1])){
                $t_birthdate = trim(str_replace('г.р.', '', explode(',', $t_info)[1]));
            };
            if(isset(explode(',', $t_info)[2])){
                $t_birthplace = explode(',', $t_info)[2];
            };
            echo('id: '.$t_id.' surname: '.$t_surname.' name: '.$t_name.' thirdname: '.$t_thirdname.' birthdate: '.$t_birthdate.
                ' birthplace: '.$t_birthplace.'<br/>');
            $terrorist = new Terrorists;
            $terrorist->surname = $t_surname;
            $terrorist->name = $t_name;
            $terrorist->thirdname = $t_thirdname;
            $terrorist->birthdate = $t_birthdate;
            $terrorist->birthplace = $t_birthplace;
            $terrorist->save();
        }
    }
}
