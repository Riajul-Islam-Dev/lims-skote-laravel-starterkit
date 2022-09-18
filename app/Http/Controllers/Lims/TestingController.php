<?php

namespace App\Http\Controllers\Lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function testing(Request $request)
    {
        dd('check');
    }
}
