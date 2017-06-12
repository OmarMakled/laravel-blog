<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Article::class, function (Faker\Generator $faker) {
    $user_id = App\Models\User::pluck('id')->random();

    return [
        'title'     => $faker->sentence,
        'content'   => $faker->paragraph,
        'user_id'   => $user_id,
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name'          => $faker->name,
        'created_at'    =>  new Datetime,
        'updated_at'    =>  new Datetime,
    ];
});

$factory->define(App\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'name'          => $faker->name,
        'description'   =>  $faker->sentence,
        'created_at'    =>  new Datetime,
        'updated_at'    =>  new Datetime,
    ];
});

$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    $user_id = App\Models\User::pluck('id')->random();
    $article_id = App\Models\Article::pluck('id')->random();

    return [
        'content'       => $faker->paragraph,
        'article_id'    =>  $article_id,
        'user_id'       =>  $user_id,
    ];
});
