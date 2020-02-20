<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;

class UserSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)->create(
            [ 'email' => 'admin@email.com']
        )->each(function ($user) {
            $user->profile()->save(factory(Profile::class)->make());
            $user->assignRole(config('authorization.roles.super-admin'));
        });
    }
}
