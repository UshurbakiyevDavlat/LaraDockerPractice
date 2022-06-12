<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Services\Tag\Service;

class BaseController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new Service();
    }
}
