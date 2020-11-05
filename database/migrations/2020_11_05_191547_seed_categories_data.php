<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    public function up()
    {
        $categories = [
            [
                'name'        => '热点新闻',
                'description' => '国内外热点资讯，时事聚焦',
            ],
            [
                'name'        => '网事杂谈',
                'description' => '生活中遇到的奇闻轶事，畅所欲言',
            ],
            [
                'name'        => '文娱剧场',
                'description' => '荟聚近期最新最热的文娱资讯',
            ],
            [
                'name'        => 'PC数码',
                'description' => '最酷炫的高科技产品尽在于此',
            ],
            [
                'name'        => '绿荫赛场',
                'description' => '聚焦足球篮球的焦点赛事',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    public function down()
    {
        DB::table('categories')->truncate();
    }
}
