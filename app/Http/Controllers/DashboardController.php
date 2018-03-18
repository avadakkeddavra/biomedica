<?php

namespace App\Http\Controllers;

use App\Model\Analysis;
use Illuminate\Http\Request;
use LiqPay;

class DashboardController extends Controller
{
    public function index()
    {
        $analysis = Analysis::all();
        return view('dashboard',['analysis' => $analysis]);
    }
}
