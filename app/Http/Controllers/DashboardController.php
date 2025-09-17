<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;

class DashboardController extends Controller
{
public function index()
{
    $totalCompanies = Company::count();
    $totalEmployees = Employee::count();
    $latestCompanies = Company::latest()->take(5)->get();
    $latestEmployees = Employee::latest()->take(5)->get();

    return view('dashboard', compact(
        'totalCompanies',
        'totalEmployees',
        'latestCompanies',
        'latestEmployees'
    ));
}

}
