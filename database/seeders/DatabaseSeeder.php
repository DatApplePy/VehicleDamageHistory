<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DamageEvent;
use App\Models\SearchHistory;
use App\Models\User;
use App\Models\Vehicle;
use DateTime;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = collect();
        $users -> add(User::factory() -> create(
            [
                'email' => 'admin@szerveroldali.hu',
                'is_admin' => true,
                'is_premium' => true
            ]
        ));
        $users -> add(User::factory() -> create(
            [
                'email' => 'premium@szerveroldali.hu',
                'is_admin' => false,
                'is_premium' => true
            ]
        ));
        $users -> add(User::factory() -> create(
            [
                'email' => 'user@szerveroldali.hu',
                'is_admin' => false,
                'is_premium' => false
            ]
        ));

        $vehicles = Vehicle::factory(10) -> create();
        
        for ($i = 1; $i < 10; $i++) {

            $selected_vehicles = $vehicles -> random(rand(1, $vehicles -> count()));
            $latest_year = $selected_vehicles -> pluck('production_year') -> max();
            $randYear = rand($latest_year, now() -> year);
            $new_date_time = new DateTime(fake() -> dateTime() -> format($randYear."-m-d h:i:s"));

            $damageEvent = DamageEvent::factory() -> create([
                'date' => $new_date_time
            ]);
            $damageEvent -> vehicles() -> sync(
                $selected_vehicles -> pluck('id')
            );
        }

        for ($i = 1; $i < 10; $i++) {
            SearchHistory::factory() -> create(
                [
                    'user_id' => $users -> random(),
                    'license_plate' => $vehicles -> random() -> license_plate
                ]
            );
        }
    }
}
