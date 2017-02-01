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

/*
 * User factory
 *
 */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'is_guest' => 0,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/*
 * Story factory
 *
 */
$factory->define(App\Story::class, function (Faker\Generator $faker) {
    $title = $faker->title;

    return [
        'title' => $faker->title,
        'slug' => str_slug($title, '-'),
        'rounds' => 5,
        'max_writers' => 5,
        'num_of_writers' => 1,
        'status' => 0,
        'user_id' => 1
    ];
});
