<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Role::all();
    }
}
