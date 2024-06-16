<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('users')->insert([
            ['username' => '中村一太',
            'mail' => 'first@mail.com',
            'password' => Hash::make('nakamura_first')],
            // Hash::make()、、、暗号化処理
            ['username' => '中村二太',
            'mail' => 'second@mail.com',
            'password' => Hash::make('nakamura_second')],
            ['username' => '中村三太',
            'mail' => 'third@mail.com',
            'password' => Hash::make('nakamura_third')],
            ['username' => '中村四太',
            'mail' => 'fourth@mail.com',
            'password' => Hash::make('nakamura_fourth')],
            ['username' => '中村五太',
            'mail' => 'fifth@mail.com',
            'password' => Hash::make('nakamura_fifth')]
        ]);
    }
}
