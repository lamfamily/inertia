<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TestController extends Controller
{
    /*
     * test: tailwindcss custom class
     * @author: Justin Lin
     * @date : 2025-04-22 14:32:42
     */
    public function test1()
    {
        return Inertia::render('Test/Test1');
    }
}
