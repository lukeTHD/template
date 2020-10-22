<?php

namespace App\Http\Controllers;

use App\Repositories\Game\GameInterface;
use App\Repositories\GameSettingCode\GameSettingCodeInterface;
use App\Repositories\Vault\VaultInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GameController extends Controller
{

    protected $gameSettingCodeRepository;
    protected $gameRepository;
    protected $vaultRepository;

    public function __construct(GameSettingCodeInterface $gameSettingCodeRepository,GameInterface $gameRepository,VaultInterface $vaultRepository)
    {
        can($this, 'game',['index','create','store','edit','update']);
        $this->gameSettingCodeRepository = $gameSettingCodeRepository;
        $this->gameRepository = $gameRepository;
        $this->vaultRepository = $vaultRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //

        return view('admin.games.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response | \Illuminate\View\View
     */
    public function create()
    {
        //
        $data['game_setting_code'] = $this->gameSettingCodeRepository->getAfter();
        return view('admin.games.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $requestInput = $request->except('_token');
        if (isset($requestInput['sacks'])) $requestInput['sacks'] = json_decode($requestInput['sacks'], true);
        $requestInput['rewards'] = json_decode($requestInput['rewards'], true);

        // Upload avatar
        if (isset($requestInput['avatar'])) {
            $uploadImage = api('api.upload.image', 'POST', ['image' => $requestInput['avatar']], false, 'multipart');
            if ($uploadImage['status']) $requestInput['avatar'] = $uploadImage['data'];
            else $requestInput['avatar'] = null;
        } else $requestInput['avatar'] = null;
        try {
            $response = api('api.games.store', 'POST', $requestInput, false);
            if (!$response['status']) {
                if ($response['code'] === code(ValidationException::class)) return back()->withErrors($response['data'])
                    ->withInput($request->input());
            } else {
                flash_message('success', __('label.game.add_success'));
                return back();
//            return redirect()->route('admin.games.edit', ['game' => get_one($response, true)['id']]);
            }
        } catch (\Exception $exception) {
            dd($exception->getMessage());
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data['game_setting_code'] = $this->gameSettingCodeRepository->getAfter();
        $data['vaults'] = $this->vaultRepository->getVaultsOfGame($this->gameRepository->find($id)->code);
//        dd($data['vaults']);
        return view('admin.games.edit', $data);
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
        $requestInput = $request->except(['_token', '_method']);
        if (isset($requestInput['sacks'])) $requestInput['sacks'] = json_decode($requestInput['sacks'], true);
//        $requestInput['rewards'] = json_decode($requestInput['rewards'], true);
        // Upload avatar

//        dd($requestInput);

        if (isset($requestInput['avatar'])) {
            $uploadImage = api('api.upload.image', 'POST', ['image' => $requestInput['avatar']], false, 'multipart');
            if ($uploadImage['status']) $requestInput['avatar'] = $uploadImage['data'];
            else unset($requestInput['avatar']);
        } else unset($requestInput['avatar']);
        $response = api(['api.games.update', ['game' => $id]], 'PUT', $requestInput, false);
        if (!$response['status']) {
            if ($response['code'] === code(ValidationException::class)) return back()->withErrors($response['data']);
        } else {
            flash_message('success', __('label.game.edit_success'));
            return redirect()->route('admin.games.edit', ['game' => $id]);
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
