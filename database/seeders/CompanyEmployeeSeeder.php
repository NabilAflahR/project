<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class CompanyEmployeeSeeder extends Seeder
{
    public function run()
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            Employee::factory()->count(10)->create([
                'companies_id' => $company->id
            ]);
        }
    }
}

