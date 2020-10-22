<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListTemplate;

class ListTemplateController extends Controller
{
    public function list_template()
    {
        $page_title = 'List Template';
        $page_description = 'This is list template page';
        $list_template = ListTemplate::all();

        return view('template.list_template', compact('page_title', 'page_description', 'list_template'));
    }
}
