<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showLogin(Request $request)
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $response = api('api.auth.login', 'POST', $request->all(), false);
        if ($response['status']) {
            extract(get_one($response, true));
            session(['token' => $access_token, 'user' => get_one($user)]);
            return redirect()->route('admin.dashboard.index');
        } else {
            if ($response['code'] === code(\Illuminate\Validation\ValidationException::class)) {
                return back()->withErrors($response['data']);
            } elseif ($response['code'] === code('UNAUTHORIZAED')) {
                return back()->withErrors(['error' => __('label.login_failed') . ' !']);
            }
            return back();
        }
    }

    public function logout(Request $request)
    {
        $response = api('api.auth.logout', 'POST', [], false);
        if ($response['status']) {
            session()->flush();
            return redirect()->route('admin.auth.login');
        }
        return back();
    }

    public function profile()
    {
        return view('admin.auth.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . user()->id,
            'password' => 'nullable|string|max:255|confirmed',
            'current_password' => 'nullable|string|max:255',
        ]);
        $update = [
            'name' => $request->name,
            'email' => $request->email
        ];
        if ($request->has('current_password') && $request->current_password) {
            if (!Hash::check($request->current_password, user()->password)) return back()->withErrors('Current password not correct !');
            if (!$request->password) return back()->withErrors('Password is required !');
            $update['password'] = bcrypt($request->password);
        }
        $this->userRepository->find(user()->id)->update($update);
        flash_message('success mb-0', 'Success !');
        return back();
    }
}
