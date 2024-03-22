<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store_categories = [
            'ひつまぶし',
            '味噌煮込みうどん',
            '味噌カツ',
            '手羽先',
            'きしめん',
            'あんかけスパ',
            '天むす',
            'どて煮',
            '鉄板スパ',
            '台湾ラーメン',
            '味噌おでん',
            '小倉トースト',
            'エビフライ',
            '鬼まんじゅう',
            'モーニング',
            'カレーうどん',
            '名古屋コーチン',
            'ういろう（ういろ）',
            'えびせんべい',
            '守口漬',
            '台湾まぜそば',
            'とんちゃん',
        ];

        foreach ($store_categories as $category) {
            Category::create([
                'name' => $category,
                'description' => $category,
            ]);
        }

    }
}
