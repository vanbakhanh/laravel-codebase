<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Profile::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Super admin
        User::factory(1)->create([
            'email' => 'admin@email.com',
        ])->each(function ($user) {
            $user->profile()->save(Profile::factory()->make());
            $user->assignRole(config('authorization.roles.super-admin'));
        });

        // User
        User::factory(5)->create()->each(function ($user, $key) {
            $user->update(['email' => 'user+' . ($key + 1) . '@email.com']);
            $user->profile()->save(Profile::factory()->make());
        });
    }
}
