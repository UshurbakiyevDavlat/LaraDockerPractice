<?php

namespace App\Http\Controllers\Tag;

use App\Http\Requests\Tag\StoreRequest;
use Illuminate\Http\RedirectResponse;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->service->store($data);
        return redirect()->route('tag.index');
    }
}
