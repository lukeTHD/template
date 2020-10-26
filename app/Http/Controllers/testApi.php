<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contacts;
use Carbon\Carbon;

class testAPi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return contacts::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return contacts::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getMessage($customerId)
    {
        $list = contacts::where('fromId', $customerId)->orWhere('toId', $customerId)->get();
        foreach ($list as $item) {
            $item->create_at_format = Carbon::parse($item->create_at)->toDateTimeString();
        }
        return $list;
    }

    public function getSumIdCustomerNotSeen()
    {
        $list = contacts::where('status', 0)->distinct('fromId')->count();
        return $list;
    }

    public function getContent()
    {
        $list = contacts::whereNotNull('fromId')->groupBy('fromId')->orderBy('id', 'DESC')->get();
        return $list;
    }
}
