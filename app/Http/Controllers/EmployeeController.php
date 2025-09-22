<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
public function index(Request $request)
{
    if (!$request->filled('company_id')) {
        return redirect()->route('company.index')
            ->with('error', 'Silakan pilih company dulu.');
    }
    $company = Company::findOrFail($request->company_id);

    $employees = Employee::where('companies_id', $request->company_id)->latest()->paginate(10)->withQueryString();

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
            'logo'         => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
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

        return redirect()->route('employee.index', ['company_id' => $request->companies_id])->with('success', 'Employee berhasil ditambahkan');
    }

    public function edit(Request $request, $employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $company = Company::find($request->company_id ?? $employee->companies_id);

        return view('employee.edit', compact('employee', 'company'));
    }
    public function update(Request $request, $employeeId)
    {
        $employee = Employee::findOrFail($employeeId);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'logo'  => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'companies_id' => 'nullable|exists:companies,id',
        ]);


            $logoPath = $request->file('logo') ? $request->file('logo')->store('logos', 'public') : $employee->logo;

            $employee->update([
                'name'        => $request->name,
                'email'       => $request->email,
                'phone'       => $request->phone,
                'logo'        => $logoPath,
                'description' => $request->description,
                'companies_id' => $request->companies_id,
            ]);

            return redirect()->route('employee.index', ['company_id' => $request->companies_id])->with('success', 'Employee berhasil ditambahkan');
    }

    public function destroy(Request $request, $employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $employee->delete();

        // ambil company_id dari form / querystring
        $companyId = $request->company_id ?? $employee->companies_id;

        return redirect()->route('employee.index', ['company_id' => $companyId])->with('success', 'Employee berhasil dihapus');
    }


}
