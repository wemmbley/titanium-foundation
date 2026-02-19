<?php

return new class
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public static function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'admin123',
        ]);
    }
};