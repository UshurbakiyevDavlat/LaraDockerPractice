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

    public function list()
    {
        return User::all();
    }

    public function all_and_trashed()
    {
        return User::withTrashed()->get();
    }

    public function show(Request $request)
    {
        $user = User::find($request->id);
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

    public function store(Request $data)
    {
        try {
            $user = User::create($data->toArray());
        } catch (\Exception $exception) {
            return $exception;
        }
        return $user;
    }

    public function update(Request $changed_data)
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
