<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Caffeinated\Flash\Facades\Flash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('username')->get();
        return view('user.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    public function create()
    {
        $user = new User;
        return view('user.create', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'is_admin' => 'boolean',
        ]);
        User::register($request->all());
        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'username' => ['required', 'max:255', Rule::unique('users')->ignore($id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'is_admin' => 'boolean',
        ]);
        $user = User::findOrFail($id);
        $user->fill($request->all());
        $user->save();
        if ($request->has('reset_password')) {
            $user->sendResetLink();
        }
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->removeFromSystem();
        return redirect()->route('user.index');
    }

    public function createAccessToken($id)
    {
        $user = User::findOrFail($id);
        session()->forget('accessToken');
        
        return view('token.create', compact('user'));
    }

    public function storeAccessToken(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => ['required', 'max:255'],
        ]);

        $token = $user->createToken($request->name);
        $tokenUser = $token->plainTextToken;

        session(['accessToken' => $tokenUser]);

        return redirect()->route('user.token.show', [$user->id]);
    }

    public function showAccessToken(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $tokenUser = session('accessToken');

        if (is_null($tokenUser)) {
            return redirect()->route('profile.show');
        }

        return view('token.show', compact('tokenUser'));
    }

    public function revokeAccessToken($id, $token)
    {
        $user = User::findOrFail($id);
        $user->tokens()->where('id', $token)->delete();
        notify()->success('Token revoked successfully');

        return redirect()->route('user.show', $id)->with('success', 'Revoked token successfull!');
    }
}
