<?php

use Illuminate\Database\Seeder;
use App\Model\RoleUser;

class RoleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->delete();

        RoleUser::create(
        [
            'role_id' => 1,
            'user_id' => 1
        ]);

    }
}
