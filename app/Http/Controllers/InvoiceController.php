<?php

namespace App\Http\Controllers;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoices.index');
    }
}
