<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        mb_internal_encoding('UTF-8');

        $adminPerson = Person::firstOrCreate([
            'names' => mb_convert_case('FERNANDO DANIEL', MB_CASE_TITLE),
            'surnames' => mb_convert_case('GARCIA ALVAREZ', MB_CASE_TITLE),
        ]);

        $assistantPerson = Person::firstOrCreate([
            'names' => mb_convert_case('LAURA MIREYA', MB_CASE_TITLE),
            'surnames' => mb_convert_case('MORALES PEREZ', MB_CASE_TITLE),
        ]);

        User::create([
            'name'      => $adminPerson->full_name,
            'email'     => 'admin@test.com',
            'password'  => Hash::make('password'),
            'status_id' => 1,
            'role_id'   => 1,
            'person_id' => $adminPerson->id,
        ]);

        User::create([
            'name'      => $assistantPerson->full_name,
            'email'     => 'assistant@test.com',
            'password'  => Hash::make('password123'),
            'status_id' => 1,
            'role_id'   => 1,
            'person_id' => $assistantPerson->id,
        ]);
    }
}
