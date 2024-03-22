<?php

namespace App\Models;

use App\Models\Holiday;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectHoliday extends Model
{
    use HasFactory;

    protected $table = 'connect_holiday';

    public function index()
    {
        $holidayId = ConnectHoliday::pluck('holidays_id');
        return view('shops', ['holidayId' => $holidayId]);
    }
}
