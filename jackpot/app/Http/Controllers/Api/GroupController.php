<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\Http\Requests\StoreGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\PaginationTrait;

class GroupController extends Controller
{
    use PaginationTrait;

    protected $group;

    public function __construct(Group $group)
    {
        can($this, 'group',['index','create','store','edit','update']);
        $this->group = $group;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->has('is_pagination') && $request->is_pagination) {
            $this->params = $request->all();
            $this->query = $this->group->query();
            $this->field_search = ['name'];

            $this->setStatus('status', false);
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
            'data' => $this->group->all()
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreGroup $request)
    {
        //
        $group = $this->group->addGroup($request->all());

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => [$group]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => [$this->group->with('roles')->findOrFail($id)]
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => $this->group->updateGroup($id, $request->all())
        ]);
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
