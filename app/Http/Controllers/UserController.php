<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $limit = (int)($request->limit);
        $result = $this->service->getUserPaginate($limit);
        return response()->json($result);
    }
}
