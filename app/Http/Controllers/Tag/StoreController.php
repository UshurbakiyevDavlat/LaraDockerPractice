<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|int'
        ]);
        try {
            Tag::create($request->only('name', 'status'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response('error see logs');
        }
        return redirect()->route('tag.index');
    }
}
