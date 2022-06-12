<?php

namespace App\Http\Controllers\Tag;

use App\Http\Requests\Tag\UpdateRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Tag $tag): RedirectResponse
    {
        $data = $request->validated();
        $this->service->update($tag, $data);
        return redirect()->route('tag.index');
    }
}
