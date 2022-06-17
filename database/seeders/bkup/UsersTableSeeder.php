<?php

use Illuminate\Database\Seeder;
use App\Model\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create(
            [
            'name'     => 'admin',
            'user_name'     => 'admin',
            'phone_number'     => 1102511025,
            'email'    => 'admin@mailinator.com',
            'password' => Hash::make('123456'),
            ]
        );
    }
}
