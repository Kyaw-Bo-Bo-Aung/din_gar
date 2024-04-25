<?php

namespace Database\Seeders;

use App\AdminUser;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new AdminUser();
        $admin->name = "Admin";
        $admin->email = "admin@dingar.com";
        $admin->password = bcrypt("password123");
        $admin->phone = 99999999;
        $admin->save();
    }
}
