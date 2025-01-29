<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminClientController extends Controller
{
    public function index()
    {
        $clients = User::where('role_id', 3)->get(); // Role 3 adalah Client
        return view('admin.clients.index', compact('clients'));
    }
}
