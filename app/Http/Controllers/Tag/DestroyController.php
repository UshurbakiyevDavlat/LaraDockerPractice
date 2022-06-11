<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;

class DestroyController extends Controller
{
    public function __invoke(Tag $tag)
    {
        try {
            $tag->delete();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        return redirect()->route('tag.index');
    }
}
