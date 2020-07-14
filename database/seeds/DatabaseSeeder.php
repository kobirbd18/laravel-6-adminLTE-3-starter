<?php

use App\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

// use PermissionTableSeeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        //Permission Seed
        $this->call(PermissionTableSeeder::class);

        //Admin Seed
        $admin = Admin::where('email', 'admin@annanovas.com')->get();
        if ($admin->count() == 0) {
            $admin = Admin::create([
                'name' => 'Admin',
                'role_id' => 1,
                'email' => 'admin@annanovas.com',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('111111'),
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if ($admin->wasRecentlyCreated) {
                $admin->attachRole($admin->role_id);
            }
        }
    }
}
