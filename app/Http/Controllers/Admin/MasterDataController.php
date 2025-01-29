<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function index()
    {
        return view('admin.master-data.index');
    }

    public function create()
    {
        return view('admin.master-data.create');
    }

    public function store(Request $request)
    {
        return view('admin.master-data.create');
    }


    public function update(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        return redirect()->route('admin.master-data.index')->with('success', 'Kategori berhasil diupdate.');
    }

}
