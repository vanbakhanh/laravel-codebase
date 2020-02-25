<?php

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Profile::truncate();

        // Super admin
        factory(User::class, 1)->create([
            'email' => 'admin@email.com',
        ])->each(function ($user) {
            $user->profile()->save(factory(Profile::class)->make());
            $user->assignRole(config('authorization.roles.super-admin'));
        });

        // User
        factory(User::class, 5)->create()->each(function ($user, $key) {
            $user->update(['email' => 'user+' . ($key + 1) . '@email.com']);
            $user->profile()->save(factory(Profile::class)->make());
        });
    }
}
