<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        User::factory()->create();
        DB::table('personal_access_tokens')->insert([
            'name' => "API TOKEN",
            'tokenable_type' => "App\Models\User",
            'tokenable_id' => 1,
            'token' => "16618ac893a2918538d850444584e934325eb891fa1f44a8afc34d8dc0dc2a1",
            'abilities' => "*",
            'last_used_at' => now(),
        ]);
    }
}
