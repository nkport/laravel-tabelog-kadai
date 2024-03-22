<?php

namespace App\Admin\Controllers;

use App\Models\TermsOfService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TermsOfServiceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '利用規約';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TermsOfService());

        $grid->column('id', __('ID'));
        $grid->column('description', __('内容'));
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
        $show = new Show(TermsOfService::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('description', __('内容'));
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
        $form = new Form(new TermsOfService());

        $form->textarea('description', __('規約'))->placeholder('HTMLが使えます。')->rows(25);

        return $form;
    }
}
