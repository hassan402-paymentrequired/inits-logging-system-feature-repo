<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{

    /**
     * Summary of index
     * @return void
     */
    public function index(): View
    {
        return view('dash'); //TODO: remove welcome
    }
    
}
