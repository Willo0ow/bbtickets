<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function retrieveDepartmentUsers($dept){
        return User::where('department', $dept)->select('id', 'name', 'position')->get();
    }
    public function retrieveUser(){
        return Auth::user();
    }
}
