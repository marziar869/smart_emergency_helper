<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Emergency Group
            ['group_name' => 'Emergency', 'name' => 'Ambulance', 'is_active' => true],
            ['group_name' => 'Emergency', 'name' => 'Blood Donor', 'is_active' => true],
            ['group_name' => 'Emergency', 'name' => 'Home Nurse', 'is_active' => true],

            // Technical Group
            ['group_name' => 'Technical', 'name' => 'Electrician', 'is_active' => true],
            ['group_name' => 'Technical', 'name' => 'Plumber', 'is_active' => true],
            ['group_name' => 'Technical', 'name' => 'AC Technician', 'is_active' => true],

            // Home Group
            ['group_name' => 'Home', 'name' => 'Locksmith', 'is_active' => true],
            ['group_name' => 'Home', 'name' => 'Cleaner', 'is_active' => true],
            ['group_name' => 'Home', 'name' => 'Carpenter', 'is_active' => true],
        ];

        foreach ($categories as $category) {
            ServiceCategory::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
