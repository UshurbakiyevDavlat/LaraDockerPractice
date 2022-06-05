<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
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
        $posts = Post::all();
        return view('components.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $users = User::all();
        return view('components.posts.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Post $post
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function store(Post $post)
    {
        $data = \request()->validate([
            'title' => 'string',
            'content' => 'string',
            'user_id' => 'int',
            'image' => 'image|nullable|max: 1999'
        ]);

        $fileNameToStore = self::img_upload(\request());

        try {
            $data['image'] = $fileNameToStore;
            Post::create($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function show(Post $post)
    {
        return view('components.posts.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        $users = User::all();
        return view('components.posts.edit', compact('post', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function update(Request $request, Post $post)
    {
        $fileNameToStore = self::img_upload(\request());
        $data = $request->validate([
            'title' => 'string',
            'content' => 'string',
            'user_id' => 'int'
        ]);
        $data['image'] = $fileNameToStore;
        try {
            $post->update($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        return redirect()->route('post.index');
    }

    public function img_upload($request): string
    {
        if ($request->hasFile('image')) {
            $filenameWithExt =$request->file('image')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $path = $request->file('image')->storeAs('public/image', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        return $fileNameToStore;
    }
}
