<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ProviderProfile;
use App\Models\ServiceCategory;
use App\Models\EmergencyRequest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ServiceCategorySeeder::class);

        $password = Hash::make('12345678');

        // 1. Admin Account
        User::updateOrCreate(
            ['email' => 'admin@seh.com.bd'],
            [
                'name' => 'System Admin',
                'phone' => '+8801700000000',
                'password' => $password,
                'role' => 'admin',
                'area' => 'Dhaka Central',
                'address' => 'Dhaka HQ',
                'is_active' => true,
            ]
        );

        // 2. Customer Account
        $customer = User::updateOrCreate(
            ['email' => 'customer@seh.com.bd'],
            [
                'name' => 'Mr. Rahat Khan',
                'phone' => '+8801711111111',
                'password' => $password,
                'role' => 'customer',
                'area' => 'Dhanmondi',
                'address' => 'House 12, Road 5, Dhanmondi, Dhaka',
                'emergency_email' => 'rahat.emergency@example.com',
                'is_active' => true,
            ]
        );

        // Service Categories Lookup
        $ambulanceCat = ServiceCategory::where('name', 'Ambulance')->first();
        $nurseCat = ServiceCategory::where('name', 'Home Nurse')->first();
        $electricianCat = ServiceCategory::where('name', 'Electrician')->first();
        $bloodCat = ServiceCategory::where('name', 'Blood Donor')->first();
        $plumberCat = ServiceCategory::where('name', 'Plumber')->first();

        // 3. Approved Providers
        $providersData = [
            [
                'user' => [
                    'name' => 'Rapid Care Ambulance',
                    'email' => 'rapidcare@seh.com.bd',
                    'phone' => '+8801712000001',
                    'area' => 'Dhanmondi',
                    'address' => 'Road 27, Dhanmondi, Dhaka',
                ],
                'profile' => [
                    'service_category_id' => $ambulanceCat?->id,
                    'experience_years' => 7,
                    'rating' => 4.9,
                    'total_reviews' => 412,
                    'phone_verified' => true,
                    'phone_verified_at' => now(),
                    'approval_status' => 'approved',
                    'approved_at' => now(),
                    'is_active' => true,
                    'is_available' => true,
                ],
            ],
            [
                'user' => [
                    'name' => 'Dhaka Emergency Ambulance',
                    'email' => 'dhaka.ambulance@seh.com.bd',
                    'phone' => '+8801912567890',
                    'area' => 'Uttara',
                    'address' => 'Sector 4, Uttara, Dhaka',
                ],
                'profile' => [
                    'service_category_id' => $ambulanceCat?->id,
                    'experience_years' => 8,
                    'rating' => 4.8,
                    'total_reviews' => 320,
                    'phone_verified' => true,
                    'phone_verified_at' => now(),
                    'approval_status' => 'approved',
                    'approved_at' => now(),
                    'is_active' => true,
                    'is_available' => true,
                ],
            ],
            [
                'user' => [
                    'name' => 'VoltFix Electricals',
                    'email' => 'voltfix@seh.com.bd',
                    'phone' => '+8801812456789',
                    'area' => 'Mirpur',
                    'address' => 'Mirpur 10, Dhaka',
                ],
                'profile' => [
                    'service_category_id' => $electricianCat?->id,
                    'experience_years' => 9,
                    'rating' => 4.7,
                    'total_reviews' => 288,
                    'phone_verified' => true,
                    'phone_verified_at' => now(),
                    'approval_status' => 'approved',
                    'approved_at' => now(),
                    'is_active' => true,
                    'is_available' => true,
                ],
            ],
            [
                'user' => [
                    'name' => 'LifeLine Blood Network',
                    'email' => 'lifeline@seh.com.bd',
                    'phone' => '+8801755555555',
                    'area' => 'Gulshan',
                    'address' => 'Gulshan 2, Dhaka',
                ],
                'profile' => [
                    'service_category_id' => $bloodCat?->id,
                    'experience_years' => 4,
                    'rating' => 4.9,
                    'total_reviews' => 150,
                    'phone_verified' => true,
                    'phone_verified_at' => now(),
                    'approval_status' => 'approved',
                    'approved_at' => now(),
                    'is_active' => true,
                    'is_available' => true,
                ],
            ],
            [
                'user' => [
                    'name' => 'PipeFix Services',
                    'email' => 'pipefix@seh.com.bd',
                    'phone' => '+8801666666666',
                    'area' => 'Dhanmondi',
                    'address' => 'Road 8A, Dhanmondi, Dhaka',
                ],
                'profile' => [
                    'service_category_id' => $plumberCat?->id,
                    'experience_years' => 5,
                    'rating' => 4.6,
                    'total_reviews' => 110,
                    'phone_verified' => true,
                    'phone_verified_at' => now(),
                    'approval_status' => 'approved',
                    'approved_at' => now(),
                    'is_active' => true,
                    'is_available' => true,
                ],
            ],
        ];

        foreach ($providersData as $p) {
            $user = User::updateOrCreate(
                ['email' => $p['user']['email']],
                array_merge($p['user'], [
                    'password' => $password,
                    'role' => 'provider',
                    'is_active' => true,
                ])
            );

            ProviderProfile::updateOrCreate(
                ['user_id' => $user->id],
                array_merge($p['profile'], [
                    'area' => $p['user']['area'],
                    'address' => $p['user']['address'],
                ])
            );
        }

        // 4. Pending Provider Application for Admin Verification Demo
        $pendingUser = User::updateOrCreate(
            ['email' => 'farzana.akter@seh.com.bd'],
            [
                'name' => 'Nurse Farzana Akter',
                'phone' => '+8801712345678',
                'password' => $password,
                'role' => 'provider',
                'area' => 'Dhanmondi',
                'address' => 'House 45, Road 9, Dhanmondi, Dhaka',
                'is_active' => true,
            ]
        );

        ProviderProfile::updateOrCreate(
            ['user_id' => $pendingUser->id],
            [
                'service_category_id' => $nurseCat?->id,
                'area' => 'Dhanmondi',
                'address' => 'House 45, Road 9, Dhanmondi, Dhaka',
                'experience_years' => 6,
                'rating' => 0,
                'total_reviews' => 0,
                'phone_verified' => true,
                'phone_verified_at' => now(),
                'approval_status' => 'pending',
                'approved_at' => null,
                'is_active' => true,
                'is_available' => false,
            ]
        );

        // 5. Sample Emergency Requests
        if ($customer && $ambulanceCat) {
            EmergencyRequest::updateOrCreate(
                ['reference' => 'REQ-849201'],
                [
                    'customer_id' => $customer->id,
                    'service_category_id' => $ambulanceCat->id,
                    'priority' => 'Critical',
                    'area' => 'Dhanmondi',
                    'address' => 'House 12, Road 5, Dhanmondi, Dhaka',
                    'description' => 'Urgent patient transport needed to Square Hospital due to acute chest pain.',
                    'assigned_provider_id' => null,
                    'status' => 'pending',
                ]
            );
        }
    }
}
