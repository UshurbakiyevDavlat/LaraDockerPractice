<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|int'
        ]);
        try {
            $tag->update($request->only('name', 'status'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        return redirect()->route('tag.index');
    }
}
