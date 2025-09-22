<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // Tampilkan semua company
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('company.index', compact('companies'));
    }

    public function create()
    {
        return view('company.create');
    }

    // Simpan company baru
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'nullable|email',
            'logo'        => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'description' => 'nullable|string'
        ]);

        $logoPath = $request->file('logo') ? $request->file('logo')->store('logos', 'public') : null;

        Company::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'logo'        => $logoPath,
            'description' => $request->description,
        ]);

        return redirect()->route('company.index')->with('success', 'Company berhasil ditambahkan');
    }

    // Form edit company
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('company.edit', compact('company'));
    }

    // Update company
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'nullable|email',
            'logo'        => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'description' => 'nullable|string'
        ]);

        $logoPath = $request->file('logo') ? $request->file('logo')->store('logos', 'public') : $company->logo;

        $company->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'logo'        => $logoPath,
            'description' => $request->description,
        ]);

        return redirect()->route('company.index')->with('success', 'Company berhasil diupdate');
    }

    // Hapus company
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('company.index')->with('success', 'Company berhasil dihapus');
    }
}
