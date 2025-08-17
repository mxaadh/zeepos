<?php

namespace App\Http\Controllers;

use App\Models\Tenant\Client;
use App\Models\Tenant\TenantUser;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $info = Client::first();
        return view('home', [
            'info' => $info,
        ]);
    }
}
