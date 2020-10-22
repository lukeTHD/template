<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;
use App\Setting;
use GuzzleHttp\Client;
use Faker\Factory;
use App\Game;

// Get config from config.php file
if (!function_exists('_config')) {
    function _config($key)
    {
        return config("config.{$key}");
    }
}

// Api consumer
if (!function_exists('api')) {
    /**
     * @var string|array $route
     */
    function api($route, string $method = 'GET', array $parameters = [], bool $isGetData = true, string $typeForm = 'query', string $queryString = '')
    {
        if (!is_array($route)) $url = route($route, []);
        else $url = route($route[0], $route[1]);
        $client = new \GuzzleHttp\Client();
        $headers['Accept'] = 'application/json';

        if (session()->has('token') && session('token')) {
            $headers['Authorization'] = 'Bearer ' . session('token');
        }

        $options = [
            'headers' => $headers
        ];

        $options['verify'] = false;

        if ($parameters) {
            if ($typeForm === 'multipart') {
                $options['multipart'] = convert_query($parameters);
            } else if ($typeForm === 'query') {
                $options['query'] = $parameters;
            }
        }

        $response = $client->request($method, $url . $queryString, $options)->getBody()->getContents();
        $data = gettype($response) === 'string' ? json_decode($response, true) : $response;
        return $isGetData ? $data['data'] : $data;
    }
}

if (!function_exists('convert_query')) {
    function convert_query($parameters)
    {
        $params = [];
        foreach ($parameters as $name => $param) {
            if ($param instanceof \Illuminate\Http\UploadedFile) {
                $params[] = [
                    'name' => $name,
                    'contents' => $param->get(),
                    'filename' => $param->getClientOriginalName()
                ];
            }
        }
        return $params;
    }
}

if (!function_exists('add_query_to_url')) {
    function add_query_to_url($newQueries)
    {
        $currentQueries = request()->query();
        $allQueries = array_merge($currentQueries, $newQueries);
        return request()->fullUrlWithQuery($allQueries);
    }
}

// Return code in config.php key code
if (!function_exists('code')) {
    function code($key)
    {

        return config('code')[$key];
    }
}

// Is Route name from api
if (!function_exists('is_route_api')) {
    function is_route_api($routeName)
    {
        return explode('.', $routeName)[0] === 'api';
    }
}

// Get current route name
if (!function_exists('current_route_name')) {
    function current_route_name()
    {
        return \Request::route()->getName();
    }
}

// Is active sidebar item
if (!function_exists('active_sidebar')) {
    function active_sidebar($routeName, array $queryString = [], bool $isSubmenu = false, string $class = 'kt-menu__item--active', string $classOpen = ' kt-menu__item--open')
    {
        if (!is_array($routeName)) {
            $routeName = [$routeName];
        }
        $compare = array_search(current_route_name(), $routeName) !== false ? $class . ($isSubmenu ? $classOpen : '') : '';

        if ($queryString && $compare) {
            foreach ($queryString as $key => $value) {
                if (!compare_query_string($key, $value)) return false;
            }
        }

        return $compare;
    }
}

// Get param from route
if (!function_exists('param')) {
    function param($param)
    {
        return \Request::route($param);
    }
}

// Get first element of array
if (!function_exists('get_one')) {
    function get_one($data, $pointToData = false)
    {
        if ($pointToData) $data = $data['data'];
        return isset($data[0]) ? $data[0] : null;
    }
}

// Flash message
if (!function_exists('flash_message')) {
    function flash_message($alertType, $message)
    {
        session()->flash('alert-class', 'alert-solid-' . $alertType);
        session()->flash('message', $message);
    }
}

// Get path by route name without parameters
if (!function_exists('_route')) {
    function _route($name, $parameters = ['id' => null], $absolute = true)
    {
        return route($name, $parameters, $absolute);
    }
}

// Is exists record in table
if (!function_exists('exists')) {
    function exists(int $id, string $table = 'users')
    {
        return DB::table($table)->where('id', $id)->exists();
    }
}

// Compare query string
if (!function_exists('compare_query_string')) {
    function compare_query_string(string $key, string $value)
    {
        $request = app('request');
        return $request->has($key) && $request->$key === $value;
    }
}

// Check token
if (!function_exists('check_token')) {
    function check_token($token, $returnUser = false)
    {
        try {
            $user = JWTAuth::setToken($token)->toUser();
            return $returnUser ? $user : $user->id;
        } catch (Exception $e) {
            return false;
        }
    }
}

// Get user
if (!function_exists('user')) {
    function user()
    {
        if (session()->has('token')) {
            if ($user = check_token(session('token'), true)) {
                return $user;
            }
        }
        return null;
    }
}

// Set http headers
if (!function_exists('set_headers')) {
    function set_headers(array $headers)
    {
        if ($headers) {
            foreach ($headers as $key => $value) {
                app('request')->headers->set($key, $value);
            }
        }
    }
}

//
if (!function_exists('setting')) {
    function setting($code, $uid = 0)
    {
        $instance = Setting::where('code', $code);
        if ($instance->exists()) {
            $setting = $instance->first();
            if ($setting->type === 'system') return $setting;
            elseif ($setting->type === 'user') {
                if ($uid === 0) {
                    return $setting;
                } else if ($uid > 0) {
                    $instance = $setting->user_setting()->where([
                        'setting_code' => $code,
                        'uid' => $uid
                    ]);
                    if ($instance->exists()) {
                        return $instance->first();
                    }
                    return $setting;
                }
            }
        }
        return false;
    }
}

// update setting
if (!function_exists('update_setting')) {
    function update_setting($code, $value, $uid = 0)
    {
        $instance = Setting::where('code', $code);
        if ($instance->exists()) {
            $setting = $instance->first();
            if ($setting->type === 'system') return $instance->update(['value' => $value]);
            elseif ($setting->type === 'user') {
                if ($uid === 0) {
                    return $instance->update(['value' => $value]);
                } else if ($uid > 0) {
                    $instance = $setting->user_setting()->where([
                        'setting_code' => $code,
                        'uid' => $uid
                    ]);
                    if ($instance->exists()) {
                        return $instance->update(['value' => $value]);
                    }
                    return $setting->user_setting()->create([
                        'value' => $value,
                        'setting_code' => $code,
                        'uid' => $uid
                    ]);
                }
            }
        }
        return false;
    }
}

// setting api
if (!function_exists('setting_api')) {
    function setting_api($field = '', $getValue = true, $getOne = true)
    {
        if ($field) $response = api(['api.settings.index', ['field' => $field]], 'GET', [], false);
        else $response = api('api.settings.index', 'GET', [], false);
        if ($response['status']) {
            $setting = $getOne ? get_one($response, true) : $response;
            return $getValue ? $setting['value'] : $setting;
        }
        return null;
    }
}

// auth user

if (!function_exists('me')) {
    function me($key, $default = null)
    {
        if (session()->has('user')) return Arr::get(session('user'), $key, $default);
        return null;
    }
}


if (!function_exists('l')) {
    function l(string $str)
    {
        return Str::lower($str);
    }
}

if (!function_exists('u')) {
    function u(string $str)
    {
        return Str::upper($str);
    }
}

if (!function_exists('uf')) {
    function uf(string $str)
    {
        return Str::ucfirst($str);
    }
}

if (!function_exists('convert_array')) {
    function convert_array($array, $key = 'code', $value = 'value')
    {
        return collect($array)->mapWithKeys(function ($item) use ($key, $value) {
            return [$item[$key] => $item[$value]];
        });
    }
}

if (!function_exists('settings')) {
    function settings()
    {
        $settings = convert_array(setting_api('', false, false)['data']);;
        return $settings;
    }
}

if (!function_exists('timezone')) {
    function timezone($selected = '', $name = 'timezone')
    {
        $OptionsArray = timezone_identifiers_list();
        $select = '<select name="' . $name . '" class="form-control selectpicker" data-live-search="true">';
        foreach ($OptionsArray as $key => $row) {
            $select .= '<option value="' . $row . '"';
            $select .= ($row === $selected ? ' selected' : '');
            $select .= '>' . $row . '</option>';
        }
        $select .= '</select>';
        return $select;
    }
}

if (!function_exists('can')) {
    function can($class, $table, $abilities = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
    {
        foreach ($abilities as $ability) {
            $class->middleware('can:' . $table . '-' . $ability, ['only' => [$ability]]);
        }
    }
}

if (!function_exists('filename_upload')) {
    function filename_upload($originalName)
    {
        return str_replace(' ', '', time() . '_' . $originalName);
    }
}

if (!function_exists('upload')) {
    function upload($file)
    {
        if (!is_null($file)) {
            $fileName = filename_upload($file->getClientOriginalName());
            if ($file->move('uploads', $fileName)) return $fileName;
        }
        return null;
    }
}

if (!function_exists('faker')) {
    function faker()
    {
        return Factory::create();
    }
}

if (!function_exists('games')) {
    function games()
    {
        return Game::all()->toArray();
    }
}

if (!function_exists('game')) {
    function game($id)
    {
        return Game::with('game_rewards')->findOrFail($id)->toArray();
    }
}

if (!function_exists('vault')) {
    function vault($code, $isGet = true)
    {
        $instance = \App\Vault::where('game_code', $code);
        return $instance->exists() ? ($isGet ? $instance->first() : $instance) : null;
    }
}

if (!function_exists('currency')) {
    function currency()
    {
        return 'EUSDT';
    }
}

if (!function_exists('_count')) {
    function _count($table = 'users')
    {
        return \Illuminate\Support\Facades\DB::table($table)->count();
    }
}

if (!function_exists('array_from')) {
    function array_from($from, $to, $step = 1, $except = [])
    {
        $array = [];
        for ($i = $from; $i <= $to; $i = $i + $step) {
            $i = (string)$i;
            if ($i < 10) $i = "0" . $i;
            if (!in_array($i, $except)) $array[$i] = $i;
        }
        return $array;
    }
}


if (!function_exists('get_token_from_api')) {
    function get_token_from_api($request)
    {
        $client = new \GuzzleHttp\Client();
        $responseToken = $client->request('POST', 'https://id.elegend.io/connect/token', [
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => 'jackpot.elegend.io',
                'client_secret' => 'jackpot.elegend.io@123',
                'code' => $request->code,
                'redirect_uri' => route('client.user.callback'),
                'code_challenge' => $request->code_challenge,
                'code_verifier' => $request->code_verifier
            ]
        ])->getBody()->getContents();
        return json_decode($responseToken, true);
    }
}

if (!function_exists('is_agency')) {
    function is_agency($sso_token)
    {
        $client = new \GuzzleHttp\Client();
        $responseToken = $client->request('GET',
            'https://eas.elegend.io/api-mobile/api/v1/public/get-user-level?token=' . $sso_token, [
                'verify' => false,
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ])->getBody()->getContents();
        $data = json_decode($responseToken, true);
        if($data['status'] === 'Success' && $data['data']['level'] > 0) return true;
        return false;
    }
}

if (!function_exists('get_user_by_token_from_api')) {
    function get_user_by_token_from_api($token)
    {
        $client = new \GuzzleHttp\Client();
        $reponseUser = $client->request('GET', 'https://id.elegend.io/connect/userinfo', [
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token['access_token']
            ]
        ])->getBody()->getContents();
        return json_decode($reponseUser, true);
    }
}

if (!function_exists('auth_client')) {

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed|null
     */
    function auth_client()
    {
        if (session()->has('data_client') && session()->has('is_auth_client')) {
            return session('data_client');
        }
        return null;
    }
}
if (!function_exists('format_number_money')) {
    function format_number_money(float $money = 0)
    {
        return round($money, 8);
//        return round($money, 2);
//        return $money;
    }
}

if (!function_exists('meta_box')) {
    function meta_box($key)
    {
        $value = Cache::remember('metabox', 10800, function () {
            return collect(DB::table('meta_box')->select(['meta_key', 'meta_value'])->get()->toArray())->mapWithKeys(function ($value) {
                return [$value->meta_key => $value->meta_value];
            })->toArray();
        });

        if (isset($value[$key])) return nl2br(htmlspecialchars($value[$key]));
        return $key;
    }
}

if (!function_exists('credit')) {
    function credit($currency)
    {
        if (session()->has('data_client')) {
            return app(\App\Repositories\User\UserInterface::class)->myCredit(session('data_client')['id'], $currency)->value;
        }
        return null;
    }
}

if (!function_exists('numberFormat')) {
    function numberFormat($number)
    {
        return number_format(floor($number * 100) / 100, 2);
    }
}
