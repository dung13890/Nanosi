<?php

use Illuminate\Database\Seeder;
use App\Eloquent\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create();

        if (App::environment('local')) {
            app(User::class)->find(1)->update([
                'name' => 'system',
                'username' => 'system',
                'email' => 'system@example.com',
            ]);

            app(User::class)->find(2)->update([
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
            ]);
        }
    }
}
