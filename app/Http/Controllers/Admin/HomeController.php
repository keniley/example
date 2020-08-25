<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show homepage of admin panel
     *
     * @param Illuminate\Http\Request $request
     */
    public function show(Request $request)
    {
        if (Auth::guard('admin')->check() === false) {
            return redirect(route('admin.login'));
        }
        
        return view('admin.homepage');        
    }

    /**
     * Admin fallback method
     */
    public function fallback()
    {
        if (Auth::guard('admin')->check() === false) {
            return redirect(route('admin.login'));
        }

        return view('admin.404');
    }
}
