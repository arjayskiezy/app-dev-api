<?php

namespace App\Http\Controllers;

use App\Services\UsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    private UsersService $userService;

    public function __construct(UsersService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        return $this->userService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->userService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return $this->userService->show($request);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->userService->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->userService->destroy($request);
    }
}
