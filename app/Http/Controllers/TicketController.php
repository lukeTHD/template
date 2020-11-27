<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Message;
use App\User;
use Carbon\Carbon;

class TicketController extends Controller
{
    public function __construct(Subject $subject, Message $message, User $user)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->user = $user;
    }

    public function getDashboard()
    {
        $totalSubjects = $this->subject->where('status', '!=', 2)->count();
        $countSubjectsByStatus = $this->subject->where('status', '!=', 2)->where('status', 1)->count();
        $percentStatusClose = $countSubjectsByStatus * 100 / $totalSubjects;//dd($percentStatusClose);

        $newSubjects = $this->subject->where('status', '!=', 2)->latest()
        ->with(['user:id,display_name,email', 'messageOne'])->skip(0)->take(10)->get();//dd($limitSubjects->toArray());
        $subjectsExpired = $this->subject->where('status', '!=', 2)->where('status', 0)
        ->whereDate('created_at', '<=', Carbon::now()->subDays(10))
        ->with(['user:id,display_name,email', 'messageOne'])->skip(0)->take(10)->get();//dd($subjectsExpired->toArray());
        return view('tickets.dashboard', compact('percentStatusClose', 'newSubjects', 'subjectsExpired'));
    }

    public function index()
    {
        return view('tickets.index');
    }

    public function show($id)
    {
        $subject = $this->subject->with(['user:id,display_name,email', 'messages' => function($query){
            return $query->with('user:id,display_name,email')->get();
        }])->where('status', '!=', 2)->find($id);//dd($subject->toArray());
        //dd($subject->toArray());
        if(empty($subject)){
            abort(404);
        }
        
        $userId = 1;
        $user = $this->user->find($userId);
        return view('tickets.detail', compact('subject', 'user', 'userId'));
    }
}
