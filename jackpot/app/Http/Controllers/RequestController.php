<?php

namespace App\Http\Controllers;

use App\Helpers\Eticket\Major;
use App\Repositories\Request\RequestInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{

    protected $major;
    protected $requestRepository;

    protected $acceptStatus = [
        'fail' => true,
        'success' => true
    ];

    public function __construct(RequestInterface $requestRepository, Major $major)
    {
        can($this, 'request', ['index', 'edit', 'updateStatus','updateMode']);
        $this->requestRepository = $requestRepository;
        $this->major = $major;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
//        dd($this->requestRepository->getModel()->with('user')->get()->toArray());
        return view('admin.requests.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //
        return view('admin.requests.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:success,fail'
        ]);

        if (exists($id, 'requests')) {
            $requestWithdraw = $this->requestRepository->find($id);
            if ($requestWithdraw->status === 'pending') {
                if ($request->status === 'success') {
                    if (env('APP_ENV') === 'production') {
                        $resutl_withdraw = $this->major->wallet_withdraw_user($requestWithdraw->sso_id,
                            $requestWithdraw->currency, $requestWithdraw->amount,
                            $requestWithdraw->sso_id . ' withdraw amount: ' . $requestWithdraw->amount);

//                    dd($resutl_withdraw);
                    } else {
                        $resutl_withdraw = true;
                    }

                    if (!$resutl_withdraw) {
                        return back()->with(['error' => 'error of money withdraw on elegend!']);
                    }
                    $data_credit = [
                        "uid" => $requestWithdraw->uid,
                        "currency" => $requestWithdraw->currency,
                        "amount" => $requestWithdraw->amount
                    ];
                    $result_update = $this->requestRepository->updateStatus($id, $request->status, $data_credit);
//            dd($result_update);
                    if (!$result_update) {
                        return back()->with(['error' => 'error update status!']);
                    }
                } else if ($request->status === 'fail') {
                    $requestWithdraw->update([
                        'status' => 'fail'
                    ]);
                }
            }


            return back()->with(['message' => __('label.success')]);
        }
        return back();
    }

    public function updateMode(Request $request) {
        $request->validate([
            'mode' => 'required|in:auto,manually'
        ]);

        update_setting('withdraw_request_method',$request->mode);

        return back()->with(['message' => 'success']);
    }
}
