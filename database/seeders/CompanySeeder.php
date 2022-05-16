<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companys = ['Everfirst', 'FMLC', 'MBI', 'MSC', 'MSC Davao', 'MSC Cebu', 'WorldCraft'];

        foreach($companys as $company) {
            Company::create([
                'company_name' => $company
            ]);
        }
    }
}
