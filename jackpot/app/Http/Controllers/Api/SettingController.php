<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingController extends Controller
{
    protected $setting;

    public function __construct(Setting $setting)
    {
        can($this,'setting',['index','update']);
        $this->middleware('auth:api');
        $this->setting = $setting;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response | \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->has('field') && setting($request->field) !== false) {
            return response()->json([
                'status' => true,
                'code' => 0,
                'message' => 'success',
                'data' => [setting($request->field, auth()->user()->id)]
            ]);
        }

        $settings = $this->setting->with(['user_setting' => function($query) {
            $query->where('uid', auth()->user()->id);
        }])->get();

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => collect($settings)->map(function($value) {
                if(isset($value['user_setting'][0])) {
                    $value['value'] = $value['user_setting'][0]['value'];
                }
                unset($value['user_setting']);
                return $value;
            })
        ]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response | \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $user_id = auth()->user()->id;
        foreach ($request->all() as $key => $value) {
            update_setting($key, $value, $user_id);
        }
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => []
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
