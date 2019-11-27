<?php

use App\Discussion;
use Illuminate\Database\Seeder;

class DiscussionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t1='implementing oauth with laravel';
        $t2='vuejs';
        $t3='event listeners';
        $t4='undetected db';

        $d1=[
            'title'=>$t1,
            'content'=>'lorem ipsum fuck you',
            'channel_id'=>1,
            'user_id'=>2,
            'slug'=>str_slug($t1)
        ];

        $d2=[
            'title'=>$t2,
            'content'=>'lorem ipsum fuck me',
            'channel_id'=>2,
            'user_id'=>1,
            'slug'=>str_slug($t2)
        ];

        $d3=[
            'title'=>$t3,
            'content'=>'lorem ipsum fuck us',
            'channel_id'=>2,
            'user_id'=>1,
            'slug'=>str_slug($t3)
        ];

        $d4=[
            'title'=>$t4,
            'content'=>'lorem ipsum fuck ours',
            'channel_id'=>5,
            'user_id'=>1,
            'slug'=>str_slug($t4)
        ];

        Discussion::create($d1);
        Discussion::create($d2);
        Discussion::create($d3);
        Discussion::create($d4);

    }
}
