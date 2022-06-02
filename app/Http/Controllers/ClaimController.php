<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('components.claims.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('components.claims.create');
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
            ''
        ]);
        try {
            Claim::create($request->toArray());
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        return redirect()->route('components.claims.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Claim $claim
     * @return Application|Factory|View
     */
    public function show(Claim $claim)
    {
        return view('components.claims.detail',compact('claim'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Claim $claim
     * @return Application|Factory|View
     */
    public function edit(Claim $claim)
    {
        return view('components.claims.edit', compact('claim'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Claim $claim
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function update(Request $request, Claim $claim)
    {
        $data = $request->validate([
            ''
        ]);
        try {
            $claim->update($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Claim $claim
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function destroy(Claim $claim)
    {
        try {
            $claim->delete();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        return redirect()->route('components.claims.index');
    }
}
