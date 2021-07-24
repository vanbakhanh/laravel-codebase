<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insertOrIgnore([
            [
                'id' => 1,
                'user_id' => '',
                'name' => 'Codebase Personal Access Client',
                'secret' => 'H7Y4j1Thmd5Zlwc0qgIyULcaQ3arc9J3rRHnr3HI',
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'user_id' => '',
                'name' => 'Codebase Password Grant Client',
                'secret' => 'YOWj2ITAD2lH5u6GwXyGpsfyffOWxVKWlZl7ixxR',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
