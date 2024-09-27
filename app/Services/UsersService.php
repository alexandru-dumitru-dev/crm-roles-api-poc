<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UsersService
{
    public function listPaginated(Request $request)
    {
        $take = 10;
        $page = request()->get('page', 1);
        $users = User::with('roles')->take($take)->skip(($page - 1) * $take)->get();
        $total = User::count();
        $totalPages = ceil($total / $take);
        return (new UserCollection($users))
            ->setTotal($total)
            ->setTotalPages($totalPages)
            ->setCurrentPage($page);
    }

    public function details(User $user)
    {
        return new UserResource($user);
    }

    public function create(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create($request->input());
            $role = Role::findOrFail($request->get('role_id'));
            $user->assignRole($role->name);
            DB::commit();
            return new UserResource($user);
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }
    }

    public function update(User $user, UserRequest $request)
    {

        DB::beginTransaction();
        try {
            $user->update($request->input());
            $role = Role::find($request->get('role_id'));
            if ($role) {
                $user->sycRoles([$role->name]);
            }
            DB::commit();
            return new UserResource($user);
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }
    }

    public function delete(User $user)
    {
        return $user->delete();
    }
}
