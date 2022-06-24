<?php

namespace App\Http\Services\Post;

use App\Http\Resources\ApiPostResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Service
{
    public function store($post, $data)
    {
        $tags = $data['tags'];
        $category = $data['category'];

        $data['user_id'] = auth()->user()->getAuthIdentifier();
        unset($data['tags'], $data['category']);

        try {
            DB::beginTransaction();

            $tagIds = $this->getTagIds($tags);
            $catId = $this->getCatIds($category);
            $data['category_id'] = $catId;

            $post = $post->create($data);
            $post->tags()->attach($tagIds, ['created_at' => date('Y-m-d H:i:s')]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            return response(['message'=>'error_see_logs'],400);
        }
        return new ApiPostResource($post);
    }

    public function update($post, $data)
    {
        $tags = $data['tags'];
        unset($data['tags']);
        try {
            $post->update($data);
            $post->tags()->sync($tags);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        return $post->refresh();
    }

    private function getCatIds ($category) {
        $category = Category::firstOrCreate(['title' => $category['title']],$category);
        return $category->id;
    }

    private function getTagIds ($tags): array
    {
        $tagIds = [];
        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag['name']], $tag);
            $tagIds[] = $tag->id;
        }
        return $tagIds;
    }
}
