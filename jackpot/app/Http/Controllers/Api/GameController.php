<?php

namespace App\Http\Controllers\Api;

use App\Game;
use App\Http\Requests\StoreGame;
use App\Http\Requests\UpdateGame;
use App\Repositories\Game\GameInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session\Store;
use Illuminate\Validation\ValidationException;
use App\Traits\PaginationTrait;

class GameController extends Controller
{

    use PaginationTrait;

    protected $gameRepository;

    public function __construct(GameInterface $gameRepository)
    {
        can($this, 'game',['index','create','store','edit','update']);
        $this->middleware('auth:api');
        $this->gameRepository = $gameRepository;
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
            $this->query = $this->gameRepository->query();
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
            'data' => $this->gameRepository->all()
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
    public function store(StoreGame $request)
    {
        //
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => $this->gameRepository->create($request->all())
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
            'data' => $this->gameRepository->getModel()->with(['games_config', 'sacks'])->findOrFail($id)
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
    public function update(UpdateGame $request, $id)
    {
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => $this->gameRepository->update($id, $request->all())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id = null)
    {
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success.',
            'data' => $this->gameRepository->getModel()->where('id', $id)->delete()
        ]);
    }
}
