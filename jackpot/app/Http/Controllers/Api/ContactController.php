<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreContact;
use App\Repositories\Contact\ContactInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\PaginationTrait;

class ContactController extends Controller
{

    use PaginationTrait;

    protected $contactRepository;

    public function __construct(ContactInterface $contactRepository)
    {
        can($this,'contact',['index','edit']);
        $this->contactRepository = $contactRepository;
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
            $this->params = $request->all();
            $this->query = $this->contactRepository->query();
            $this->field_search = ['name'];

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
            'data' => $this->contactRepository->all()
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreContact $request)
    {
        //
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => $this->contactRepository->postContact($request->all())
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
        if(!exists($id,'contacts')) {
            return response()->json([
                'status' => false,
                'code' => code('NOT_FOUND_RECORD'),
                'message' => 'failed',
                'data' => []
            ]);
        }

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => $this->contactRepository->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
