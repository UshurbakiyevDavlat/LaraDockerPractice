<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\ApiFilterRequest;
use App\Http\Resources\ApiPostResource;
use App\Http\Services\Post\Service;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class PostController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new Service();
    }

    /**
     * Store a newly created resource in storage.
     * @param ApiFilterRequest $request
     * @param Post $post
     * @return ApiPostResource|Application|ResponseFactory|Response
     */
    public function store(ApiFilterRequest $request, Post $post)
    {
        $data = $request->validated();
        return $this->service->store($post, $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ApiFilterRequest $request
     * @param Post $post
     *
     */
    public function update(ApiFilterRequest $request, Post $post): void
    {
        $data = $request->validated();
        $this->service->store($post, $data);
    }
}
