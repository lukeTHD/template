<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Request\RequestInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\PaginationTrait;

class RequestController extends Controller
{

    use PaginationTrait;

    protected $requestRepository;

    public function __construct(RequestInterface $requestRepository)
    {
        can($this,'request',['index','edit','updateStatus']);
        $this->middleware('auth:api');
        $this->requestRepository = $requestRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        //
        if ($request->has('is_pagination') && $request->is_pagination) {
            $this->order_field = 'id';
            $this->order_sort = 'desc';
            $this->params = $request->all();
            $this->query = $this->requestRepository->query();
            $this->field_search = ['uid', 'type', 'status', 'amount', 'sso_id'];
            $this->with = ['user'];

            $this->setStatus('status', true);
            $this->setStatus('search', true);

            $results = $this->getResults();

            return response()->json([
                'meta' => $results[0],
                'data' => $results[1]
            ]);
        }

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => $this->requestRepository->all()
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
    public function show($id)
    {
        //
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => $this->requestRepository->getModel()->with(['user' => function($query) {
                $query->with(['credits','tickets']);
            }])->findOrFail($id)
        ]);
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
