<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Message;
use App\User;

class TicketController extends Controller
{
    public function __construct(Subject $subject, Message $message, User $user)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->user = $user;
    }
    public function index()
    {
        $countSubjects = $this->subject->where('status', '!=', 2)->count();
        return view('tickets.index', compact('countSubjects'));
    }

    public function show($id)
    {
        $subject = $this->subject->with(['messages' => function($query){
            return $query->with('user')->get();
        }])->where('status', '!=', 2)->find($id);//dd($subject->toArray());

        if(empty($subject)){
            abort(404);
        }
        
        $userId = 5;
        $user = $this->user->find($userId);
        return view('tickets.detail', compact('subject', 'user', 'userId'));
    }
}
