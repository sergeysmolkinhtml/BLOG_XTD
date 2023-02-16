<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
            'name'     => 'UNKNOWN AUTHOR',
            'email'    => 'author_unknown@gmail',
            'password' => bcrypt(Str::random()),
            ],

            [
                'name'     => 'Author',
                'email'    => 'author@gmail',
                'password' => bcrypt('123123'),

            ],
        ];
        DB::table('users')->insert($data);
    }
}
