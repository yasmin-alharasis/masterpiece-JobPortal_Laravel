<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Company;
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
        'user_type'=>'seeker',
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'user_id'=>App\User::all()->random()->id,
        'cname' => $name=$faker->company,
        'slug'=>str_slug($name),
        'address'=>$faker->address,
        'phone'=>$faker->phoneNumber,
        'website'=>$faker->domainName,
        'logo'=>'man.jpg',
        'cover_photo'=>'Cover-Photo-Background.png',
        'slogan'=>'learn-earn and grow',
        'description'=>$faker->paragraph(rand(2,10))
    ];
});

$factory->define(App\Job::class, function (Faker $faker) {
    return [
        'user_id'=>App\User::all()->random()->id,
        'company_id'=>App\Company::all()->random()->id,
        'title'=>$title=$faker->text,
        'slug'=>str_slug($title),
        'description'=>$faker->paragraph(rand(2,10)),
        'roles'=>$faker->text,
        'category_id'=>rand(1,5),
        'position'=>$faker->jobTitle ,
        'address'=>$faker->address,
        'type'=>'fulltime',
        'status'=>rand(0,1),
        'last_date'=>$faker->DateTime,
        'experience'=>rand(0,10),
        'salary'=>rand(200,2000),
    ];
});