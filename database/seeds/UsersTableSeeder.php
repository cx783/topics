<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        factory(\App\User::class, 50)
            ->create()
            ->each(function ($user) use ($faker) {
                $user
                    ->topics()
                    ->saveMany(
                        factory(\App\Topic::class, $faker->numberBetween(1, 5))
                        ->make()
                    )
                    ->each(function ($topic) use ($faker) {
                        $topic->comments()->saveMany(
                            factory(\App\Comment::class, $faker->numberBetween(0, 10))
                                ->make()
                                ->each(function ($comment) use ($topic) {
                                    $comment->author()->associate(
                                        \App\User::where('id', '<>', $topic->user_id)->orderBy(DB::raw('RAND()'))->first()
                                    );
                                })
                        );
                    });
        });
    }
}
