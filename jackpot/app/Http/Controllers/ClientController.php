<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class ClientController extends Controller
{
    //
    public function cacheFlush() {
        Cache::flush();
        Artisan::call('optimize');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        return back();
    }

    public function optimize() {
        Artisan::call('optimize');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        return back();
    }
}
