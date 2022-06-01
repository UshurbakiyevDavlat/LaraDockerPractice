<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('components.users.index');
    }

    public function getUsers()
    {
        return User::all();
    }

    public function getUsersWithTrashed()
    {
        return User::withTrashed()->get();
    }

    public function getUser(Request $request)
    {
        $user = User::find($request->id);
        return $user;
    }

    public function factory_create()
    {
        try {
            $user = User::factory()->create();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return response(['success' => 1, 'user' => $user]);
    }

    public function create(Request $data)
    {
        try {
            $user = User::create($data->toArray());
        } catch (\Exception $exception) {
            return $exception;
        }
        return $user;
    }

    public function edit(Request $changed_data)
    {
        try {
            $user = User::find($changed_data->id);
            $user->update($changed_data->toArray());
        } catch (\Exception $exception) {
            return $exception;
        }
        return $user;
    }

    public function delete(Request $request)
    {
        try {
            $user = User::find($request->id);
            $user->delete();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return response(['success' => 1]);
    }
}
