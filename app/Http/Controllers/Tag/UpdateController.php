<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\UpdateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Tag $tag)
    {
        $data = $request->validated();
        try {
            $tag->update($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        return redirect()->route('tag.index');
    }
}
