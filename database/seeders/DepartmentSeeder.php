<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;


class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [
                'company_id' => 1,
                'department_name' => 'Admin'
            ],
            [
                'company_id' => 1,
                'department_name' => 'PID'
            ],
            [
                'company_id' => 1,
                'department_name' => 'Sales'
            ],
            [
                'company_id' => 1,
                'department_name' => 'Warehouse'
            ],

            [
                'company_id' => 2,
                'department_name' => 'Admin'
            ],
            [
                'company_id' => 2,
                'department_name' => 'PID'
            ],
            [
                'company_id' => 2,
                'department_name' => 'Sales'
            ],
            [
                'company_id' => 2,
                'department_name' => 'Warehouse'
            ],

            [
                'company_id' => 3,
                'department_name' => 'Admin'
            ],
            [
                'company_id' => 3,
                'department_name' => 'PID'
            ],
            [
                'company_id' => 3,
                'department_name' => 'Sales'
            ],
            [
                'company_id' => 3,
                'department_name' => 'Warehouse'
            ],

            [
                'company_id' => 4,
                'department_name' => 'Admin'
            ],
            [
                'company_id' => 4,
                'department_name' => 'PID'
            ],
            [
                'company_id' => 4,
                'department_name' => 'Sales'
            ],
            [
                'company_id' => 4,
                'department_name' => 'Warehouse'
            ],

            [
                'company_id' => 5,
                'department_name' => 'Admin'
            ],
            [
                'company_id' => 5,
                'department_name' => 'PID'
            ],
            [
                'company_id' => 5,
                'department_name' => 'Sales'
            ],
            [
                'company_id' => 5,
                'department_name' => 'Warehouse'
            ],
            [
                'company_id' => 6,
                'department_name' => 'Admin'
            ],
            [
                'company_id' => 6,
                'department_name' => 'PID'
            ],
            [
                'company_id' => 6,
                'department_name' => 'Sales'
            ],
            [
                'company_id' => 6,
                'department_name' => 'Warehouse'
            ],
            [
                'company_id' => 7,
                'department_name' => 'Admin'
            ],
            [
                'company_id' => 7,
                'department_name' => 'PID'
            ],
            [
                'company_id' => 7,
                'department_name' => 'Sales'
            ],
            [
                'company_id' => 7,
                'department_name' => 'Warehouse'
            ],

            [
                'company_id' => 8,
                'department_name' => 'MSC'
            ],
      
    
        ];

        foreach ($departments as $department) {
            Department::create([
                'company_id' => $department['company_id'],
                'department_name' => $department['department_name'],
            ]);
        }
    }
}
