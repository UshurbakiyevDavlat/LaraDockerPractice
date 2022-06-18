<?php

namespace App\Http\Controllers;

use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
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
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws BindingResolutionException
     */
    public function index(FilterRequest $request)
    {
        $data = $request->validated();
        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
        $posts = Post::filter($filter)->paginate(10);
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
        $categories = Category::all();
        $tags = Tag::all();
        return view('components.posts.create', compact('users', 'categories', 'tags'));
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
            'title' => 'required|string',
            'content' => 'required|string',
            'user_id' => 'required|int',
            'image' => 'image|nullable|max: 1999',
            'category_id' => 'required|int',
            'tags' => 'required|array'
        ]);
        $tags = $data['tags'];
        unset($data['tags']);
        $fileNameToStore = $this->img_upload(\request());

        try {
            $data['image'] = $fileNameToStore;
            $post = Post::create($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        try {
            $post->tags()->attach($tags, ['created_at' => date('Y-m-d H:i:s')]);
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
        $tags = Tag::all();
        $categories = Category::all();
        return view('components.posts.edit', compact('post', 'users', 'tags', 'categories'));
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
        $fileNameToStore = $this->img_upload(\request());
        $data = $request->validate([
            'title' => 'string',
            'content' => 'string',
            'user_id' => 'int',
            'category_id' => 'int',
            'tags' => 'array'
        ]);
        $data['image'] = $fileNameToStore;
        $tags = $data['tags'];
        unset($data['tags']);
        try {
            $post->update($data);
            $post->tags()->sync($tags);
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
            $filenameWithExt = $request->file('image')->getClientOriginalName();

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
