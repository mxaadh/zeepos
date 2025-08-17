<?php

namespace App\Http\Controllers;

use App\Models\SysClientLink;
use App\Support\TenantDatabase;
use Illuminate\Http\Request;

class ConnectController extends Controller
{
    public function index()
    {
        return view('connect.index');
    }

    public function connection(Request $request)
    {
        // 1) Pull client row
        $client = SysClientLink::where('CompanyCode', $request->client)->get()->first();
//        dd($client);

        // 2) Build a dynamic "tenant" connection
        TenantDatabase::connect($client, 'tenant');

        // 3) Store tenant info in session for later use (middleware can auto-connect each request)
        session([
            'company_code' => $client->CompanyCode,
            'company_name' => $client->CompanyName,
            'db_name'      => $client->DBname,
        ]);

        // 4) Redirect user to login page
        return redirect()->route('login')
            ->with('status', "Connected to {$client->CompanyName}. Please login.");
    }
}
