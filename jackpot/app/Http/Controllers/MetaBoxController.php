<?php

namespace App\Http\Controllers;

use App\Repositories\MetaBox\MetaBoxInterface;
use Illuminate\Http\Request;

class MetaBoxController extends Controller
{

    protected $metaBoxRepository;

    public function __construct(MetaBoxInterface $metaBoxRepository)
    {
        can($this,'metabox',['index','store']);
        $this->metaBoxRepository = $metaBoxRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $instance = $this->metaBoxRepository->all()->toArray();
        $metabox = collect($instance)->map(function ($value) {
            return collect($value)->only(['meta_key', 'meta_value'])->toArray();
        })->toJson();
        return view('admin.metabox.index', ['metabox' => $metabox]);
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
        $metabox = collect(json_decode($request->metabox, true))->filter(function ($value) {
            return !empty($value['meta_key']) && !empty($value['meta_value']);
        })->map(function ($value) {
            $value['created_at'] = now();
            return $value;
        })->toArray();

        $this->metaBoxRepository->query()->forceDelete();
        $this->metaBoxRepository->getModel()->insert($metabox);

        flash_message('success', 'Success');

        return back();
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
