<?php

namespace App\Http\Controllers;

use App\Repositories\CreditActivity\CreditActivityInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{

    protected $creditActivityRepository;

    public function __construct(CreditActivityInterface $creditActivityRepository)
    {
        can($this,'user',['index','create','store','edit','update']);
        $this->creditActivityRepository = $creditActivityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response | \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response | \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \Illuminate\Http\JsonResponse | \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $response = api('api.users.store', 'POST', $request->except('_token'), false);
        if (!$response['status']) {
            return back()->withErrors($response['data'])->withInput($request->except(['password', 'password_confirmation']));
        } else {
            $user = $response['data'];
            flash_message('success mb-0', __('label.user.add_success'));
            return redirect()->route('admin.users.edit', ['user' => $user['id']]);
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
     * @return \Illuminate\Http\Response | \Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        //
        $data['credit_activities'] = $this->creditActivityRepository->getCreditAcitivitesByUserId($id);
        return view('admin.users.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response | \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $response = api(['api.users.update', ['user' => $id]], 'PUT', $request->all(), false);
        if (!$response['status']) {
            return back()->withErrors($response['data'])->withInput($request->except(['password', 'password_confirmation']));
        } else {
            flash_message('success mb-0 ', __('label.user.edit_success'));
            return back();
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
