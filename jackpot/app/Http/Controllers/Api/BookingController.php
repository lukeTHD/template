<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Booking\BookingInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{

    protected $bookingRepository;

    public function __construct(BookingInterface $bookingRepository)
    {
        $this->middleware('auth:api');
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->has('id')) {
            if (exists($request->id, 'booking')) {
                $where = ['id' => $request->id, 'uid' => auth()->user()->id];
                if (auth()->user()->group->type === 'super_admin') unset($where['uid']);
                return response()->json(['status' => true,
                    'code' => 0,
                    'message' => 'success',
                    'data' => $this->bookingRepository->getModel()->where($where)->with('tickets')->get()
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'code' => code('NOT_FOUND_RECORD'),
                    'message' => 'failed',
                    'data' => []
                ]);
            }
        }
        //
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => $this->bookingRepository->getModel()->where('uid', auth()->user()->id)->get()
        ]);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        if (exists($id, 'booking')) {
            $where = ['id' => $id, 'uid' => auth()->user()->id];
            if (auth()->user()->group->type === 'super_admin') unset($where['uid']);
            return response()->json(['status' => true,
                'code' => 0,
                'message' => 'success',
                'data' => $this->bookingRepository->getModel()->where($where)->with('tickets')->first()
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => code('NOT_FOUND_RECORD'),
                'message' => 'failed',
                'data' => []
            ]);
        }
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
}
