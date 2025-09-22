<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;

class DashboardController extends Controller
{
public function index()
{
    $totalCompanies = Company::count();
    $totalEmployees = \App\Models\Employee::count();

    $latestCompanies = Company::latest()->take(5)->get();
    $latestEmployees = \App\Models\Employee::latest()->take(5)->get();

    $companiesWithEmployee = Company::all()->map(function($company) {
        return [
            'name' => $company->name,
            'employees' => $company->employees()->count(),
        ];
    });

    return view('dashboard', compact(
        'totalCompanies',
        'totalEmployees',
        'latestCompanies',
        'latestEmployees',
        'companiesWithEmployee'
    ));
}


}
