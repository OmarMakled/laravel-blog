<?php

use App\Models\Role;
use App\Models\User;

class UsersSeeder extends Seeder
{
    protected $tables = [
        'users',
        'roles',
        'role_user'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables()->seedTables();
    }

    protected function seedTables()
    {
        factory(Role::class)->create(['name' => 'visitor']);
        factory(Role::class)->create(['name' => 'admin']);

        factory(User::class)->create(['name' => 'visitor'])->roles()->sync([1]);
        factory(User::class)->create(['name' => 'admin', 'email' => 'admin@mail.com', 'password' => bcrypt('secret')])->roles()->sync([1, 2]);
    }

}
