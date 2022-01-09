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
        //
        $user = App\User::create([
            'username'=> 'Bobby',
            'password' => bcrypt('#K2hhg3h1'),
        ]);
        $user = App\User::create([
            'username'=> 'Rene',
            'password' => bcrypt('#K2hhg3h1#&'),
        ]);
        $user = App\User::create([
            'username'=> 'Frank',
            'password' => bcrypt('#K2hhg3h1#&'),
        ]);
        $user = App\User::create([
            'username'=> 'Charlotte',
            'password' => bcrypt('#K2hhg3h1#&'),
        ]);
    }
}
