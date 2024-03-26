<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $names = User::latest()->pluck('email');
        
        return response([
            'profile' => $names,
        ], 200);
    }
}