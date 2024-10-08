<?php

use App\Testimonial;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'user_type'=>'seeker',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Testimonial::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'name' =>"Manish Bhandari",
        'profession'=>'Software Engineer',
        'video_id' => '509197370',
    ];
});


$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'user_id' =>App\User::all()->random()->id,
        'cname'=>$name=$faker->company,
        'slug'=>Str::slug($name),
        'address'=>$faker->address,
        'phone'=>$faker->phoneNumber,
        'website'=>$faker->domainName,
        'logo'=>'logos.png',
        'cover_photo'=>'cover.png',
        'slogan'=>'learn-earn and grow',
        'description'=>$faker->paragraph
    ];
});

$factory->define(App\Job::class, function (Faker $faker) {
    return [
        'user_id' =>App\User::all()->random()->id,
        'company_id'=>App\Company::all()->random()->id,
        'title'=>$title=$faker->text,
        'slug'=>Str::slug($title),
        'position'=>$faker->jobTitle,
        'address'=>$faker->address,
        'category_id'=> rand(1,5),
        'type'=>$faker->randomElement(['fulltime', 'parttime','internship']),
        'status'=>rand(0,1),
        'description'=>$faker->paragraph,
        'roles'=>$faker->text,
        'last_date'=>$faker->dateTimeBetween('+1 week', '+1 month'),
        'number_of_vacancy'=>rand(1,10),
        'experience'=>rand(1,10),
        'gender'=>$faker->randomElement(['male', 'female']),
        'salary'=>rand(10000,50000)
    ];
});
