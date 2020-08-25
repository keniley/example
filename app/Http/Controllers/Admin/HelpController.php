<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    /**
     * Show detail of help
     *
     * @param Illuminate\Http\Request $request
     * @param string $id
     */
    public function show(Request $request, string $id)
    {
        return view('admin.help', ['id' => $id]);        
    }
}
