<?php

use App\Models\Auth\User;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@arrahmahbalikpapan.or.id',
            'password' => '12345',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        User::create([
            'first_name' => 'User',
            'last_name' => 'Manager',
            'email' => 'manager@arrahmahbalikpapan.or.id',
            'password' => '12345',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        User::create([
            'first_name' => 'User',
            'last_name' => 'Administrasi',
            'email' => 'user@arrahmahbalikpapan.or.id',
            'password' => '12345',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        User::create([
            'first_name' => 'Head Cashier',
            'last_name' => 'Ekonomi',
            'email' => 'head.cashier@arrahmahbalikpapan.or.id',
            'password' => '12345',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        User::create([
            'first_name' => 'Assistant 1 Cashier',
            'last_name' => 'Ekonomi',
            'email' => 'assisstant1.cashier@arrahmahbalikpapan.or.id',
            'password' => '12345',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        User::create([
            'first_name' => 'Assistant 2 Cashier',
            'last_name' => 'Ekonomi',
            'email' => 'assisstant2.cashier@arrahmahbalikpapan.or.id',
            'password' => '12345',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        User::create([
            'first_name' => 'Head Finance',
            'last_name' => 'Ekonomi',
            'email' => 'Head.Finance@arrahmahbalikpapan.or.id',
            'password' => '12345',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        User::create([
            'first_name' => 'Head Finance',
            'last_name' => 'Ekonomi',
            'email' => 'Assistant.finance@arrahmahbalikpapan.or.id',
            'password' => '12345',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        $this->enableForeignKeys();
    }
}
