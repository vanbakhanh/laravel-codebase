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

        factory(User::class, 5)->create()->each(function ($user) {
            $user->profile()->save(factory(Profile::class)->make());
        });

        User::find(2)->update([
            'email' => 'user@email.com',
        ]);
    }
}
