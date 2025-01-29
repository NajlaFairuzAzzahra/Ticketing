<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;


class AdminDepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all(); // 🔥 Pastikan ini ada


        return view('admin.departments.index', compact('departments'));
    }
}
