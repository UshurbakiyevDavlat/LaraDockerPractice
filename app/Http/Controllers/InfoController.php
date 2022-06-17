<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class InfoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $infos = Info::all();
        return view('components.infos.index', compact('infos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $users = User::all();
        return view('components.infos.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string',
            'status' => 'int',
            'user_id' => 'int'
        ]);
        try {
            Info::create($request->toArray());
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        return redirect()->route('info.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Info $info
     * @return Response
     */
    public function show(Info $info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Info $info
     * @return Application|Factory|View
     */
    public function edit(Info $info)
    {
        $users = User::all();
        return view('components.infos.edit', compact('users', 'info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Info $info
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function update(Request $request, Info $info)
    {
        $data = $request->validate([
            'title' => 'string',
            'status' => 'int',
            'user_id' => 'int'
        ]);
        try {
            $info->update($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        return redirect()->route('info.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Info $info
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function destroy(Info $info)
    {
        try {
            $info->delete();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        return redirect()->route('info.index');
    }
}
