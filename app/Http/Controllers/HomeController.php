<?php

namespace App\Http\Controllers;

use App\Organisations;
use Illuminate\Http\Request;
use App\Services\DocuSign;
use App\Services\SimpleXLSX;
use App\Services\Transliterate;
use Illuminate\Support\Facades\Storage;
use App\FinCodes;
use App\RegionCodes;
use App\Okopf;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function transliterateIndex()
    {
        return view('home');
    }

    public function lettersIndex()
    {
        $letters    = Transliterate::getLetters();
        $row_length = 0;
        foreach ($letters as $letter) {
            if (count($letter) > $row_length) {
                $row_length = count($letter);
            }
        }

        return view(
            'letters',
            [
                'letters'    => $letters,
                'row_length' => $row_length
            ]
        );
    }

    public function docusignIndex()
    {
        return view('sign');
    }

    public function personalIndex()
    {
        return view('personal');
    }

    public function cardcheckIndex()
    {
        return view('cardcheck');
    }

    public function underwritingIndex()
    {
        return view('underwriting');
    }

    public function terroristscheckIndex()
    {
        return view('terroristscheck');
    }

    public function fsspIndex()
    {
        return view(
            'fssp',
            [
                'regions' => RegionCodes::all()
            ]
        );
    }

    public function employerIndex()
    {
        return view(
            'employer',
            [
                'okopfs'        => Okopf::orderBy('title', 'asc')->get(),
                'organisations' => Organisations::all()
            ]
        );
    }

    public function employer2Index()
    {
        return view(
            'employer2',
            [
                'organisations' => Organisations::all()
            ]
        );
    }

    // функция кодирует строку для URL
    public function my_url_encode($s)
    {
        $s = strtr(
            $s,
            array(
                " " => "%20",
                "а" => "%D0%B0",
                "А" => "%D0%90",
                "б" => "%D0%B1",
                "Б" => "%D0%91",
                "в" => "%D0%B2",
                "В" => "%D0%92",
                "г" => "%D0%B3",
                "Г" => "%D0%93",
                "д" => "%D0%B4",
                "Д" => "%D0%94",
                "е" => "%D0%B5",
                "Е" => "%D0%95",
                "ё" => "%D1%91",
                "Ё" => "%D0%81",
                "ж" => "%D0%B6",
                "Ж" => "%D0%96",
                "з" => "%D0%B7",
                "З" => "%D0%97",
                "и" => "%D0%B8",
                "И" => "%D0%98",
                "й" => "%D0%B9",
                "Й" => "%D0%99",
                "к" => "%D0%BA",
                "К" => "%D0%9A",
                "л" => "%D0%BB",
                "Л" => "%D0%9B",
                "м" => "%D0%BC",
                "М" => "%D0%9C",
                "н" => "%D0%BD",
                "Н" => "%D0%9D",
                "о" => "%D0%BE",
                "О" => "%D0%9E",
                "п" => "%D0%BF",
                "П" => "%D0%9F",
                "р" => "%D1%80",
                "Р" => "%D0%A0",
                "с" => "%D1%81",
                "С" => "%D0%A1",
                "т" => "%D1%82",
                "Т" => "%D0%A2",
                "у" => "%D1%83",
                "У" => "%D0%A3",
                "ф" => "%D1%84",
                "Ф" => "%D0%A4",
                "х" => "%D1%85",
                "Х" => "%D0%A5",
                "ц" => "%D1%86",
                "Ц" => "%D0%A6",
                "ч" => "%D1%87",
                "Ч" => "%D0%A7",
                "ш" => "%D1%88",
                "Ш" => "%D0%A8",
                "щ" => "%D1%89",
                "Щ" => "%D0%A9",
                "ъ" => "%D1%8A",
                "Ъ" => "%D0%AA",
                "ы" => "%D1%8B",
                "Ы" => "%D0%AB",
                "ь" => "%D1%8C",
                "Ь" => "%D0%AC",
                "э" => "%D1%8D",
                "Э" => "%D0%AD",
                "ю" => "%D1%8E",
                "Ю" => "%D0%AE",
                "я" => "%D1%8F",
                "Я" => "%D0%AF"
            )
        );

        return $s;
    }

    // функция раскодирует строку из URL
    public function my_url_decode($s)
    {
        $s = strtr(
            $s,
            array(
                "%20"    => " ",
                "%D0%B0" => "а",
                "%D0%90" => "А",
                "%D0%B1" => "б",
                "%D0%91" => "Б",
                "%D0%B2" => "в",
                "%D0%92" => "В",
                "%D0%B3" => "г",
                "%D0%93" => "Г",
                "%D0%B4" => "д",
                "%D0%94" => "Д",
                "%D0%B5" => "е",
                "%D0%95" => "Е",
                "%D1%91" => "ё",
                "%D0%81" => "Ё",
                "%D0%B6" => "ж",
                "%D0%96" => "Ж",
                "%D0%B7" => "з",
                "%D0%97" => "З",
                "%D0%B8" => "и",
                "%D0%98" => "И",
                "%D0%B9" => "й",
                "%D0%99" => "Й",
                "%D0%BA" => "к",
                "%D0%9A" => "К",
                "%D0%BB" => "л",
                "%D0%9B" => "Л",
                "%D0%BC" => "м",
                "%D0%9C" => "М",
                "%D0%BD" => "н",
                "%D0%9D" => "Н",
                "%D0%BE" => "о",
                "%D0%9E" => "О",
                "%D0%BF" => "п",
                "%D0%9F" => "П",
                "%D1%80" => "р",
                "%D0%A0" => "Р",
                "%D1%81" => "с",
                "%D0%A1" => "С",
                "%D1%82" => "т",
                "%D0%A2" => "Т",
                "%D1%83" => "у",
                "%D0%A3" => "У",
                "%D1%84" => "ф",
                "%D0%A4" => "Ф",
                "%D1%85" => "х",
                "%D0%A5" => "Х",
                "%D1%86" => "ц",
                "%D0%A6" => "Ц",
                "%D1%87" => "ч",
                "%D0%A7" => "Ч",
                "%D1%88" => "ш",
                "%D0%A8" => "Ш",
                "%D1%89" => "щ",
                "%D0%A9" => "Щ",
                "%D1%8A" => "ъ",
                "%D0%AA" => "Ъ",
                "%D1%8B" => "ы",
                "%D0%AB" => "Ы",
                "%D1%8C" => "ь",
                "%D0%AC" => "Ь",
                "%D1%8D" => "э",
                "%D0%AD" => "Э",
                "%D1%8E" => "ю",
                "%D0%AE" => "Ю",
                "%D1%8F" => "я",
                "%D0%AF" => "Я"
            )
        );

        return $s;
    }

    public function lettersUpdate(Request $request)
    {
        $result = [];
        foreach ($request->file() as $file) {
            foreach ($file as $f) {
                $filename = time() . '_' . $f->getClientOriginalName();
                if ($f->move(storage_path('app/public/files/'), $filename)) {
                    if ($xlsx = SimpleXLSX::parse('storage/files/' . $filename)) {
                        foreach ($xlsx->rows() as $row) {
                            if (trim($row[0]) != '') {
                                $result[mb_strtolower(trim($row[0]))] = [];
                                for ($i = 1; $i < count($row); $i++) {
                                    if (trim($row[$i]) != '') {
                                        if (trim($row[$i]) == 'опускается') {
                                            array_push($result[mb_strtolower(trim($row[0]))], '');
                                        } else {
                                            array_push($result[mb_strtolower(trim($row[0]))], mb_strtolower(trim($row[$i])));
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        echo SimpleXLSX::parse_error();
                    }
                }
            }
        }
        $result = json_encode($result, JSON_UNESCAPED_UNICODE);
        echo($result);
        Storage::put('public/assets/transliterate/letters.json', $result);

        return redirect(route('lettersIndex'));
    }

    //огрн.онлайн functions
    public function ogrnOnlineFindPerson($surname, $firstname, $middlename, $inn)
    {
        $url             = $this->my_url_encode('интеграция/люди/');
        $param_surname   = $this->my_url_encode('фамилия');
        $param_name      = $this->my_url_encode('имя');
        $param_thirdname = $this->my_url_encode('отчество');
        $param_inn       = $this->my_url_encode('инн');
        $key             = '7tXgQJIUdINRcQsTlLu7TLSyl4QiPA5TsO3aVUsfFUPl7zOCNN7r3GTuWZUiT31A';
        $headers         = [
            "X-ACCESS-KEY: $key"
        ];

        $connection = curl_init();
        curl_setopt(
            $connection,
            CURLOPT_URL,
            'https://xn--c1aubj.xn--80asehdb/' . $url . '?' . $param_surname . '=' . $surname . '&' . $param_name . '=' . $firstname
            . '&' . $param_thirdname . '=' . $middlename . '&' . $param_inn . '=' . $inn
        );
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($connection, CURLOPT_POST, false);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($connection);
        curl_close($connection);

        if ($result) {
            return $result;
        }
    }

    public function ogrnOnlineGetPersonIP($person_id)
    {
        $param_ip = $this->my_url_encode('интеграция/ип/?человек=');
        $key      = '7tXgQJIUdINRcQsTlLu7TLSyl4QiPA5TsO3aVUsfFUPl7zOCNN7r3GTuWZUiT31A';
        $headers  = [
            "X-ACCESS-KEY: $key"
        ];

        $connection = curl_init();
        curl_setopt(
            $connection,
            CURLOPT_URL,
            'https://xn--c1aubj.xn--80asehdb/' . $param_ip . $person_id
        );
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($connection, CURLOPT_POST, false);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($connection);
        curl_close($connection);

        if ($result) {
            return ($result);
        }
    }

    public function ogrnOnlineGetPersonWorkplaces($person_id)
    {
        $url              = $this->my_url_encode('интеграция/люди/');
        $param_workplaces = $this->my_url_encode('/должности/');
        $key              = '7tXgQJIUdINRcQsTlLu7TLSyl4QiPA5TsO3aVUsfFUPl7zOCNN7r3GTuWZUiT31A';
        $headers          = [
            "X-ACCESS-KEY: $key"
        ];

        $connection = curl_init();
        curl_setopt(
            $connection,
            CURLOPT_URL,
            'https://xn--c1aubj.xn--80asehdb/' . $url . $person_id . $param_workplaces
        );
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($connection, CURLOPT_POST, false);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($connection);
        curl_close($connection);

        if ($result) {
            return ($result);
        }
    }

    public function ogrnOnlineGetPersonCompanies($person_id)
    {
        $url             = $this->my_url_encode('интеграция/люди/');
        $param_companies = $this->my_url_encode('/компании/');
        $key             = '7tXgQJIUdINRcQsTlLu7TLSyl4QiPA5TsO3aVUsfFUPl7zOCNN7r3GTuWZUiT31A';
        $headers         = [
            "X-ACCESS-KEY: $key"
        ];

        $connection = curl_init();
        curl_setopt(
            $connection,
            CURLOPT_URL,
            'https://xn--c1aubj.xn--80asehdb/' . $url . $person_id . $param_companies
        );
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($connection, CURLOPT_POST, false);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($connection);
        curl_close($connection);

        if ($result) {
            return ($result);
        }
    }

    public function ogrnOnlineFindCompany($ogrn, $inn, $kpp, $company)
    {
        $url           = $this->my_url_encode('интеграция/компании/');
        $param_company = $this->my_url_encode('наименование');
        $param_ogrn    = $this->my_url_encode('огрн');
        $param_inn     = $this->my_url_encode('инн');
        $param_kpp     = $this->my_url_encode('кпп');
        $key           = '7tXgQJIUdINRcQsTlLu7TLSyl4QiPA5TsO3aVUsfFUPl7zOCNN7r3GTuWZUiT31A';
        $headers       = [
            "X-ACCESS-KEY: $key"
        ];

        $connection = curl_init();
        curl_setopt(
            $connection,
            CURLOPT_URL,
            'https://xn--c1aubj.xn--80asehdb/' . $url . '?' . $param_ogrn . '=' . $ogrn . '&' . $param_inn . '=' . $inn
            . '&' . $param_kpp . '=' . $kpp . '&' . $param_company . '=' . $company
        );
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($connection, CURLOPT_POST, false);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($connection);
        curl_close($connection);

        if ($result) {
            return $result;
        }
    }

    public function ogrnOnlineGetCompany($company_id)
    {
        $url     = $this->my_url_encode('интеграция/компании/');
        $key     = '7tXgQJIUdINRcQsTlLu7TLSyl4QiPA5TsO3aVUsfFUPl7zOCNN7r3GTuWZUiT31A';
        $headers = [
            "X-ACCESS-KEY: $key"
        ];

        $connection = curl_init();
        curl_setopt(
            $connection,
            CURLOPT_URL,
            'https://xn--c1aubj.xn--80asehdb/' . $url . $company_id . '/'
        );
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($connection, CURLOPT_POST, false);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($connection);
        curl_close($connection);

        if ($result) {
            return $result;
        }
    }

    //ajax functions
    public function emp2FindPersonAjax(Request $request)
    {
        $result       = [];
        $surname      = rawurlencode($request->surname);
        $firstname    = rawurlencode($request->firstname);
        $middlename   = rawurlencode($request->middlename);
        $inn          = rawurlencode($request->inn);
        $person_array = json_decode($this->ogrnOnlineFindPerson($surname, $firstname, $middlename, $inn), true);
        if (!empty($person_array)) {
            foreach ($person_array as $key => $person) {
                $person_ip = json_decode($this->ogrnOnlineGetPersonIP($person['id']), true);
                if (!empty($person_ip)) {
                    $result[$person['id']] = $person_ip;
                }
            }
        }

        if ($result) {
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['fail' => 'Error occurred']);
        }
    }

    public function emp2FindCompanyAjax(Request $request)
    {
        $result        = [];
        $company       = rawurlencode($request->company);
        $ogrn          = rawurlencode($request->ogrn);
        $inn           = rawurlencode($request->inn);
        $kpp           = rawurlencode($request->kpp);
        $okopf         = rawurlencode($request->okopf);
        $company_array = json_decode($this->ogrnOnlineFindCompany($ogrn, $inn, $kpp, $company), true);
        if (!empty($company_array)) {
            foreach ($company_array as $key => $company) {
                $company_detail = json_decode($this->ogrnOnlineGetCompany($company['id']), true);
                if (!empty($company_detail)) {
                    if ($okopf) {
                        //dd($company_detail);
                        if (array_key_exists('okopf', $company_detail)) {
                            if(array_key_exists('code', $company_detail['okopf']) && $okopf == $company_detail['okopf']['code']){
                                $result[$company['id']] = $company_detail;
                            }
                        }
                    } else {
                        $result[$company['id']] = $company_detail;
                    }
                }
            }
        }

        if ($result) {
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['fail' => 'Error occurred']);
        }
    }

    public function underwritingPersonAjax(Request $request)
    {
        $surname    = rawurlencode($request->surname);
        $firstname  = rawurlencode($request->firstname);
        $middlename = rawurlencode($request->middlename);
        $inn        = rawurlencode($request->inn);
        $result = json_decode($this->ogrnOnlineFindPerson($surname, $firstname, $middlename, $inn), true);
        if ($result) {
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['fail' => 'Error occurred']);
        }
    }

    public function findIpAjax(Request $request)
    {
        $person_id = $request->person_id;
        $this->ogrnOnlineGetPersonIP($person_id);
    }

    public function underwritingCompanyAjax(Request $request)
    {
        $company = rawurlencode($request->ur_company);
        $ogrn    = rawurlencode($request->ur_ogrn);
        $inn     = rawurlencode($request->ur_inn);
        $kpp     = rawurlencode($request->ur_kpp);
        $result = json_decode($this->ogrnOnlineFindCompany($ogrn, $inn, $kpp, $company), true);
        if ($result) {
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['fail' => 'Error occurred']);
        }
    }

    public function personReadMoreAjax(Request $request)
    {
        $result    = [];
        $person_id = $request->person_id;

        $result['person_workplaces'] = $this->ogrnOnlineGetPersonWorkplaces($person_id);
        $result['person_companies']  = $this->ogrnOnlineGetPersonCompanies($person_id);
        $result['person_ip']         = $this->ogrnOnlineGetPersonIP($person_id);

        if ($result) {
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['fail' => 'Error occurred']);
        }
    }

    public function companyReadMoreAjax(Request $request)
    {
        $company_id = $request->company_id;
        $result = json_decode($this->ogrnonlineGetCompany($company_id), true);
        if ($result) {
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['fail' => 'Error occurred']);
        }
    }

    public function companyFinancicalAjax(Request $request)
    {
        $result           = [];
        $company_id       = $request->company_id;
        $url              = $this->my_url_encode('интеграция/компании/');
        $param_financical = $this->my_url_encode('/финансы/');
        $key              = '7tXgQJIUdINRcQsTlLu7TLSyl4QiPA5TsO3aVUsfFUPl7zOCNN7r3GTuWZUiT31A';
        $headers          = [
            "X-ACCESS-KEY: $key"
        ];

        //Инициализирует сеанс
        $connection = curl_init();
        //Устанавливаем адрес для подключения
        curl_setopt(
            $connection,
            CURLOPT_URL,
            'https://xn--c1aubj.xn--80asehdb/' . $url . $company_id . $param_financical
        );
        //Передаем заголовок
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        //Указываем, что мы будем вызывать методом POST
        curl_setopt($connection, CURLOPT_POST, false);
        //Говорим, что нам необходим результат
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        //Выполняем запрос с сохранением результата в переменную
        $curl_result = curl_exec($connection);
        //Завершает сеанс
        curl_close($connection);
        foreach (json_decode($curl_result) as $number => $item) {
            $counter = 0;
            foreach ($item as $key => $value) {
                if ($key != 'id' && $key != 'moneyCode' && $key != 'year' && $key != 'multiplier' && $key != 'company' && $value != 0) {
                    $code                                                              = substr($key, 1, 4);
                    $title                                                             = FinCodes::where('code', (int)$code)->first()->title;
                    $result['company_financical'][$number]['props'][$counter]['title'] = $title;
                    $result['company_financical'][$number]['props'][$counter]['value'] = $value;
                } elseif ($key == 'moneyCode' && $value == '384') {
                    $result['company_financical'][$number]['money_code'] = ' тыс. руб.';
                } elseif ($key == 'moneyCode' && $value == '385') {
                    $result['company_financical'][$number]['money_code'] = ' млн. руб.';
                } elseif ($key == 'year') {
                    $result['company_financical'][$number]['year'] = $value;
                }
                $counter++;
            }
        }

        if ($result) {
            return $result;
        } else {
            return ('false');
        }
    }

    public function fsspPersonAjax(Request $request)
    {
        $api_key   = 'RHAeX3umAWQy';
        $url       = 'https://api-ip.fssprus.ru/api/v1.0/search/physical';
        $region    = $request->fssp_region;
        $name      = $this->my_url_encode($request->fssp_name);
        $thirdname = $this->my_url_encode($request->fssp_thirdname);
        $surname   = $this->my_url_encode($request->fssp_surname);
        $birthdate = $request->birthdate;
        $headers   = [
            "accept: application/json"
        ];

        //Инициализирует сеанс
        $connection = curl_init();
        //Устанавливаем адрес для подключения
        curl_setopt(
            $connection,
            CURLOPT_URL,
            $url . '?token=' . $api_key . '&region=' . $region . '&firstname=' . $name . '&secondname=' . $thirdname .
            '&lastname=' . $surname . '&birthdate=' . $birthdate
        );
        //Передаем заголовок
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        //Указываем, что мы будем вызывать методом POST
        curl_setopt($connection, CURLOPT_POST, false);
        //Говорим, что нам необходим результат
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        //Выполняем запрос с сохранением результата в переменную
        $result       = curl_exec($connection);
        $company_info = curl_getinfo($connection);
        //Завершает сеанс
        curl_close($connection);

        if ($result) {
            echo $result;
        } else {
            echo json_encode(['fail' => 'Error occurred']);
        }
    }

    public function fsspPersonStatusAjax(Request $request)
    {
        $api_key = 'RHAeX3umAWQy';
        $url     = 'https://api-ip.fssprus.ru/api/v1.0/status';
        $task    = $request->fssp_task;
        $headers = [
            "accept: application/json"
        ];

        //Инициализирует сеанс
        $connection = curl_init();
        //Устанавливаем адрес для подключения
        curl_setopt(
            $connection,
            CURLOPT_URL,
            $url . '?token=' . $api_key . '&task=' . $task
        );
        //Передаем заголовок
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        //Указываем, что мы будем вызывать методом POST
        curl_setopt($connection, CURLOPT_POST, false);
        //Говорим, что нам необходим результат
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        //Выполняем запрос с сохранением результата в переменную
        $result       = curl_exec($connection);
        $company_info = curl_getinfo($connection);
        //Завершает сеанс
        curl_close($connection);

        if ($result) {
            echo $result;
        } else {
            echo json_encode(['fail' => 'Error occurred']);
        }
    }

    public function fsspPersonResultAjax(Request $request)
    {
        $api_key = 'RHAeX3umAWQy';
        $url     = 'https://api-ip.fssprus.ru/api/v1.0/result';
        $task    = $request->fssp_task;
        $headers = [
            "accept: application/json"
        ];

        //Инициализирует сеанс
        $connection = curl_init();
        //Устанавливаем адрес для подключения
        curl_setopt(
            $connection,
            CURLOPT_URL,
            $url . '?token=' . $api_key . '&task=' . $task
        );
        //Передаем заголовок
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        //Указываем, что мы будем вызывать методом POST
        curl_setopt($connection, CURLOPT_POST, false);
        //Говорим, что нам необходим результат
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        //Выполняем запрос с сохранением результата в переменную
        $result       = curl_exec($connection);
        $company_info = curl_getinfo($connection);
        //Завершает сеанс
        curl_close($connection);

        if ($result) {
            echo $result;
        } else {
            echo json_encode(['fail' => 'Error occurred']);
        }
    }

    public function docusignAjax(Request $request)
    {
        $docusign = new DocuSign();
        $docusign->signatureRequestFromTemplate($request->name, $request->email);
    }

    public function nameCheckAjax(Request $request)
    {
        $name          = $request->cyr_name;
        $name_translit = $request->lat_name;
        $success       = false;

        $letters = Transliterate::getLetters();

        $chars = preg_split('//u', $name, null, PREG_SPLIT_NO_EMPTY);

        $result = [''];

        foreach ($chars as $char) {
            $letter = mb_strtolower($char, 'UTF-8');

            if (isset($letters[$letter])) {
                $current_result = $result;
                foreach ($letters[$letter] as $variants_key => $variant) {
                    foreach ($current_result as $result_key => $result_variant) {
                        if ($variants_key === 0) {
                            $result[$result_key] = $result_variant . $variant;
                        } else {
                            $result[] = $result_variant . $variant;
                        }
                    }
                }
            }
        }

        foreach ($result as $item) {
            if (strcasecmp($item, $name_translit) == 0) {
                $success = true;
            }
        }
        if ($success) {
            echo json_encode(['success' => $success]);
        } else {
            echo json_encode(['fail' => 'Error occurred']);
        }
    }
}
