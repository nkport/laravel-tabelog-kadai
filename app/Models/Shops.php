<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Storage;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Storage;

class Shops extends Model
{
    use HasFactory, Sortable;
    protected $fillable = [
        'id',
        'name',
        'category_id',
        'avg_price_low',
        'avg_price_high',
        'description',
        'open_time',
        'close_time',
        'holiday',
        'address',
        'tel',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorite_shops()
    {
        return $this->belongsToMany(Shops::class)->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // LaravelAdmin用：画像パスをJSON形式で保存するためのアクセサとミューテータの設定…
    // 公式ドキュメント見てもかなり分かりづらいです。下記はファイル名称をユニークにしない上書きされるバージョン。
    public function setImageAttribute($images)
    {
        if (is_array($images)) {
            $this->attributes['image'] = json_encode($images);
        }
    }
    public function getImageAttribute($images)
    {
        return json_decode($images, true);
    }

    public function deleteImage($fileName) {
        // ダミー画像を削除しない
        if ($fileName != 'dummy.jpg') {
            Storage::delete($fileName);
        }
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function holidays()
    {
        return $this->belongsToMany(Holiday::class);
    }

    public function popularSortable() // 予約数順
    {
        return $this->withCount('reservations')->orderBy('reservations_count', 'desc');
    }

}
