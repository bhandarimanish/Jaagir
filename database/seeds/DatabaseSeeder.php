<?php

use Illuminate\Database\Seeder;
use App\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User',10)->create();
        factory('App\Company',10)->create();
        factory('App\Job',10)->create();

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
    }
}
