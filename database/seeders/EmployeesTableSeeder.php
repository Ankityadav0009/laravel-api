<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'name'  =>  'Shahzaib',
            'email' =>  'm.shahzaib3242@gmail.com',
            'salary' => '600'
        ]);

        Employee::create([
            'name'  =>  'Media',
            'email' =>  'media@gmail.com',
            'salary' => '700'
        ]);

        Employee::create([
            'name'  =>  'Muhammad',
            'email' =>  'customer@gmail.com',
            'salary' => '1000'
        ]);
    }
}
