<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;

class HolidayController extends Controller
{
    // 一覧表示
    public function index()
    {
        $holidays = Holiday::all();
        return view('holidays.index', ['holidays' => $holidays]);
    }

    // 詳細表示
    public function show($id)
    {
        $holiday = Holiday::findOrFail($id);
        return view('holidays.show', ['holiday' => $holiday]);
    }

    // 作成フォーム表示
    public function create()
    {
        return view('holidays.create');
    }

    // 作成処理
    public function store(Request $request)
    {
        // バリデーションなどの処理を追加する場合があります
        Holiday::create($request->all());
        return redirect()->route('holidays.index');
    }

    // 編集フォーム表示
    public function edit($id)
    {
        $holiday = Holiday::findOrFail($id);
        return view('holidays.edit', ['holiday' => $holiday]);
    }

    // 更新処理
    public function update(Request $request, $id)
    {
        // バリデーションなどの処理を追加する場合があります
        $holiday = Holiday::findOrFail($id);
        $holiday->update($request->all());
        return redirect()->route('holidays.index');
    }

    // 削除処理
    public function destroy($id)
    {
        $holiday = Holiday::findOrFail($id);
        $holiday->delete();
        return redirect()->route('holidays.index');
    }
}
