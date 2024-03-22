<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ユーザー管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('ユーザー名'));
        $grid->column('email', __('メールアドレス'));
        $grid->column('email_verified_at', __('メール認証'));
        $grid->column('created_at', __('登録日'))->sortable();
        $grid->column('updated_at', __('更新日'))->sortable();

        $grid->filter(function ($filter) {
            $filter->like('name', 'ユーザー名');
            $filter->like('email', 'メールアドレス');
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('ユーザー名'));
        $show->field('email', __('メールアドレス'));
        $show->field('email_verified_at', __('メール認証'));
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
        $form = new Form(new User());

        $form->text('name', __('ユーザー名'));
        $form->email('email', __('メールアドレス'));
        $form->datetime('email_verified_at', __('メール認証'))->default(date('Y-m-d H:i:s'));
        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = bcrypt($form->password);
            } else {
                $form->password = $form->model()->password;
            }
        });

        return $form;
    }
}
