<?php

use App\Reply;
use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r1=[
            'user_id'=>1,
            'discussion_id'=>1,
            'content'=>'lorem ipsum dolor sit amet'
        ];

        $r2=[
            'user_id'=>1,
            'discussion_id'=>2,
            'content'=>'lorem ipsum dolor sit amet'
        ];

        $r3=[
            'user_id'=>2,
            'discussion_id'=>3,
            'content'=>'lorem ipsum dolor sit amet'
        ];

        $r4=[
            'user_id'=>1,
            'discussion_id'=>4,
            'content'=>'lorem ipsum dolor sit amet'
        ];

        Reply::create($r1);
        Reply::create($r2);
        Reply::create($r3);
        Reply::create($r4);

    }
}
