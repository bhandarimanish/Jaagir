<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\User;
use App\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        factory('App\User',10)->create();
        factory('App\Company',10)->create();
        factory('App\Job',10)->create();
        factory('App\Testimonial',1)->create();

        $categories=[
            'Technology',
            'Engineering',
            'Government',
            'Medical',
            'Construction',
            'Software'
        ];

        foreach($categories as $cat)
        {
            Category::create(['name'=>$cat]);
        }

        Role::truncate();
        $adminrole=Role::create(['name'=>'admin']);
        $admin=User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('password'),
            'email_verified_at'=>NOW()
        ]);

        $admin->roles()->attach($adminrole);
    }
}
