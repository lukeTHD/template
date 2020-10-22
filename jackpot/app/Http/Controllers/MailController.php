<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
    //

    public function __construct()
    {
        can($this, 'mail', ['index', 'update']);
    }

    public function index()
    {
        return view('admin.mail.index');
    }

    public function update(Request $request)
    {
        update_setting('mail_html', $request->mail);
        return back()->with(['message' => 'Updated !']);
    }
}
