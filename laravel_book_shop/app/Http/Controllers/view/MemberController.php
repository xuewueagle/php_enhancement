<?php

namespace App\Http\Controllers\view;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    
    public function login(Request $request){
        
        return view('login');
    }
    
    public function register(Request $request){
        
        return view('register');
    }
}
