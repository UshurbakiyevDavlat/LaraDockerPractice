<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        try {
            Tag::create($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        return redirect()->route('tag.index');
    }
}
