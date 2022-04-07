<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts.backend_main');
    }

    public function test(){
        // Role::create(['name' => 'Editor']);
        // Permission::create(['name' => 'edit']);
        // $permission = Permission::find(2);
        $role = Role::find(1);
        $user = User::find(1);
        $user->assignRole($role);
    }


}
