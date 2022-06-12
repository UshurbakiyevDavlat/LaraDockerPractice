<?php

namespace App\Http\Services\Tag;

use App\Models\Tag;
use Illuminate\Support\Facades\Log;

class Service
{
    public function store($data)
    {
        try {
            Tag::create($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
    }

    public function update($tag, $data)
    {
        try {
            $tag->update($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
    }
}
