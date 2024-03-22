<?php

namespace App\Admin\Controllers;

use App\Models\PrivacyPolicy;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PrivacyPolicyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'プライバシーポリシー';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PrivacyPolicy());

        $grid->column('id', __('ID'));
        $grid->column('description', __('プライバシーポリシー'));
        $grid->column('created_at', __('登録日'));
        $grid->column('updated_at', __('更新日'));

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
        $show = new Show(PrivacyPolicy::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('description', __('プライバシーポリシー'));
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
        $form = new Form(new PrivacyPolicy());

        $form->textarea('description', '内容')->placeholder('HTMLが使えます。')->rows(25);

        return $form;
    }
}
