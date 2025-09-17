<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
public function index(Request $request)
{
    $company = null;
    $query = Employee::query();

    if ($request->filled('company_id')) {
        $query->where('companies_id', $request->company_id);
        $company = Company::find($request->company_id);
    }

    $employees = $query->paginate(10)->withQueryString();
    return view('employee.index', compact('employees', 'company'));
}


public function create()
{
    return view('employee.create');
}
public function store(Request $request)
{
    $request->validate([
        'name'         => 'required|string|max:255',
        'email'        => 'nullable|email',
        'phone'        => 'nullable|string|max:20',
        'logo'         => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        'companies_id' => 'nullable|exists:companies,id',
    ]);

    // Proses upload logo (kalau ada)
    $logoPath = null;
    if ($request->hasFile('logo')) {
        // simpan di storage/app/public/employees
        $logoPath = $request->file('logo')->store('employees', 'public');
    }

    Employee::create([
        'name'         => $request->name,
        'email'        => $request->email,
        'phone'        => $request->phone,
        'logo'         => $logoPath, // simpan pathnya
        'companies_id' => $request->companies_id,
    ]);

    return redirect()->route('employee.index', ['company_id' => $request->companies_id])
        ->with('success', 'Employee berhasil ditambahkan');
}

public function update(Request $request, $employeeId)
{
    $employee = Employee::findOrFail($employeeId);

    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'nullable|email',
        'phone' => 'nullable|string|max:20',
        'logo'  => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    ]);

    $data = $request->only('name','email','phone');

    // jika upload logo baru
    if ($request->hasFile('logo')) {
        $data['logo'] = $request->file('logo')->store('employees', 'public');
    }

    $employee->update($data);

    return redirect()->route('employee.index', ['company_id' => $employee->companies_id])
        ->with('success', 'Employee berhasil diupdate');
}


public function destroy(Request $request, $employeeId)
{
    $employee = Employee::findOrFail($employeeId);
    $employee->delete();

    $companyId = $request->company_id; // ambil dari form
    return redirect()
        ->route('employee.index', ['company_id' => $companyId])
        ->with('success', 'Employee berhasil dihapus');
}


}
