<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\ValidationException;

class GroupController extends Controller
{

    public function __construct()
    {
        can($this, 'group',['index','create','store','edit','update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //

        return view('admin.groups.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        return view('admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $response = api('api.groups.store', 'POST', $request->except(['_token']), false);
        if (!$response['status']) {
            return back()->withErrors($response['data'])->withInput($request->input());
        } else {
            flash_message('success', __('label.group.add_success'));
            return redirect()->route('admin.groups.edit', ['group' => get_one($response, true)['id']]);
        }
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
        return view('admin.groups.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $response = api(['api.groups.update', ['group' => $id]], 'PUT', $request->except('_token'), false);
        if (!$response['status']) {
            if ($response['code'] === code(ValidationException::class)) return back()->withErrors($response['data']);
        } else {
            flash_message('success', __('label.group.edit_success'));
            return redirect()->route('admin.groups.edit', ['group' => $id]);
        }
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
