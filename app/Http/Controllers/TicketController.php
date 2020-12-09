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
        $fCode = session()->get('f_code');
        $totalSubjects = $this->subject->where('status', '!=', 2)->where('owner', $fCode)->count();
        $countSubjectsByStatus = $this->subject->where('status', '!=', 2)->where('status', 1)->where('owner', $fCode)->count();
        $percentStatusClose = $countSubjectsByStatus * 100 / $totalSubjects;//dd($percentStatusClose);

        $newSubjects = $this->subject->where('status', '!=', 2)->where('owner', $fCode)->latest()
        ->with(['messageOne'])->skip(0)->take(10)->get();//dd($limitSubjects->toArray());
        $subjectsExpired = $this->subject->where('status', '!=', 2)->where('owner', $fCode)->where('status', 0)
        ->whereDate('created_at', '<=', Carbon::now()->subDays(10))
        ->with(['messageOne'])->skip(0)->take(10)->get();//dd($subjectsExpired->toArray());
        return view('tickets.dashboard', compact('percentStatusClose', 'newSubjects', 'subjectsExpired'));
    }

    public function index()
    {
        $user = session()->get('profile');
        $fCode = session()->get('f_code');
        return view('tickets.index', compact('user', 'fCode'));
    }

    public function show($id)
    {
        $fCode = session()->get('f_code');
        $user = session()->get('profile');

        $subject = $this->subject->with('messages')->where('status', '!=', 2)->find($id);//dd($subject->toArray());
        //dd($subject->toArray());
        if(empty($subject) || ($subject['user_id'] != $user['Id'] && $user['Id'] != $fCode)){
            abort(404);
        }
        //dd(session()->get('profile'));
        return view('tickets.detail', compact('subject', 'user', 'fCode'));
    }


}
