<?php

namespace App\Admin\Controllers;

use App\Models\Shops;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Extensions\Tools\CsvImport;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Http\Request;

class ShopsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '店舗管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Shops());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('店舗名'))->sortable();
        // $grid->column('category.name', __('カテゴリー'))->sortable();
        // $grid->column('avg_price_low', __('最安値'));
        // $grid->column('avg_price_high', __('最高値'));
        // $grid->column('description', __('紹介文'));
        // $grid->column('open_time', __('オープン'))->sortable();
        // $grid->column('close_time', __('クローズ'))->sortable();
        // $grid->column('holiday', __('定休日'))->sortable();
        $grid->column('address', __('住所'));
        // $grid->column('tel', __('電話番号'));
        // $grid->column('created_at', __('作成日'))->sortable();
        $grid->column('updated_at', __('更新日'))->sortable();

        $grid->filter(function ($filter) {
            $filter->like('name', '店舗名');
            // $filter->like('description', '紹介文');
            $filter->between('created_at', '登録日')->datetime();
            // $filter->scope('trashed', '非公開のお店')->onlyTrashed();
        });

        $grid->tools(function ($tools) {
            $tools->append(new CsvImport());
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Shops::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('店舗名'));
        $show->field('category.name', __('カテゴリー'));
        $show->field('avg_price_low', __('最安値'));
        $show->field('avg_price_high', __('最高値'));
        $show->field('description', __('紹介文'));
        $show->field('open_time', __('オープン'));
        $show->field('close_time', __('クローズ'));
        $show->field('address', __('住所'));
        $show->field('tel', __('電話番号'));
        $show->field('image', __('画像'))->image();
        $show->field('latitude', __('緯度'));
        $show->field('longitude', __('経度'));
        $show->field('distance', __('距離'));
        $show->field('created_at', __('作成日'));
        $show->field('updated_at', __('更新日'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Shops());

        $form->text('name', __('店舗名'))->placeholder('店舗名');
        $form->select('category_id', __('カテゴリー'))->options(Category::all()->pluck('name', 'id'));
        $form->number('avg_price_low', __('最安値'))->placeholder('最安値');
        $form->number('avg_price_high', __('最高値'))->placeholder('最高値');
        $form->textarea('description', __('紹介文'))->placeholder('紹介文');
        $form->time('open_time', __('オープン'))->default(date('H:i'));
        $form->time('close_time', __('クローズ'))->default(date('H:i'));
        $form->text('address', __('住所'))->placeholder('住所');
        $form->text('tel', __('電話番号'))->placeholder('電話番号');
        $form->text('latitude', __('緯度'))->placeholder('緯度');
        $form->text('longitude', __('経度'))->placeholder('経度');
        $form->text('distance', __('距離'))->placeholder('距離');
        $form->multipleImage('image', __('画像（複数可）'))->uniqueName()->removable();

        return $form;
    }

    public function csvImport(Request $request)
    {
        $file = $request->file('file');
        $lexer_config = new LexerConfig();
        $lexer = new Lexer($lexer_config);

        $interpreter = new Interpreter();
        $interpreter->unstrict();

        $rows = array();
        $interpreter->addObserver(function (array $row) use (&$rows) {
            $rows[] = $row;
        });

        $lexer->parse($file, $interpreter);
        foreach ($rows as $key => $value) {

            if (count($value) == 10) {
                Shops::create([
                    'name' => $value[0],
                    'category_id' => $value[1],
                    'avg_price_low' => $value[2],
                    'avg_price_high' => $value[3],
                    'description' => $value[4],
                    'open_time' => $value[5],
                    'close_time' => $value[6],
                    'day_of_week' => $value[7],
                    'address' => $value[8],
                    'tel' => $value[9],
                    'image' => $value[10],
                ]);
            }
        }

        return response()->json(
            ['data' => '成功'],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }

}
