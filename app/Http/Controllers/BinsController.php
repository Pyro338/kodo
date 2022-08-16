<?php
namespace App\Http\Controllers;
ini_set('max_execution_time', 9999999);

use App\Bins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BinsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bins = Bins::orderBy('bin', 'asc')->paginate(100);
        return view(
            'bins',
            [
                'bins' => $bins,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function cardcheckAjax(Request $request){
        $cardnumber = str_replace(' ', '', $request->cardnumber);
        $cardnumber = (int)substr($cardnumber, 0, 6);
        $result = Bins::where('bin', $cardnumber)->first();
        return($result);
    }

    public function getBins(){
        for($i = 859231; $i < 859233; $i++){
            $this->thiefBin($i);
        }
    }

    public function thiefBin($cardnumber){
        //Инициализирует сеанс
        $connection = curl_init();
        //Устанавливаем адрес для подключения
        curl_setopt($connection, CURLOPT_URL, "https://psm7.com/bin/worker.php");
        //Указываем, что мы будем вызывать методом POST
        curl_setopt($connection, CURLOPT_POST, 1);
        //Передаем параметры методом POST
        curl_setopt($connection, CURLOPT_POSTFIELDS, "bin-input=$cardnumber");
        //Говорим, что нам необходим результат
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        //Выполняем запрос с сохранением результата в переменную
        $result=curl_exec($connection);
        //Завершает сеанс
        curl_close($connection);
        //Выводим на экран
        echo($result.'<br/>');
        Log::info($cardnumber);
        Log::info($result);
        $result_array = json_decode($result, true);
        if(isset($result_array['bin'])){
            echo ($cardnumber.' got it<br/>');
            $this->store($result_array);
        }else{
            echo ($cardnumber.' failed<br/>');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($result_array)
    {
        Bins::create($result_array);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bins  $bins
     * @return \Illuminate\Http\Response
     */
    public function show(Bins $bins)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bins  $bins
     * @return \Illuminate\Http\Response
     */
    public function edit(Bins $bins)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bins  $bins
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bins $bins)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bins  $bins
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bins $bins)
    {
        //
    }
}
