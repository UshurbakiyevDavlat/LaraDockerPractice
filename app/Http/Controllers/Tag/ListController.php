<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class ListController extends Controller
{
    public function __invoke()
    {
       return Tag::all();
    }
}
