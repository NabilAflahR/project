<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Employee;

class CompanyEmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat 10 company
        $companies = Company::factory(10)->create();

        // 2. Untuk tiap company, buat 10 employee
        foreach ($companies as $company) {
            Employee::factory(10)->create([
                'companies_id' => $company->id, // pastikan kolom di DB sesuai
            ]);
        }
    }
}
