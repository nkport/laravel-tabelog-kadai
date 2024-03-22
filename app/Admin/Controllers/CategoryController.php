<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '店舗カテゴリー';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('カテゴリー名'))->sortable();
        $grid->column('description', __('説明'));
        $grid->column('created_at', __('登録日'))->sortable();
        $grid->column('updated_at', __('更新日'))->sortable();

        $grid->filter(function ($filter) {
            $filter->like('name', 'カテゴリー名');
            $filter->between('created_at', '登録日')->datetime();
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
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('カテゴリー名'));
        $show->field('description', __('説明'));
        $show->field('created_at', __('登録日'));
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
        $form = new Form(new Category());

        $form->text('name', __('カテゴリー名'))->placeholder('カテゴリー名を入力してください。');
        $form->textarea('description', __('説明'))->placeholder('※同じ内容を入力してください。管理面向上のため必要となります。');

        return $form;
    }
}
