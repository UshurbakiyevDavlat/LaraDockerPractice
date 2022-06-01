<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = self::list();
        return view('components.users.index',compact('users'));
    }

    public function create()
    {
        return view('components.users.create');
    }

    public function edit()
    {
        return view('components.users.edit');
    }

    public function list()
    {
        return User::all();
    }

    public function all_and_trashed()
    {
        return User::withTrashed()->get();
    }

    public function show(User $user): User
    {
        return $user;
    }

    public function factory_store()
    {
        try {
            $user = User::factory()->create();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return response(['success' => 1, 'user' => $user]);
    }

    public function store(User $user)
    {
        $data = \request()->validate([
            'name' => 'string',
            'email' => 'email',
            'password' => 'string'
        ]);
        try {
            User::create($data);
        } catch (\Exception $exception) {
            return $exception;
        }
        return $user;
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'name' => 'string',
            'email' => 'string',
            'password' => 'string'
        ]);
        try {
            $user->update($data);
        } catch (\Exception $exception) {
            return $exception;
        }
        return $user;
    }

    public function delete(User $user)
    {
        try {
            $user->delete();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return response(['success' => 1]);
    }
}
