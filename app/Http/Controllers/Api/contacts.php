<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\subject;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\contents;

class contacts extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = DB::table('subject')
            ->join('users', 'subject.userId', '=', 'users.id')
            ->select('subject.*', 'users.name', 'users.email')
            ->get();
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        return contents::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $IsSubject = subject::findOrFail($id);
        $IsSubject->status = $request['status'];
        $IsSubject->save();
        return $IsSubject;
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

    public function getContentsByIdTitle($id)
    {
        $result = DB::table('contents')
            ->join('users', 'contents.userId', '=', 'users.id')
            ->select('contents.*', 'users.name', 'users.email')
            ->where('idTitle', $id)
            ->get();
        foreach ($result as $item) {
            $item->create_at_format = Carbon::parse($item->create_at)->diffForHumans();
        }
        return $result;
    }

    public function getTitle($id)
    {
        $result = DB::table('subject')
            ->where('id', '=', $id)
            ->select('contentTitle', 'id', 'status')
            ->get();
        return $result;
    }

    // public function uploadImg(Request $request)
    // {
    //     // $time = $request['time_now'];
    //     $time = time();
    //     $data = [
    //         "link" => $request['link'],
    //         "idTitle" => $request['idTitle'],
    //         "userId" => $request['userId'],
    //         "create_at" => $request['create_at'],
    //         "update_at" => $request['update_at'],
    //         "urlLink" => 'img/contacts/' . $time . '.png',
    //         "content" => $request['content']
    //     ];
    //     $request = $time . '.' . request()->img->getClientOriginalExtension();
    //     request()->img->move(public_path('img/contacts'), $request);
    //     return contents::create($data);
    // }

    public function fillData(Request $request)
    {
        $status = $request->get('status');
        $name = $request->get('name');
        if ($status == 0) {
            $result = DB::table('subject')
                ->join('users', 'subject.userId', '=', 'users.id')
                ->select('subject.*', 'users.name', 'users.email')
                ->where('contentTitle', 'like', "%{$name}%")
                ->get();
        } else {
            $result = DB::table('subject')
                ->join('users', 'subject.userId', '=', 'users.id')
                ->select('subject.*', 'users.name', 'users.email')
                ->where('contentTitle', 'like', "%{$name}%")
                ->where('status', '=', $status)
                ->get();
        }
        return $result;
    }

    public function addContent(Request $request)
    {
        return contents::create($request->all());
    }
}
