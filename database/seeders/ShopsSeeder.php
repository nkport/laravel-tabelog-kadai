<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Shops;

class ShopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('shops')->insert([
        //     'name' => 'ワイワイよっちゃん',
        //     'category_id' => 1,
        //     'avg_price_low' => 980,
        //     'avg_price_high' => 2000,
        //     'description' => '名古屋駅から徒歩13分のところにある自宅兼居酒屋さん。',
        //     'open_time' => '17:00',
        //     'close_time' => '06:00',
        //     'holiday' => '日曜日',
        //     'address' => '名古屋市中区',
        //     'tel' => '052-000-0000',
        // ]);

        Shops::factory()->count(141)->create();
    }
}
