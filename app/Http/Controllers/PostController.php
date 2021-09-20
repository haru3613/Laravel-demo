<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;

class PostController extends Controller
{
    protected $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function create(Request $request)
    {
        $result = $this->service->create($request->all());
        return response()->json($result);
    }
}
