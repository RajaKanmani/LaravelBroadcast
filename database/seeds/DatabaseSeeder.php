<?php

use App\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line("Creating roles ('Admin', 'Member').");
        $roles = ['Admin', 'Member'];
        foreach ($roles as $role) {
            \App\Role::create([
                'role' => $role
            ]);
        }
        // $this->call(RoleTableSeeder::class);

        $this->command->line("Creating 5 users.");
        factory(\App\User::class, 5)->create();

        $this->command->line("Adding roles to each user.");
        foreach (\App\User::all() as $user) {
            $role = Role::select('id')->orderByRaw("RAND()")->first()->id;
            $user->role_id = $role;
            $user->save();
            $user->roles()->attach($role);
        }

        $this->command->line("Creating 5 notes for each user.");
        \App\User::all()->each(function () {
            $range = 5;
            factory(\App\Note::class, $this->getRandomRange($range))->create();
        });
    }

    public function getRandomRange($range)
    {
        return mt_rand(1, $range);
    }
}
