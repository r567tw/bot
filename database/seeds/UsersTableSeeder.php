<?php

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
        factory(App\User::class)->create([
            'name' => 'jimmy.fang',
            'email' => 'r567tw@gmail.com',
            'password' => bcrypt('qwert231'),
            'is_admin' => true,
            'is_developer' => true
        ]);

        factory(App\User::class, 2)->create()->each(function ($user) {
            factory(App\Post::class, 1)->create(['user_id' => $user->id]);
            factory(App\Chat::class, 2)->create(['user_id' => $user->id]);
        });;
    }
}
