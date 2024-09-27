<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
 use App\Models\User;
use App\Services\UsersService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UsersService $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function index(Request $request)
    {
        $this->authorize('list', User::class);
        return $this->usersService->listPaginated($request);
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        return $this->usersService->details($user);
    }

    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);
        return $this->usersService->create($request);
    }

    public function update(User $user, UserRequest $request)
    {
        $this->authorize('update', $user);
        return $this->usersService->update($user, $request);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        return $this->usersService->delete($user);
    }
}
