<?php

namespace Database\Factories;

use Encore\Admin\Form\Field\Nullable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shops>
 */
class ShopsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
            'category_id' => fake()->numberBetween(1, 22),
            'avg_price_low' => fake()->numberBetween(500, 980),
            'avg_price_high' => fake()->numberBetween(1000, 5000),
            'description' => fake()->realText(),
            'open_time' => fake()->time(),
            'close_time' => fake()->time(),
            'address' => '〒000-0000 ◯◯県◯◯市◯◯区◯◯1-2-3',
            'tel' => fake()->phoneNumber(),
            'image' => '[\"img\\/dummy.png\"]',
            'latitude' => mt_rand(35160000, 35190000) / 1000000, // 仮の緯度（名古屋近辺）
            'longitude' => mt_rand(136870000, 136900000) / 1000000, // 仮の経度（名古屋近辺）
            'distance' => '距離',
        ];
    }
}
