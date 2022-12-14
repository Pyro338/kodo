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

    // ?????????????? ???????????????? ???????????? ?????? URL
    public function my_url_encode($s)
    {
        $s = strtr(
            $s,
            array(
                " " => "%20",
                "??" => "%D0%B0",
                "??" => "%D0%90",
                "??" => "%D0%B1",
                "??" => "%D0%91",
                "??" => "%D0%B2",
                "??" => "%D0%92",
                "??" => "%D0%B3",
                "??" => "%D0%93",
                "??" => "%D0%B4",
                "??" => "%D0%94",
                "??" => "%D0%B5",
                "??" => "%D0%95",
                "??" => "%D1%91",
                "??" => "%D0%81",
                "??" => "%D0%B6",
                "??" => "%D0%96",
                "??" => "%D0%B7",
                "??" => "%D0%97",
                "??" => "%D0%B8",
                "??" => "%D0%98",
                "??" => "%D0%B9",
                "??" => "%D0%99",
                "??" => "%D0%BA",
                "??" => "%D0%9A",
                "??" => "%D0%BB",
                "??" => "%D0%9B",
                "??" => "%D0%BC",
                "??" => "%D0%9C",
                "??" => "%D0%BD",
                "??" => "%D0%9D",
                "??" => "%D0%BE",
                "??" => "%D0%9E",
                "??" => "%D0%BF",
                "??" => "%D0%9F",
                "??" => "%D1%80",
                "??" => "%D0%A0",
                "??" => "%D1%81",
                "??" => "%D0%A1",
                "??" => "%D1%82",
                "??" => "%D0%A2",
                "??" => "%D1%83",
                "??" => "%D0%A3",
                "??" => "%D1%84",
                "??" => "%D0%A4",
                "??" => "%D1%85",
                "??" => "%D0%A5",
                "??" => "%D1%86",
                "??" => "%D0%A6",
                "??" => "%D1%87",
                "??" => "%D0%A7",
                "??" => "%D1%88",
                "??" => "%D0%A8",
                "??" => "%D1%89",
                "??" => "%D0%A9",
                "??" => "%D1%8A",
                "??" => "%D0%AA",
                "??" => "%D1%8B",
                "??" => "%D0%AB",
                "??" => "%D1%8C",
                "??" => "%D0%AC",
                "??" => "%D1%8D",
                "??" => "%D0%AD",
                "??" => "%D1%8E",
                "??" => "%D0%AE",
                "??" => "%D1%8F",
                "??" => "%D0%AF"
            )
        );

        return $s;
    }

    // ?????????????? ?????????????????????? ???????????? ???? URL
    public function my_url_decode($s)
    {
        $s = strtr(
            $s,
            array(
                "%20"    => " ",
                "%D0%B0" => "??",
                "%D0%90" => "??",
                "%D0%B1" => "??",
                "%D0%91" => "??",
                "%D0%B2" => "??",
                "%D0%92" => "??",
                "%D0%B3" => "??",
                "%D0%93" => "??",
                "%D0%B4" => "??",
                "%D0%94" => "??",
                "%D0%B5" => "??",
                "%D0%95" => "??",
                "%D1%91" => "??",
                "%D0%81" => "??",
                "%D0%B6" => "??",
                "%D0%96" => "??",
                "%D0%B7" => "??",
                "%D0%97" => "??",
                "%D0%B8" => "??",
                "%D0%98" => "??",
                "%D0%B9" => "??",
                "%D0%99" => "??",
                "%D0%BA" => "??",
                "%D0%9A" => "??",
                "%D0%BB" => "??",
                "%D0%9B" => "??",
                "%D0%BC" => "??",
                "%D0%9C" => "??",
                "%D0%BD" => "??",
                "%D0%9D" => "??",
                "%D0%BE" => "??",
                "%D0%9E" => "??",
                "%D0%BF" => "??",
                "%D0%9F" => "??",
                "%D1%80" => "??",
                "%D0%A0" => "??",
                "%D1%81" => "??",
                "%D0%A1" => "??",
                "%D1%82" => "??",
                "%D0%A2" => "??",
                "%D1%83" => "??",
                "%D0%A3" => "??",
                "%D1%84" => "??",
                "%D0%A4" => "??",
                "%D1%85" => "??",
                "%D0%A5" => "??",
                "%D1%86" => "??",
                "%D0%A6" => "??",
                "%D1%87" => "??",
                "%D0%A7" => "??",
                "%D1%88" => "??",
                "%D0%A8" => "??",
                "%D1%89" => "??",
                "%D0%A9" => "??",
                "%D1%8A" => "??",
                "%D0%AA" => "??",
                "%D1%8B" => "??",
                "%D0%AB" => "??",
                "%D1%8C" => "??",
                "%D0%AC" => "??",
                "%D1%8D" => "??",
                "%D0%AD" => "??",
                "%D1%8E" => "??",
                "%D0%AE" => "??",
                "%D1%8F" => "??",
                "%D0%AF" => "??"
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
                                        if (trim($row[$i]) == '????????????????????') {
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

    //????????.???????????? functions
    public function ogrnOnlineFindPerson($surname, $firstname, $middlename, $inn)
    {
        $url             = $this->my_url_encode('????????????????????/????????/');
        $param_surname   = $this->my_url_encode('??????????????');
        $param_name      = $this->my_url_encode('??????');
        $param_thirdname = $this->my_url_encode('????????????????');
        $param_inn       = $this->my_url_encode('??????');
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
        $param_ip = $this->my_url_encode('????????????????????/????/???????????????=');
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
        $url              = $this->my_url_encode('????????????????????/????????/');
        $param_workplaces = $this->my_url_encode('/??????????????????/');
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
        $url             = $this->my_url_encode('????????????????????/????????/');
        $param_companies = $this->my_url_encode('/????????????????/');
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
        $url           = $this->my_url_encode('????????????????????/????????????????/');
        $param_company = $this->my_url_encode('????????????????????????');
        $param_ogrn    = $this->my_url_encode('????????');
        $param_inn     = $this->my_url_encode('??????');
        $param_kpp     = $this->my_url_encode('??????');
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
        $url     = $this->my_url_encode('????????????????????/????????????????/');
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
        $url              = $this->my_url_encode('????????????????????/????????????????/');
        $param_financical = $this->my_url_encode('/??????????????/');
        $key              = '7tXgQJIUdINRcQsTlLu7TLSyl4QiPA5TsO3aVUsfFUPl7zOCNN7r3GTuWZUiT31A';
        $headers          = [
            "X-ACCESS-KEY: $key"
        ];

        //???????????????????????????? ??????????
        $connection = curl_init();
        //?????????????????????????? ?????????? ?????? ??????????????????????
        curl_setopt(
            $connection,
            CURLOPT_URL,
            'https://xn--c1aubj.xn--80asehdb/' . $url . $company_id . $param_financical
        );
        //???????????????? ??????????????????
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        //??????????????????, ?????? ???? ?????????? ???????????????? ?????????????? POST
        curl_setopt($connection, CURLOPT_POST, false);
        //??????????????, ?????? ?????? ?????????????????? ??????????????????
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        //?????????????????? ???????????? ?? ?????????????????????? ???????????????????? ?? ????????????????????
        $curl_result = curl_exec($connection);
        //?????????????????? ??????????
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
                    $result['company_financical'][$number]['money_code'] = ' ??????. ??????.';
                } elseif ($key == 'moneyCode' && $value == '385') {
                    $result['company_financical'][$number]['money_code'] = ' ??????. ??????.';
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

        //???????????????????????????? ??????????
        $connection = curl_init();
        //?????????????????????????? ?????????? ?????? ??????????????????????
        curl_setopt(
            $connection,
            CURLOPT_URL,
            $url . '?token=' . $api_key . '&region=' . $region . '&firstname=' . $name . '&secondname=' . $thirdname .
            '&lastname=' . $surname . '&birthdate=' . $birthdate
        );
        //???????????????? ??????????????????
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        //??????????????????, ?????? ???? ?????????? ???????????????? ?????????????? POST
        curl_setopt($connection, CURLOPT_POST, false);
        //??????????????, ?????? ?????? ?????????????????? ??????????????????
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        //?????????????????? ???????????? ?? ?????????????????????? ???????????????????? ?? ????????????????????
        $result       = curl_exec($connection);
        $company_info = curl_getinfo($connection);
        //?????????????????? ??????????
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

        //???????????????????????????? ??????????
        $connection = curl_init();
        //?????????????????????????? ?????????? ?????? ??????????????????????
        curl_setopt(
            $connection,
            CURLOPT_URL,
            $url . '?token=' . $api_key . '&task=' . $task
        );
        //???????????????? ??????????????????
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        //??????????????????, ?????? ???? ?????????? ???????????????? ?????????????? POST
        curl_setopt($connection, CURLOPT_POST, false);
        //??????????????, ?????? ?????? ?????????????????? ??????????????????
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        //?????????????????? ???????????? ?? ?????????????????????? ???????????????????? ?? ????????????????????
        $result       = curl_exec($connection);
        $company_info = curl_getinfo($connection);
        //?????????????????? ??????????
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

        //???????????????????????????? ??????????
        $connection = curl_init();
        //?????????????????????????? ?????????? ?????? ??????????????????????
        curl_setopt(
            $connection,
            CURLOPT_URL,
            $url . '?token=' . $api_key . '&task=' . $task
        );
        //???????????????? ??????????????????
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        //??????????????????, ?????? ???? ?????????? ???????????????? ?????????????? POST
        curl_setopt($connection, CURLOPT_POST, false);
        //??????????????, ?????? ?????? ?????????????????? ??????????????????
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        //?????????????????? ???????????? ?? ?????????????????????? ???????????????????? ?? ????????????????????
        $result       = curl_exec($connection);
        $company_info = curl_getinfo($connection);
        //?????????????????? ??????????
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
