<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Message;
use App\Subject;


class SubjectController extends Controller
{
    public function __construct(Subject $subject, Message $message){
        $this->subject = $subject;
        $this->message = $message;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->subject->with('user')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->subject->find($id);
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
        $subject = $this->subject->findOrFail($id);
        $subject->update(['status' => $request['status']]);
        return $subject;
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

    /**
     * Get all messages.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAllMessage($id)
    {
        $result = $this->message->with('user')->where('subject_id', $id)->get()
        ->map(function($value){
            $value->created_at_format = Carbon::parse($value->created_at)->diffForHumans();
            if($value->created_at_format === '1 day ago'){
                $value->created_at_format = Carbon::parse($value->created_at)->toDayDateTimeString();
            }
            return $value;
        });
        return $result;
    }

    /**
     * Search subject.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fillData(Request $request)
    {
        $status = $request->get('status');
        $content = $request->get('content');
        if ($status == 0) {
            $result = $this->subject->with('user')->where('content', 'LIKE', "%{$content}%")->get();
            
        } else {
            $result = $this->subject->with('user')->where('content', 'LIKE', "%{$content}%")->where('status', $status)->get();
            
        }
        return $result;
    }

    public function storeMessage(Request $request)
    {
        return $this->message->create($request->all());
    }
}
