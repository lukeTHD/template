<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Http\Resources\ImportCollection;
use App\Http\Resources\UserCollection;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Traits\PaginationTrait;


class UserController extends Controller
{

    use PaginationTrait;

    protected $user;
    protected $userRepository;

    public function __construct(User $user, UserInterface $userRepository)
    {
        can($this,'user',['index','create','store','edit','update']);
        $this->user = $user;
        $this->middleware('auth:api');
        $this->userRepository = $userRepository;
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
            $this->query = $this->user->query();
            $this->field_search = ['name', 'email'];
            $this->with = ['group'];

//            $this->setStatus('status', false);
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
            'data' => $this->user->with('tickets')->with(['credits' => function ($query) {
                $query->with('credit_activities');
            }])->get()
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
    public function store(StoreUser $request)
    {
        $user = $this->user->addUser($request->all());

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => $user
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
//        $user = $this->user;
//        $userResponse = $user->with('group')->findOrFail($id);
//        $userResponse['user_info'] = json_decode($userResponse['user_info'], true);
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => $this->userRepository->getModel()->where('id', $id)->with(['tickets','credits','group'])->first()
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
    public function update(UpdateUser $request, $id)
    {
        $user = $this->user->updateUser($id, $request->all());
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => [$user]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response | \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id = null)
    {

        if($id == auth()->user()->id || in_array(auth()->user()->id,$request->ids)) {
            return response()->json([
                'status' => false,
                'code' => code('OTHER_ERROR'),
                'message' => 'failed',
                'data' => []
            ]);
        }

        if ($id) {
            if ($this->user->deleteUser($id)) {
                return response()->json([
                    'status' => true,
                    'code' => 0,
                    'message' => 'success',
                    'data' => []
                ]);
            }
        }

        if ($request->ids) {
            return response()->json([
                'status' => true,
                'code' => 0,
                'message' => 'success',
                'data' => $this->user->deleteUsers($request->ids)
            ]);
        }

        return response()->json([
            'status' => false,
            'code' => code('OTHER_ERROR'),
            'message' => 'failed',
            'data' => []
        ]);
    }
}
