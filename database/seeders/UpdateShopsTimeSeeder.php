<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shops;
use Carbon\Carbon;

class UpdateShopsTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 既存のデータを取得
        $shops = Shops::all();

        // 既存のデータをループして、open_timeとclose_timeを上書き
        foreach ($shops as $shop) {
            // ランダムな営業時間を生成
            $open_time = Carbon::createFromTime(rand(0, 23), 0, 0); // 0時から23時の範囲
            $close_time = Carbon::createFromTime(rand(0, 23), 0, 0); // 0時から23時の範囲

            // open_timeがclose_timeより後の場合、close_timeを調整
            if ($close_time->lt($open_time)) {
                $close_time->addHours(12); // 12時間後に設定（例: 21:00から07:00になる場合）
            }

            // データベースにデータを上書き
            $shop->update([
                'open_time' => $open_time->format('H:i:s'),
                'close_time' => $close_time->format('H:i:s'),
            ]);

        }
    }
}
